<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
use App\Division;
use App\Parish;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Cache;
class DivisionController extends  Controller
{

    public function __construct() {
        $this->middleware(['auth', 'isAdmin']);
    }


    /**
     * Display a listing of the Division.
     *
     * @param Request $request
     * @return Response
     */


    public function clearCaches(){
 
        Cache::forget('Caches_key_CorpseIndexDivision'); 
        Cache::forget('Caches_key_station_create_Division'); 
        Cache::forget('Caches_key_station_edit_Division'); 
        Cache::forget('Caches_key_station_show_Division'); 

        Cache::forget('Caches_key_corpse_index_Division');  
        
    }  


    public function index(Request $request)
    {

        $divisions =  Division:: paginate(10);

        return view('divisions.index', compact("divisions"));
    }

    /**
     * Show the form for creating a new Division.
     *
     * @return Response
     */
    public function create()
    {
         
        $parishes = cache()->remember('cache_key_parish_corpse_division',Session::get('caches_time'), function () {
            return   Parish::get();
        });
               
        return view('divisions.create')->with('parishes',$parishes);
    }

    /**
     * Store a newly created Division in storage.
     *
     * @param CreateDivisionRequest $request
     *
     * @return Response
   */
    public function store(Request $request){
        $this->validate($request, [
         'division' =>  'required|min:3|max:30|unique:divisions,division',
         'parish' =>  'required'
         ]);

          $division = new Division;
          $division->division= $request->division;
          $division->parish_id= $request->parish;
          $division->user_id= $request->user_id = auth()->user()->id;
          $division->modify_by = $request->modify_by = 0;
          $division->save();
          $this->clearCaches(); 
         Session::flash('success','Division added successfully.');

        return redirect(route('divisions.index'));
    }

    /**
     * Display the specified Division.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $division = Division::find($id);
        $parishes= Parish::get();
        if (empty($division)) {
            Session::flash('error','Division not found');
            return redirect(route('divisions.index'));
        }
        return view('divisions.show', compact("division","parishes") );;
    }

    /**
     * Show the form for editing the specified division.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $division = Division::find($id);
        $parishes= Parish::get();
        if (empty($division)) {
            Session::flash('error','Division not found');

            return redirect(route('divisions.index'));
        }

        return view('divisions.edit', compact("division","parishes") );;
    }

    /**
     * Update the specified Division in storage.
     *
     * @param  int              $id
     * @param UpdateDivisionRequest $request
     *
     * @return Response
     */
    public function update(Request $request, $id){

        $this->validate($request, [
            'division' =>  'required|min:3|max:30',
            'parish' =>  'required'
            ]);

        $division = Division::find($id);
        if (empty($division)) {
            Session::flash('error','Division not found');
            return redirect(route('divisions.index'));
        }
        $division->division= $request->division;
        $division->parish_id= $request->parish;
        $division->modify_by = $request->modify_by = auth()->user()->id;
        $division->save();
        $this->clearCaches(); 
       Session::flash('success','Division updated successfully.');
        return redirect(route('divisions.index'));
    }

    /**
     * Remove the specified Division from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {

        $division = Division::find($id);

        if (empty($division)) {
            Session::flash('error','Division not found');

            return redirect(route('divisions.index'));
        }


        ////////////////////
        $chech_if_Id_InUse=null;
        $corpses =Corpse::where('division_id',$id)->get();
        foreach ($corpses as $corpse) {
           $chech_if_Id_InUse= $corpse;
        }
        
        if (!empty($chech_if_Id_InUse)) {
            Session::flash('error','Entity integrity constraints Enforces, Cannot be deleted !');
            return redirect(route('divisions.index'));
        }  
        /////////////////////////


        $division->delete($id);
        $this->clearCaches(); 
       Session::flash('success','Division deleted successfully.');

        return redirect(route('divisions.index'));
    }
}
