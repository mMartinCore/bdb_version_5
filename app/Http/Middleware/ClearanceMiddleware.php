<?php

namespace App\Http\Middleware;
use Redirect;
use Closure;
use Illuminate\Support\Facades\Auth;

class ClearanceMiddleware {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
          //check here if the user is authenticated
    if ( !Auth::check())
    {
      return redirect()->route('login');
    }
   


            if ($request->is('corpses/create')) 
            {   if (!Auth::user()->hasPermissionTo('Administer roles & permissions') ) {
                if( !Auth::user()->hasPermissionTo('Admin')){
                        if (!Auth::user()->hasPermissionTo('write'))
                        {
                            abort('401');
                        }
                        else {
                            return $next($request);
                        }
                    }
                }
            } 
            

            if ($request->is('users/create')) 
            {   if (!Auth::user()->hasPermissionTo('Administer roles & permissions') ) {
                if( !Auth::user()->hasPermissionTo('Admin')){
                              abort('401');
                       
                    }
                }
            } 
            


            if ($request->isMethod('Delete')) //If user is deleting a  corpses
            {
               if (!Auth::user()->hasPermissionTo('Delete')) {
                   abort('401');
               }
            else
            {
                   return $next($request);
               }
           }

           
 

        if ($request->is('corpses/*/edit')) 
        {   if (!Auth::user()->hasPermissionTo('Administer roles & permissions') ) {
            if( !Auth::user()->hasPermissionTo('Admin')){
                    if (!Auth::user()->hasPermissionTo('write'))
                    {
                        abort('401');
                    }
                    else {
                        return $next($request);
                    }
                }
            }
        } 
        









        if ($request->is('users')) 
        {   if (!Auth::user()->hasPermissionTo('Administer roles & permissions') ) {
            if( !Auth::user()->hasPermissionTo('Admin')){                
                        abort('401');       
                    
                }
            }
        } 
         

        if ($request->is('users/create')) 
        {   if (!Auth::user()->hasPermissionTo('Administer roles & permissions') ) {
            if( !Auth::user()->hasPermissionTo('Admin')){                
                        abort('401');       
                    
                }
            }
        } 
        

   

       if ($request->is('corpses')) 
       {   if (!Auth::user()->hasPermissionTo('Administer roles & permissions') ) {
           if( !Auth::user()->hasPermissionTo('Admin')){
                   if (!Auth::user()->hasPermissionTo('view'))
                   {
                       abort('401');
                   }
                   else {
                       return $next($request);
                   }
               }
           }
       } 
       






       if ($request->is('thirtyDaylist')) 
       {   if (!Auth::user()->hasPermissionTo('Administer roles & permissions') ) {
           if( !Auth::user()->hasPermissionTo('Admin')){
                   if (!Auth::user()->hasPermissionTo('view'))
                   {
                       abort('401');
                   }
                   else {
                       return $next($request);
                   }
               }
           }
       } 

 
       if ($request->is('approve')) 
       {   if (!Auth::user()->hasPermissionTo('Administer roles & permissions') ) {
           if( !Auth::user()->hasPermissionTo('Admin')){
                   if (!Auth::user()->hasPermissionTo('view'))
                   {
                       abort('401');
                   }
                   else {
                       return $next($request);
                   }
               }
           }
       } 

       if ($request->is('noRequest')) 
       {   if (!Auth::user()->hasPermissionTo('Administer roles & permissions') ) {
           if( !Auth::user()->hasPermissionTo('Admin')){
                   if (!Auth::user()->hasPermissionTo('view'))
                   {
                       abort('401');
                   }
                   else {
                       return $next($request);
                   }
               }
           }
       } 
       if ($request->is('notApprove')) 
       {   if (!Auth::user()->hasPermissionTo('Administer roles & permissions') ) {
           if( !Auth::user()->hasPermissionTo('Admin')){
                   if (!Auth::user()->hasPermissionTo('view'))
                   {
                       abort('401');
                   }
                   else {
                       return $next($request);
                   }
               }
           }
       } 

 
       if ($request->is('allReadCorpseNofication')) 
       {   if (!Auth::user()->hasPermissionTo('Administer roles & permissions') ) {
           if( !Auth::user()->hasPermissionTo('Admin')){
                   if (!Auth::user()->hasPermissionTo('view'))
                   {
                       abort('401');
                   }
                   else {
                       return $next($request);
                   }
               }
           }
       } 


 

 
   


//   if ($request->is('/readNewCorpseNotify')) //If user is editing a  corpses
//   {
//      if (!Auth::user()->hasPermissionTo('view')) {
//          abort('401');
//      } else {
//          return $next($request);
//      }
//  }




        return $next($request);
    }
}
