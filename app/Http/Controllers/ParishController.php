<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Corpse;
use App\Commendation ;
use App\Catcommendation;
use Validator;
use Response;
use Illuminate\Support\Facades\Input;
use App\http\Requests;
use Session;
use App\Rank;
use Illuminate\Support\Facades\Redirect;
use App\Parish;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Cache;
class ParishController extends  Controller
{


    public function __construct() {
        $this->middleware(['auth', 'isAdmin']);
    }


    /**
     * Display a listing of the Parish.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {    
        $parishs = cache()->remember('Caches_key_parishes',Session::get('caches_time'), function () {
            return   Parish::get();//Parish:: paginate(10);
        });
   
        return view('parishes.index')->with('parishes',$parishs);
    }

    /**
     * Show the form for creating a new Parish.
     *
     * @return Response
     */
    public function create()
    {
        return view('parishes.create');
    }

    /**
     * Store a newly created Parish in storage.
     *
     * @param CreateParishRequest $request
     *
     * @return Response
   */
    public function store(Request $request){
        $this->validate($request, [
         'parish' =>  'required|min:3|max:30|unique:parishes,parish'

         ]);

         $parish = new Parish;
         $parish->parish= $request->parish;
         $parish->user_id= $request->user_id = auth()->user()->id;
         $parish->modify_by = 0;//$request->modify_by = 0;
         $parish->save();

         Session::flash('success','Parish added successfully.');

        return redirect(route('parishes.index'));
    }

    /**
     * Display the specified Parish.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
       $parish = Parish::find($id);
        if (empty($parish)) {
            Session::flash('error','Parish not found');
            return redirect(route('parishes.index'));
        }
        return view('parishes.show')->with('parish',$parish);
    }

    /**
     * Show the form for editing the specified parish.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {

       $parish = Parish::find($id);

        if (empty($parish)) {
            Session::flash('error','Parish not found');
            return redirect(route('parishes.index'));
        }           
     
        return view('parishes.edit')->with('parish',$parish);
    }

    /**
     * Update the specified Parish in storage.
     *
     * @param  int              $id
     * @param UpdateParishRequest $request
     *
     * @return Response
     */
    public function update(Request $request, $id){


       $parish = Parish::find($id);
        if (empty($parish)) {
            Session::flash('error','Parish not found');
            return redirect(route('parishes.index'));
        }
       $parish->parish= $request->parish;
       $parish->modify_by = $request->modify_by = auth()->user()->id;
       $parish->save();

       Cache::forget('Caches_key_parishes');
       Cache::forget('cache_key_parish_corpse_index');
       Cache::forget('cache_key_parish_corpse_division'); 

       Session::flash('success','Parish updated successfully.');
        return redirect(route('parishes.index'));
    }

    /**
     * Remove the specified Parish from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {

       $parish = Parish::find($id);

        if (empty($parish)) {
            Session::flash('error','Parish not found');

            return redirect(route('parishes.index'));
        }
           ////////////////////
           $chech_if_Id_InUse=null;
           $corpses =Corpse::where('parish',$id)->get();
           foreach ($corpses as $corpse) {
              $chech_if_Id_InUse= $corpse;
           }
           
           if (!empty($chech_if_Id_InUse)) {
               Session::flash('error','Entity integrity constraints Enforces, Cannot be deleted !');
               return redirect(route('parishes.index'));
           }  
           /////////////////////////
       $parish->delete($id);

       Session::flash('success','Parish deleted successfully.');

       Cache::forget('Caches_key_parishes');
       Cache::forget('cache_key_parish_corpse_index');
       Cache::forget('cache_key_parish_corpse_division'); 

        return redirect(route('parishes.index'));
    }
}
