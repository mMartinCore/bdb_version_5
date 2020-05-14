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
use App\Anatomy;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Cache;
class AnatomyController  extends  Controller
{

    public function __construct() {
        $this->middleware(['auth', 'isAdmin']);
    }
    /**
     * Display a listing of the anatomy.
     *
     * @param Request $request
     * @return Response
     */

     
    public function clearCaches(){  
        Cache::forget('Caches_key_corpse_create_Anatomy'); 
        Cache::forget('Caches_key_corpse_edit_Anatomy');  
        Cache::forget('Caches_key_corpse_index_Anatomy');          
    }   

    public function index(Request $request)
    {

        $anatomies = Anatomy::paginate(10);

        return view('anatomies.index')->with('anatomies', $anatomies);
    }

    /**
     * Show the form for creating a newManner.
     *
     * @return Response
     */
    public function create()
    {
        return view('anatomies.create');
    }

    /**
     * Store a newly createdManner in storage.
     *
     * @param CreateDivisionRequest $request
     *
     * @return Response
   */
    public function store(Request $request){
        $this->validate($request, [
         'anatomy' =>  'required|min:3|max:30|unique:anatomies,anatomy'

         ]);

         $anatomy = new Anatomy;
         $anatomy->anatomy= $request->anatomy;
         $anatomy->user_id=$request->user_id = auth()->user()->id;
         $anatomy->modify_by = $request->modify_by = 0;
         $anatomy->save();
         $this->clearCaches(); 
         Session::flash('success','Anatomy  added successfully.');

        return redirect(route('anatomies.index'));
    }

    /**
     * Display the specified anatomy.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
       $anatomy =Anatomy::findOrFail($id);
        if (empty($anatomy)) {
            Session::flash('error','Anatomy  not found');
            return redirect(route('anatomies.index'));
        }
        return view('anatomies.show')->with('anatomy',$anatomy);
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
       $anatomy =Anatomy::findOrFail($id);

        if (empty($anatomy)) {
            Session::flash('error','Anatomy  not found');

            return redirect(route('anatomies.index'));
        }

        return view('anatomies.edit')->with('anatomy',$anatomy);
    }

    /**
     *  .
     *
     * @param  int              $id
     * @param UpdateDivisionRequest $request
     *
     * @return Response
     */
    public function update(Request $request, $id){
       $anatomy =Anatomy::findOrFail($id);
        if (empty($anatomy)) {
            Session::flash('error','Anatomy  not found');
            return redirect(route('divisions.index'));
        }
       $anatomy->anatomy= $request->anatomy;
       $anatomy->modify_by = $request->modify_by = auth()->user()->id;
       $anatomy->save();
       $this->clearCaches(); 
       Session::flash('success','Anatomy  updated successfully.');
        return redirect(route('anatomies.index'));
    }

    /**
     *
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {

       $anatomy =Anatomy::findOrFail($id);
       
        if (empty($anatomy)) {
            Session::flash('error','Anatomy  not found');

            return redirect(route('anatomies.index'));
        }
        $chech_if_Id_InUse=null;
        $corpses =Corpse::where('anatomy_id',$id)->get();
        foreach ($corpses as $corpse) {
           $chech_if_Id_InUse= $corpse;
        }
        
        if (!empty($chech_if_Id_InUse)) {
            Session::flash('error','Entity integrity constraints Enforces, Cannot be deleted !');
            return redirect(route('anatomies.index'));
        }  
        
       $anatomy->delete($id);
       $this->clearCaches(); 
       Session::flash('success','Anatomy  deleted successfully.');
       return redirect(route('anatomies.index'));
    }
}
