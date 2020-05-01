 <template>
      <!-- Notifications Menu -->
        <li class="dropdown notifications-menu nav-bar " >
            <!-- Menu toggle button -->
      <a href="#" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >

            <i class="fa fa-flag" aria-hidden="true" style="color:blanchedalmond"></i>     <span class="label label-warning" id="count-notification">{{ corpsenotification.length}}</span>
            </a>
            <ul class="dropdown-menu">

                    <li> <a style="width:45rem; text-align: center " class="header" v-if="corpsenotification.length>0"><b><i>You have {{ corpsenotification.length}} unread notifications </i></b> </a></li>
                     <li >  <a class="header" v-if="corpsenotification.length==0" style="text-align: center" > <b><i> You have no notifications</i></b> </a> </li>
                    <!-- Inner Menu: contains the notifications -->
                  <li>
                    <ul class="menu"  v-if="corpsenotification.length >0" style="height: 350px; overflow-y: auto; overflow-x: hidden;">
                        <div class="dropdown-item form-inline" v-on:click="markAsReadx(notes)"  v-for="notes in corpsenotification"  v-bind:key="notes.id"> <br>
                           <a  href="#" v-on:click="markAsReadx(notes)"  class="header form-inline" v-if="notes.data['newCorpse']['type']==='Created' ">
                             <i class="fa fa-book" aria-hidden="true"></i>&nbsp;&nbsp;  {{ notes.data['newCorpse']['user'] }}  of {{ notes.data['newCorpse']['division'] }}  post a new corpse <b> {{ notes.created_at | myOwnTime }}</b><br>
                         </a>

                           <a  href="#" v-on:click="markAsReadx(notes)"  class="header form-inline" v-if="notes.data['newCorpse']['type']==='Request' ">
                             <i class="fa fa-book" aria-hidden="true"></i>&nbsp;&nbsp;  {{ notes.data['newCorpse']['user'] }}  of {{ notes.data['newCorpse']['division'] }}  made a Pauper's Burial Request  <b> {{ notes.created_at | myOwnTime }}</b><br>
                         </a>

                        <a href="#" class="header form-inline"    v-on:click="markAsReadx(notes)"    v-if="notes.data['newCorpse']['type']==='Updated' " >
                            <i class="fa fa-book" aria-hidden="true"></i>&nbsp;&nbsp;  {{ notes.data['newCorpse']['user'] }} of {{notes.data['newCorpse']['division']  }} updated corpse info <b> {{notes.created_at | myOwnTime }}</b><br>
                        </a>


                        <a href="#" class="header form-inline"    v-on:click="markAsReadx(notes)"    v-if="notes.data['newCorpse']['type']==='Denied' " >
                            <i class="fa fa-book" aria-hidden="true"></i>&nbsp;&nbsp;  {{ notes.data['newCorpse']['user'] }} of {{notes.data['newCorpse']['division']  }} Pauper's Burial Request Denied <b> {{notes.created_at | myOwnTime }}</b><br>
                        </a>


                         <a href="#" class="header form-inline" v-on:click="markAsReadx(notes)"    v-if="notes.data['newCorpse']['type']==='task' " >
                            <i class="fa fa-book" aria-hidden="true"></i>&nbsp;&nbsp;  {{ notes.data['newCorpse']['from'] }} <b>@</b>DCP Admin sent you a new task <b> {{notes.created_at | myOwnTime }}</b><br>
                        </a>

                         <a href="#" class="header form-inline" v-on:click="markAsReadx(notes)"    v-if="notes.data['newCorpse']['type']==='message' " >
                            <i class="fa fa-book" aria-hidden="true"></i>&nbsp;&nbsp;  {{ notes.data['newCorpse']['from'] }}   sent you a new message <b> {{notes.created_at | myOwnTime }}</b><br>
                        </a>

                       <a href="#" class="header form-inline"    v-on:click="markAsReadx(notes)"    v-if="notes.data['newCorpse']['type']==='Overthirty' " >
                            <i class="fa fa-book" aria-hidden="true"></i>&nbsp;&nbsp;  {{ notes.data['newCorpse']['name'] }} of {{notes.data['newCorpse']['division']  }} Over thirty(30) days corpse info <b> {{notes.created_at | myOwnTime }}</b><br>
                        </a>


    <a href="#" class="header form-inline"    v-on:click="markAsReadx(notes)"    v-if="notes.data['newCorpse']['type']==='PendingPastNoPostmortem' " >
         <i class="fa fa-book" aria-hidden="true"></i>&nbsp;&nbsp; Postmortem pending date expired {{ notes.data['newCorpse']['name'] }} of {{notes.data['newCorpse']['division']  }} yet no Postmortem conducted<b> {{notes.created_at | myOwnTime }}</b><br>
   </a>



    <a href="#" class="header form-inline"    v-on:click="markAsReadx(notes)"    v-if="notes.data['newCorpse']['type']==='PostCompletedNotBuried' " >
         <i class="fa fa-book" aria-hidden="true"></i>&nbsp;Postmortem is completed  {{ notes.data['newCorpse']['name'] }} of {{notes.data['newCorpse']['division']  }} still not buried <b> {{notes.created_at | myOwnTime }}</b><br>
   </a>



    <a href="#" class="header form-inline"    v-on:click="markAsReadx(notes)"    v-if="notes.data['newCorpse']['type']==='FifteenDays' " >
         <i class="fa fa-book" aria-hidden="true"></i>&nbsp; Fifteen days expired no Postmortem and not buried re: {{ notes.data['newCorpse']['name'] }} of {{notes.data['newCorpse']['division']  }}  <b> {{notes.created_at | myOwnTime }}</b><br>
   </a>



    <a href="#" class="header form-inline"    v-on:click="markAsReadx(notes)"    v-if="notes.data['newCorpse']['type']==='TwentyFiveDays' " >
         <i class="fa fa-book" aria-hidden="true"></i>&nbsp; Twenty five days expired no Postmortem and not buried re: {{ notes.data['newCorpse']['name'] }} of {{notes.data['newCorpse']['division']  }}  <b> {{notes.created_at | myOwnTime }}</b><br>
   </a>


    <a href="#" class="header form-inline"    v-on:click="markAsReadx(notes)"    v-if="notes.data['newCorpse']['type']==='Approved' " >
         <i class="fa fa-book" aria-hidden="true"></i>&nbsp; Pauper's Burial Approved Re: {{ notes.data['newCorpse']['name'] }} of {{notes.data['newCorpse']['division']  }}  <b> {{notes.created_at | myOwnTime }}</b><br>
   </a>


    <a href="#" class="header form-inline"    v-on:click="markAsReadx(notes)"    v-if="notes.data['newCorpse']['type']==='NewUser' " >
         <i class="fa fa-book" aria-hidden="true"></i>&nbsp;New user: {{ notes.data['newCorpse']['name'] }} of {{notes.data['newCorpse']['station']  }} {{notes.data['newCorpse']['division']  }} registered <b> {{notes.created_at | myOwnTime }}</b><br>
   </a>
                         </div>
                
                        </ul>
                             <div class="footer" style="text-align: center" v-on:click="markAllNewCorpseNotifyAsReadx()" v-if="corpsenotification.length > 0">
                   
                    
                    </div>
                       <div class="footer" style="text-align: center" v-on:click="markAllNewCorpseNotifyAsReadx()" v-if="corpsenotification.length > 0">
                         <hr>
                      <b  v-if="corpsenotification.length>0"><i>Mark all as read</i></b>                    
                          </div>
                        
                     </li>
                 </ul>
             </li>
</template>

<script>
    export default {
          props: ['corpsenotification'],
          methods:{
              markAsReadx: function(mynotes){
                  var data={
                        not_id : mynotes.id,
                    mynotes_id :mynotes.data['newCorpse']['id'],
                  };


                    axios.post("markAsRead",data).then(response =>{
                 //       window.location = '{{ url("readNewCorpseNotify/+data.not_id) }}';
                 //  window.location.href = "{{URL::to('readNewCorpseNotify/')}}"
                      //   window.location = '{{ url(readNewCorpseNotify/'+data.not_id+')}}'
                         //  window.location.href = "{!! route('readNewCorpseNotify', data.not_id) !!}";
                           window.location.href=  window.location.protocol+"//"+window.location.hostname+"/readNewCorpseNotify/"+data.not_id;
                           //window.location.href = "/readNewCorpseNotify/"+data.not_id;
                        //window.location="readNewCorpseNotify/"+data.not_id;
                    });

              },
                  markAllNewCorpseNotifyAsReadx:function() {
                      axios.post("markAllNewCorpseNotifyAsRead").then(response =>{
                       window.location.href=  window.location.protocol+"//"+window.location.hostname+"/allReadCorpseNofication";
                      //  window.location.href="allReadCorpseNofication";
                    });
         }


          }
    //     mounted() {
    //     Echo.join(`users`)
    // .here((users) => {
    //     //
    // })
    // .joining((user) => {
    //     console.log(user.name);
    // })
    // .leaving((user) => {
    //     console.log(user.name);
    // });



    //     }
    }
</script>z
