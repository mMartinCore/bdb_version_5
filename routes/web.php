<?php
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Exceptions\customException;
use App\Catcommendation;


Route::group(['middleware' => 'revalidate'], function()
{
  Route::resource('ranks','RanksController');
  Route::get('/', 'HomeController@index')->name('home');
  Auth::routes();
    // Routes that you want to revalidate go in here

// Route::get('/create_role_permission',function(){
//   $role = Role::create(['name' => 'Administer ']);
//    $permission = Permission::create(['name' => 'Administer roles & permissions']);
//  auth()->user()->assignRole('Administer');
//  auth()->user()->givePermissionTo('Administer roles & permissions');
//  });





//  Route::get('/tesla',function(){  
//      return view("tesla");
//  });




 Route::get('/pagination', 'PaginationController@index');

 Route::get('/pagination/fetch_data', 'PaginationController@fetch_data');
 










    //Route::get('/',  'OfficersController@index')->name('home');
    Route::resource('corpses', 'CorpseController');
    Route::get('/getCorpse', 'CorpseController@getCorpse');


    Route::get('/export', 'CorpseController@export');
    Route::get('corpses/export/', 'CorpseController@export');


    Route::get('/dash', 'CorpseController@overThirtyDaysStats')->name('dash');
    Route::get('/dashboard', 'CorpseController@overThirtyDaysStats')->name('dashboard');

    Route::get('/', 'HomeController@overThirtyDaysStats')->name('dashboard');

    Route::get('corpses/delete/{id}', 'CorpseController@destroy')->name('corpses.delete');
    Route::GET('/getCorpse', 'CorpseController@getCorpse');
    Route::post('corpses/getCorpse', 'CorpseController@getCorpse')->name('corpses.getCorpse');
    Route::GET('/getCorpses', 'CorpseController@getCorpses');
    Route::resource('funeralhomes', 'FuneralhomeController');
    Route::resource('investigators', 'InvestigatorController');
    Route::resource('stations', 'StationController');
    Route::resource('divisions', 'DivisionController');
    Route::resource('parishes', 'ParishController');


    Route::resource('manners', 'MannerController');
    Route::resource('conditions', 'ConditionController');
    Route::resource('anatomies', 'AnatomyController');

    // Route::post('/notification/corpsenotification/notification','CorpseController@notifications')->name('notification');


    // I HAVE TO DOUBLE THE ROUTR TO ESCAPE ESPECIALLY WHEN I AM IN CREATE NODE
    Route::post('notification','CorpseController@notifications')->name('notification');
    Route::post('corpses/notification','CorpseController@notifications')->name('corpses.notification');
    Route::post('readNewCorpseNotify/notification','CorpseController@notifications')->name('readNewCorpseNotify.notification');

    Route::post('markAsRead','CorpseController@markAsRead')->name('markAsRead');

    Route::post('corpses/markAsRead','CorpseController@markAsRead')->name('corpses.markAsRead');

    Route::post('readNewCorpseNotify/markAsRead','CorpseController@markAsRead')->name('markAsRead');

    Route::get('readNewCorpseNotify/{id?}','CorpseController@readNewCorpse')->name('readNewCorpseNotify');
    Route::post('/markAllNewCorpseNotifyAsRead','CorpseController@markAllNewCorpseNotifyAsRead')->name('markAllNewCorpseNotifyAsRead');
    Route::get('allReadCorpseNofication','CorpseController@allReadCorpseNofication')->name('allReadCorpseNofication');



    Route::Post('/recentActivities','CorpseController@recentActivities')->name('recentActivities');

    Route::resource('feedbacks', 'FeedbackController');

    Route::get('charts', 'ChartController@index')->name('chart.index');
    Route::resource('users', 'UserController');

    //password reset
    // Route::get('password/reset/{token?}','Auth\ResetPasswordController@showResetForm');
    // Route::post('password/email','Auth\ResetPasswordController@sendResetLinkEmail');
    // Route::post('password/reset','Auth\ResetPasswordController@reset');



    Route::resource('roles', 'RoleController');
    Route::resource('permissions', 'PermissionController');
 //   Route::resource('skillscategories', 'CategorySkillsController', ['except' => ['create']]);
    Route::resource('isOnlines', 'OnlineusersController', ['except' => ['create']]);
    Route::post('corpses/task', 'CorpseController@taskPost')->name('corpses.task');
    

    Route::post('corpses/messageSuperAdmin', 'CorpseController@messageSuperAdmin')->name('corpses.messageSuperAdmin');
    // Route::get('/live_search', 'LiveSearch@index');
    // Route::get('/live_search/action', 'LiveSearch@action')->name('live_search.action');
    Route::get('/search/action', 'LiveSearchController2@action')->name('live_search.action');
    Route::get('/live_search/ajaxCall', 'LiveSearch@ajaxCall')->name('live_search.data');

    Route::post('corpses/getSummary', 'CorpseController@getSummary')->name('corpses.getSummary');// route
    Route::post('corpses/getTasks', 'CorpseController@getTasks')->name('corpses.getTasks');// route
    Route::post('corpses/getAllMessages', 'CorpseController@getAllMessages')->name('corpses.getAllMessages');// route
    
    Route::post('/getInvestigator', 'CorpseController@getInvestigator')->name('getInvestigator');// route
    Route::post('/getEditInvest_id', 'CorpseController@getEditInvest_id')->name('getEditInvest_id');// route


    Route::post('/checkUniqueCrNo', 'CorpseController@checkUniqueCrNo');

    Route::post('/updateInvest', 'CorpseController@updateInvest')->name('updateInvest');
    Route::post('/reassign', 'CorpseController@reassign')->name('reassign');
    Route::post('/deleteInvestigator', 'InvestigatorController@destroy')->name('deleteInvestigator');

    Route::post('corpses/editCorpse', 'CorpseController@editCorpse')->name('corpses.editCorpse');
    Route::post('corpses/postdata', 'CorpseController@postdata')->name('corpses.postdata');


    Route::post('corpses/makeRequest', 'CorpseController@makeRequest')->name('corpses.makeRequest');

    Route::post('/deny', 'CorpseController@deny')->name('deny');
    Route::post('corpses/deny', 'CorpseController@deny')->name('corpses.deny');
    Route::post('corpses/approved', 'CorpseController@approved')->name('corpses.approved');
    Route::get('/approve', 'CorpseController@approve')->name('corpses.approve');

    Route::get('/thirtyDaylist', 'CorpseController@thirtyDaylist')->name('corpses.thirtyDaylist');



    Route::get('/notApprove', 'CorpseController@notApprove')->name('corpses.notApprove');
    Route::get('/noRequest', 'CorpseController@noRequest')->name('corpses.noRequest');

    Route::get('mytask', 'CorpseController@callx');
    // Route::post('corpses/show', 'CorpseController@taskPost')->name('ta');


// Route::get('mail', 'UserController@mail');//test route


Route::group(['prefix' => 'laravel-crud-search-sort'], function () {
    Route::get('/', 'Crud2Controller@index');
    Route::match(['get', 'post'], 'create', 'Crud2Controller@create');
    Route::match(['get', 'put'], 'update/{id}', 'Crud2Controller@update');
    Route::delete('delete/{id}', 'Crud2Controller@delete');
});

    // Route::get('Exception\exception',function(){
    // return view('exception');

    //     });
        });

