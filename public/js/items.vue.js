Vue.use(VeeValidate);
var ViewInstance = new Vue({
    el : '#itemContainer',
    delimiters:['${','}'],
    data : {
       itemForm : {
        title : null,
           description : null,
           complete : false
       },
       items : [],
       loading : false,
    },
    mounted : function(){
        var self = this;
        self.itemForm = self.clearItemForm();
        self.fetchItems();
    },
    methods : {
        clearItemForm : function(){
            return {
                title : null,
                   description : null,
                   complete : false
               };
        },
        isComplete : function(obj,e){
            e.stopPropagation()
            var self = this;
            if(self.loading == false){
                self.loading = true;
                var newStatus = (obj.status ==1) ? 0 : 1;
                self.$http.put(window.BaseUrl+'/update-status-item',{'id' : obj.id,'status' : newStatus},{
                    'headers' : {'X-CSRF-TOKEN': window.Laravel.csrfToken}
                })
                .then(response => {
                self.loading = false;
                })
            }
        },
        fetchItems : function(){
            var self = this;
            self.$http.get(window.BaseUrl+'/get-items',{
				'headers' : {'X-CSRF-TOKEN': window.Laravel.csrfToken}
			}).then(response => {
		            self.items = response.data.data
		    })
        },
        addItem : function(){
            var self = this;
            self.$validator.validate().then((result) => {
               if(result){
                if(self.loading == false){
                    self.loading = true;

                   self.$http.post(window.BaseUrl+'/add-item',self.itemForm,{
                    'headers' : {'X-CSRF-TOKEN': window.Laravel.csrfToken}
                }).then((response) => {
                        self.items.unshift(response.data.data);
                        self.loading = false
                   }).catch((error) => {

                   });
                   
                    self.itemForm = self.clearItemForm();
               }
               }
            });
        },
        deleteItem : function(obj,index){
            var self = this;

            swal({
                title: "Are you sure you want to delete?",
                text: "Your will not be able to recover this item!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
              },
              function(){
                  if(self.loading == false){
                    self.loading = true;
                    self.$http.delete(window.BaseUrl+'/delete-item',{body : {id : obj.id},'headers' : {'X-CSRF-TOKEN': window.Laravel.csrfToken}}).then((response) => {
                        self.loading = false
                        self.items.splice(index,1);
                            swal("Deleted!", "Item has been deleted.", "success");
                       }).catch((error) => {
    
                       });
                  }
               

                
              });

            
        }
    }
});

Vue.component('delete',{
    template : `
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24px" height="24px">
    <path fill="#343a40" d="M 10 2 L 9 3 L 5 3 C 4.448 3 4 3.448 4 4 C 4 4.552 4.448 5 5 5 L 19 5 C 19.552 5 20 4.552 20 4 C 20 3.448 19.552 3 19 3 L 15 3 L 14 2 L 10 2 z M 5 7 L 5 20 C 5 21.1 5.9 22 7 22 L 17 22 C 18.1 22 19 21.1 19 20 L 19 7 L 5 7 z M 9 9 C 9.552 9 10 9.448 10 10 L 10 19 C 10 19.552 9.552 20 9 20 C 8.448 20 8 19.552 8 19 L 8 10 C 8 9.448 8.448 9 9 9 z M 15 9 C 15.552 9 16 9.448 16 10 L 16 19 C 16 19.552 15.552 20 15 20 C 14.448 20 14 19.552 14 19 L 14 10 C 14 9.448 14.448 9 15 9 z"/>
</svg>`
});

Vue.component('spinner',{
    template : `
    <svg version="1.1" id="loader-1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
   width="40px" height="40px" viewBox="0 0 40 40" enable-background="new 0 0 40 40" xml:space="preserve">
  <path opacity="0.2" fill="#000" d="M20.201,5.169c-8.254,0-14.946,6.692-14.946,14.946c0,8.255,6.692,14.946,14.946,14.946
    s14.946-6.691,14.946-14.946C35.146,11.861,28.455,5.169,20.201,5.169z M20.201,31.749c-6.425,0-11.634-5.208-11.634-11.634
    c0-6.425,5.209-11.634,11.634-11.634c6.425,0,11.633,5.209,11.633,11.634C31.834,26.541,26.626,31.749,20.201,31.749z"/>
  <path fill="#000" d="M26.013,10.047l1.654-2.866c-2.198-1.272-4.743-2.012-7.466-2.012h0v3.312h0
    C22.32,8.481,24.301,9.057,26.013,10.047z">
    <animateTransform attributeType="xml"
      attributeName="transform"
      type="rotate"
      from="0 20 20"
      to="360 20 20"
      dur="0.5s"
      repeatCount="indefinite"/>
    </path>
  </svg>`
});