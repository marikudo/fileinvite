@extends('layout')

@section('content')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 bg-light" id="itemContainer">
        <div class="my-3  bg-white rounded shadow-sm">
            <div class="d-flex align-items-center p-3 text-white-50 bg-green rounded-top m-b-0">
            <div class="lh-100">
            <h3 class="mb-0 text-white lh-100">Items</h3>
            </div>
        </div>

        <form action="" v-on:submit.prevent="addItem">
            <div class="form-group ml-3 mr-3 mt-3 mb-0">
                <input type="text" class="form-control" placeholder="Add Item" name="title" id="title" v-validate="'required'" v-model="itemForm.title">
            </div>
        </form>

       
        <template v-if="items.length > 0">
        <template v-for="item,index in items">
        
            <div class="media-body pb-2 pl-3 pr-3 pt-2 mb-0 small lh-125 border-bottom border-gray">
            <div class="clearfix">
                <div class="checkbox icheck-turquoise float-left">
                    <input type="checkbox" :id="'recordCheck'+index" ref="'recordCheck'+index" :checked="(item.status == 1)" :name="'recordCheck'+index" v-model="item.status" v-bind:value="item.status">
                    <label :for="'recordCheck'+index" @click="isComplete(item,$event)"></label>
                </div>

                <div class="text clearfix">
                    <div class="float-left">
                        <p v-text="item.title"></p>
                    </div>
                    <div class="action float-right">
                    <a href="javascript:void(0)" @click="deleteItem(item,index)" class=""><delete></delete></a>
                    </div>
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
            <p class="text-muted">No Item yet.</p>
            </div>
        </template>
       

       
      
   
    </div>
    </main>
@endsection()

@section('script')
<script src="{!! url('public/js/items.vue.js')!!}"></script>
@endsection()