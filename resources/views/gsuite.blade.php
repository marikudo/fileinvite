@extends('layout')

@section('content')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 bg-light" id="UploadContainer">
        <div class="my-3  bg-white rounded shadow-sm">
            <div class="d-flex align-items-center p-3 text-white-50 bg-green rounded-top m-b-0">
            <div class="lh-100">
            <h3 class="mb-0 text-white lh-100">GSuite's Checker Tool</h3>
            </div>
        </div>

        <form action="" v-on:submit.prevent="addItem">
            <div class="form-group ml-3 mr-3 mt-3 mb-0">
            <p class="small"><strong>Note :</strong>List of domains must be save in a text file.</p>
            <template v-if="loading==false">
                <div class="custom-file">
                <input type="file" class="custom-file-input" id="customFile" accept=".txt" v-on:change="fnHandleFileUpload($event.target.files)">
                <label class="custom-file-label" for="customFile">Choose file</label>
                </div>
               
                </template>
                <template v-else>
                <div class="clearfix">
                <spinner class="float-left"></spinner><div class="float-left pt-2 pl-1"> <p class="mb-0">Uploading file...</p></div>
            </div>
                </template>
            </div>

            
        </form>

        

       
        <template v-if="items.length > 0">
            <h6 class="m-3 mb-0">Results</h6>
        <div class="media-body pb-2 pl-3 pr-3 pt-2 mb-0 small lh-125 border-bottom border-gray">
                <div class="text clearfix pl-0">
                        <div class="float-left">
                            Domain
                        </div>
                        <div class="action float-right">
                            Gsuite Provider
                        </div>
                </div>
                </div>

            <template v-for="item,index in items">
            
                <div class="media-body pb-2 pl-3 pr-3 pt-2 mb-0 small lh-125 border-bottom border-gray">
                <div class="text clearfix pl-0">
                        <div class="float-left">
                            <p v-text="item.domain"></p>
                        </div>
                        <div class="action float-right">
                        <span v-text="(item.gsuite_email_provider == 1) ? 'Yes' : 'No'" class="badge" v-bind:class="{'badge-success' : (item.gsuite_email_provider == 1),'badge-default' : (item.gsuite_email_provider == 1)}"></span>
                        </div>
                </div>
                </div>
            </template>
        <small class="d-block text-right mt-3">
        <a href="#">&nbsp;</a>
        </small>
        </template>
        <template v-else>
            <div class="p-3">
            <p class="text-muted">No file uploaded yet.</p>
            </div>
        </template>
       

       
      
   
    </div>
    </main>
@endsection()

@section('script')
<script src="{!! url('public/js/upload.vue.js')!!}"></script>
@endsection()