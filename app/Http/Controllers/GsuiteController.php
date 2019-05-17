<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class GsuiteController extends Controller
{
    public function index(){
        return view('gsuite');
    }

    public function domain_name($domain_name)
    {

        $domain_len = strlen($domain_name);
        if ($domain_len < 3 OR $domain_len > 253)
            return false;

        if(stripos($domain_name, 'http://') === 0)
            $domain_name = substr($domain_name, 7); 
        elseif(stripos($domain_name, 'https://') === 0)
            $domain_name = substr($domain_name, 8);
                 
        if(stripos($domain_name, 'www.') === 0)
            $domain_name = substr($domain_name, 4); 

        if(strpos($domain_name, '.') === false OR $domain_name[strlen($domain_name)-1]=='.' OR $domain_name[0]=='.')
            return false;

        return (filter_var ('http://' . $domain_name, FILTER_VALIDATE_URL)===false)? false:true;
    }

    public function upload(Request $request){
        if($request->isMethod('post')){
            $uploadedFile = $request->file('file');
            $filename = $uploadedFile->getClientOriginalName();
            $ext = $uploadedFile->getClientOriginalExtension();

            $uploaded = $uploadedFile->storeAs('textfiles/',$filename);

            $pathToFile = storage_path("app/textfiles/".$filename);

            $domainArray = [];
             $handle = fopen($pathToFile, "r");
            if ($handle) {
                while (( $str = fgets($handle)) !== false) {
                    $line = str_replace("\r\n", "", $str);
                    $isValid = $this->domain_name($line);
                    if($isValid){
                        $domainArray[] = $line;
                    }
                }
                fclose($handle);
            }

            $result = [];
         
            if(count($domainArray) > 0){
                foreach($domainArray as $domain){

                    $uri = "https://www.google.com/a/{$domain}/ServiceLogin?https://docs.google.com/a/{$domain}";

                    $client = new Client(); 
                    $response = $client->request('GET', $uri);

                    $needle = 'Server error';
                    $record = ["domain" => $domain];
                    if ($needle != '' && mb_strpos($response->getBody(), $needle) !== false) {
                            $record['gsuite_email_provider'] = 0;
                        }else{
                            $record['gsuite_email_provider'] = 1;
                        }
                    $result[] = $record;
             
                }
            }
            return response()->json(["error" => 0,"message" => "Successfully Upload","data" => $result]); 
        }
    }
}
