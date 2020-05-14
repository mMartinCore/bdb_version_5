 
require('./bootstrap');
// import Vue from 'vue/dist/vue.min.js' 
window.Vue = require('vue'); 
require('./pace');
  
Vue.component('newcorpse', require('./components/newcorpse.vue').default);
// Vue.component('onlineuser', require('./components/onlineuser.vue').default);

 

const app = new Vue({
    el: '#app',
    data:{
        corpsenotification:[],
    },
     created(){

         if (window.Laravel.userId) {
      Echo.private(`App.User.${window.Laravel.userId}`)
        .notification((notification) => {           
            Command: toastr["info"]("Go-> Dashboard - flag for best Notification detail", "Notification")
            toastr.options = {
              "closeButton": true,
              "debug": false,
              "newestOnTop": false,
              "progressBar": true,
              "positionClass": "toast-top-center",
              "preventDuplicates": false,
              "onclick": null,
              "showDuration": "900",
              "hideDuration": "5000",
              "timeOut": "5000",
              "extendedTimeOut": "1000",
              "showEasing": "swing",
              "hideEasing": "linear",
              "showMethod": "fadeIn",
              "hideMethod": "fadeOut"
            }
 
            axios.post('notification').then(response=>{
                this.corpsenotification=response.data;
                timeAgo();
            });

            });
            axios.post('notification').then(response=>{
            this.corpsenotification=response.data;
            timeAgo();
          // alert(response.data);
            });

            Echo.private('App.User.'+window.Laravel.userId).notification((response)=>{
                 var data = {"data":response,'created_at':response.corpsenotification.created_at};
                 this.corpsenotification.push(data);
                 timeAgo();
               //  alert(response.data);
               });







            }







         function timeAgo() {
            Vue.filter('myOwnTime',function(value){return moment(value).fromNow();});

        }
     }


});
