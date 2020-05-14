<?php

namespace App\Providers;

// use App\Division;
// use App\Status;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\view;
use Session;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Session::put('caches_time',1146);
        Schema::defaultStringLength(191);
    //  view::share('status',Status::all());
      //view::share('divisions',Division::all());
//      view::composer(['officers.profile'],
  //                  function($view){
    //                    $view->with('status',Status::all())->with('divisions',Division::all());
//
  //                  });
    }


    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
