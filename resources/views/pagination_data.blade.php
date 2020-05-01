 
     
           <?php
 

   function anatomy( $id)   {
       $anatom =App\Anatomy::findOrfail($id);
       return   $anatom->anatomy; 
   }
   
   function division( $id)   {
       $division =App\Division::findOrfail($id);
       return   $division->division; 
   }
   
   
   
   
   function storageday($pickupDate,$burialDate )
             {
                 $pickup_date = Carbon\Carbon::parse($pickupDate);
                 $burial_date = Carbon\Carbon::parse($burialDate);
         
                 $now = Carbon\Carbon::now();
                 if (  $burialDate !='' || $burialDate !=null ) {
                   return  $burial_date->diffInDays( $pickup_date );
                 }else{
                     $pickup_date = Carbon\Carbon::parse($pickupDate);
                     return $now->diffInDays( $pickup_date );
                 }
             }
         ?>
             @foreach ($corpses as $corpse)
             <?php

                   
                         $storagedays = storageday($corpse->pickup_date, $corpse->burial_date);
                     if ($storagedays >= 30 && $corpse->burial_date == '') {
         
                         if ($storagedays > 30) {
         
                             $excess = $storagedays - 30;
         
         
                             if ($excess > 0) {
                             } else {
                                 $excess = 0;
                             }
                         } else {
                             $excess = 0;
                         }
         
                         // $overThirty=
                     } elseif ( $storagedays <= 30 && $corpse->burial_date =='') {
                         $excess = 0;
                         $storagedays = $storagedays;
                     }else{
                         $excess = 0;
                     }
         
         
                     if ($corpse->first_name == "Unidentified") {
         
                         if ($corpse->suspected_name != '')
                             $name = '*' . ucfirst($corpse->suspected_name). '*';
                         else {
                             $name = 'Unidentified';
                         }
                     } else {
                         $name = ucfirst($corpse->first_name) . ' ' . ucfirst($corpse->middle_name). ' ' . ucfirst($corpse->last_name);
                     }
         
                      
              ?>
               <tr>
                 <td><a class="btn showViewModal btn-success btn-xs"   onclick="getViewId( {{$corpse->id}});" > {{$corpse->id }}</a></td>
                 <td> {{$name }} </td>
                 <td> {{$corpse->death_date}}  </td>
                 <td> {{$corpse->pickup_date}}  </td>
                 <td> {{ anatomy($corpse->anatomy_id)}}  </td>
                 <td>{{ $corpse->postmortem_status }} </td>
                 <td> {{division($corpse->division_id)}} </td> 
                 <td>{{ $corpse->pauper_burial_requested}}  </td>
                 <td> {{$corpse->pauper_burial_approved }} </td>
                 <td> {{$corpse->buried}}  </td>
                 <td> {{$storagedays }} </td>
                 <td>{{ $excess }} </td>
                 <td>
             <div class="btn-group no">
                    @hasrole('SuperAdmin|Admin|writer')
                       <a href="corpses/{{ $corpse->id}}/edit" class="btn btn-primary btn-xs "><i class="glyphicon glyphicon-edit"></i></a>
                     @endrole
                 @hasrole('SuperAdmin')
                        <a  href="#"  class="btn btn-danger  btn-xs " onclick="getId( {{$corpse->id }} );" >    <i class="glyphicon glyphicon-trash"></i></a>
                 @endrole
             </div>
             
             </td>
     
              @endforeach
      <tr>
       <td colspan="13" align="center">
       <span class="pull-left"><small>Results : <b> {{$total_records}}</small></b></span>   <small>        {!! $corpses->links() !!}</small>
       </td>
      </tr>
