<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Items;
use Validator;
class ItemController extends Controller
{
    public function __construct(Items $items){
        $this->modelInstance = $items;
    }

    public function index(){
        return view('item');
    }

    public function data(Request $request){
        $result = $this->modelInstance->orderBy('created_at','desc')->get();
        return response()->json(["data" => $result]);
    }

    public function save(Request $request){
        if($request->isMethod('post')){
            $rules = [
                'title' => 'required|string',
             ];
    
             $validator = Validator::make($request->all(),$rules);

             if ($validator->fails()){
                return response()->json(["error" => 1,"message" => "Fields are required","errors" => $validator->errors()],422);
             }

             $data = [
                "title" => $request->title,
                "description" => $request->description
             ];
            $record = $this->modelInstance->create($data);
            $record->status = 0;
            $record->completed_at = null;

            return response()->json(["error" => 0,"message" => "Successfully Created","data" => $record]);
        }

        if($request->isMethod('put')){
            $rules = [
                'status' => 'required|boolean',
             ];
    
             $validator = Validator::make($request->all(),$rules);

             if ($validator->fails()){
                return response()->json(["error" => 1,"message" => "Fields are required","errors" => $validator->errors()],422);
             }
             $record = $this->modelInstance->findOrFail($request->id);

             if(!$record){
                return response()->json(["error" => 1,"message" => "Unable to locate record",422]);
             }

             $data = [
                "status" => $request->status
             ];

             if($request->status ==1){
                 $data['completed_at'] = date("Y-m-d");
             }
             $record->update($data);

            return response()->json(["error" => 0,"message" => "Successfully Updated"]);
        }

        return response()->json(["error" => 1,"message" => "Method Not Allowed"],405);
    }

    public function delete(Request $request){
        
            if(isset($request->id) && $request->id != ""){
                $this->modelInstance->destroy($request->id);
                return response()->json(["error" => 0,"message" => "Successfully Deleted"]);
            }
            return response()->json(["error" => 1,"message" => "Unable to delete"],422);
    }
}
