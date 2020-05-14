<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

         //check here if the user is authenticated
       if ( !Auth::check())
         {
           return redirect()->route('login');
         }



         if ($request->is('ranks/create')) 
         {   if (!Auth::user()->hasPermissionTo('Administer roles & permissions') ) {                         
                         abort('401');      
              }
         } 
         
         if ($request->is('ranks/*/edit')) 
         {   if (!Auth::user()->hasPermissionTo('Administer roles & permissions') ) {                         
                         abort('401');      
              }
         } 
         if ($request->is('ranks')) 
         {   if (!Auth::user()->hasPermissionTo('Administer roles & permissions') ) {                         
                         abort('401');      
              }
         } 
         
 
 


         if ($request->is('parishes/create')) 
         {   if (!Auth::user()->hasPermissionTo('Administer roles & permissions') ) {                         
                         abort('401');      
              }
         } 
         
         if ($request->is('parishes/*/edit')) 
         {   if (!Auth::user()->hasPermissionTo('Administer roles & permissions') ) {                         
                         abort('401');      
              }
         } 
         if ($request->is('parishes')) 
         {   if (!Auth::user()->hasPermissionTo('Administer roles & permissions') ) {                         
                         abort('401');      
              }
         } 
         



         if ($request->is('anatomies/create')) 
         {   if (!Auth::user()->hasPermissionTo('Administer roles & permissions') ) {                         
                         abort('401');      
              }
         } 
         
         if ($request->is('anatomies/*/edit')) 
         {   if (!Auth::user()->hasPermissionTo('Administer roles & permissions') ) {                         
                         abort('401');      
              }
         } 
         if ($request->is('anatomies')) 
         {   if (!Auth::user()->hasPermissionTo('Administer roles & permissions') ) {                         
                         abort('401');      
              }
         } 
         


         if ($request->is('divisions/create')) 
         {   if (!Auth::user()->hasPermissionTo('Administer roles & permissions') ) {                         
                         abort('401');      
              }
         } 
         
         if ($request->is('divisions/*/edit')) 
         {   if (!Auth::user()->hasPermissionTo('Administer roles & permissions') ) {                         
                         abort('401');      
              }
         } 
         if ($request->is('divisions')) 
         {   if (!Auth::user()->hasPermissionTo('Administer roles & permissions') ) {                         
                         abort('401');      
              }
         } 
         






         if ($request->is('funeralhomes/create')) 
         {   if (!Auth::user()->hasPermissionTo('Administer roles & permissions') ) {                         
                         abort('401');      
              }
         } 
         
         if ($request->is('funeralhomes/*/edit')) 
         {   if (!Auth::user()->hasPermissionTo('Administer roles & permissions') ) {                         
                         abort('401');      
              }
         } 
         if ($request->is('funeralhomes')) 
         {   if (!Auth::user()->hasPermissionTo('Administer roles & permissions') ) {                         
                         abort('401');      
              }
         } 
         

         if ($request->is('feedbacks/*/edit')) 
         {   if (!Auth::user()->hasPermissionTo('Administer roles & permissions') ) {                         
                         abort('401');      
              }
         } 
         if ($request->is('feedbacks')) 
         {   if (!Auth::user()->hasPermissionTo('Administer roles & permissions') ) {                         
                         abort('401');      
              }
         }





         if ($request->is('manners/create')) 
         {   if (!Auth::user()->hasPermissionTo('Administer roles & permissions') ) {                         
                         abort('401');      
              }
         } 
         
         if ($request->is('manners/*/edit')) 
         {   if (!Auth::user()->hasPermissionTo('Administer roles & permissions') ) {                         
                         abort('401');      
              }
         } 
         if ($request->is('manners')) 
         {   if (!Auth::user()->hasPermissionTo('Administer roles & permissions') ) {                         
                         abort('401');      
              }
         } 
         





         if ($request->is('permissions/create')) 
         {   if (!Auth::user()->hasPermissionTo('Administer roles & permissions') ) {                         
                         abort('401');      
              }
         } 
         
         if ($request->is('permissions/*/edit')) 
         {   if (!Auth::user()->hasPermissionTo('Administer roles & permissions') ) {                         
                         abort('401');      
              }
         } 
         if ($request->is('permissions')) 
         {   if (!Auth::user()->hasPermissionTo('Administer roles & permissions') ) {                         
                         abort('401');      
              }
         } 
         



         if ($request->is('roles/create')) 
         {   if (!Auth::user()->hasPermissionTo('Administer roles & permissions') ) {                         
                         abort('401');      
              }
         } 
         
         if ($request->is('roles/*/edit')) 
         {   if (!Auth::user()->hasPermissionTo('Administer roles & permissions') ) {                         
                         abort('401');      
              }
         } 
         if ($request->is('roles')) 
         {   if (!Auth::user()->hasPermissionTo('Administer roles & permissions') ) {                         
                         abort('401');      
              }
         } 
         


         if ($request->is('stations/create')) 
         {   if (!Auth::user()->hasPermissionTo('Administer roles & permissions') ) {                         
                         abort('401');      
              }
         } 
         
         if ($request->is('stations/*/edit')) 
         {   if (!Auth::user()->hasPermissionTo('Administer roles & permissions') ) {                         
                         abort('401');      
              }
         } 
         if ($request->is('stations')) 
         {   if (!Auth::user()->hasPermissionTo('Administer roles & permissions') ) {                         
                         abort('401');      
              }
         } 
         



         if ($request->is('laravel-websockets')) 
         {   if (!Auth::user()->hasPermissionTo('Administer roles & permissions') ) {                         
                         abort(403);      
              }
         } 
         


 


     //    $user = User::all()->count();
     //    if (!($user == 1)) {
           
     //        if (!Auth::user()->hasPermissionTo('Administer roles & permissions')) //If user does //not have this permission
     //         {


     //          }
     //    }



 
   
         return $next($request);   
    }
}
