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
use App\Manner;
use Prettus\Repository\Criteria\RequestCriteria;

class MannerController  extends  Controller
{

    public function __construct() {
        $this->middleware(['auth', 'isAdmin']);
    }
    /**
     * Display a listing of the manner.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $manners = Manner::paginate(10);

        return view('manners.index')->with('manners', $manners);
    }

    /**
     * Show the form for creating a newManner.
     *
     * @return Response
     */
    public function create()
    {
        return view('manners.create');
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
         'manner' =>  'required|min:3|max:30|unique:manners,manner'

         ]);

         $manner = new Manner;
         $manner->manner= $request->manner;
         $manner->user_id=$request->user_id = auth()->user()->id;
         $manner->modify_by = $request->modify_by = 0;
         $manner->save();

         Session::flash('success','Manner  added successfully.');

        return redirect(route('manners.index'));
    }

    /**
     * Display the specified manner.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
       $manner =Manner::findOrFail($id);
        if (empty($manner)) {
            Session::flash('error','Manner  not found');
            return redirect(route('manners.index'));
        }
        return view('manners.show')->with('manner',$manner);
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
       $manner =Manner::findOrFail($id);

        if (empty($manner)) {
            Session::flash('error','Manner  not found');

            return redirect(route('manners.index'));
        }

        return view('manners.edit')->with('manner',$manner);
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
       $manner =Manner::findOrFail($id);
        if (empty($manner)) {
            Session::flash('error','Manner  not found');
            return redirect(route('divisions.index'));
        }
       $manner->manner= $request->manner;
       $manner->modify_by = $request->modify_by = auth()->user()->id;
       $manner->save();

       Session::flash('success','Manner  updated successfully.');
        return redirect(route('manners.index'));
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

       $manner =Manner::findOrFail($id);

        if (empty($manner)) {
            Session::flash('error','Manner  not found');

            return redirect(route('manners.index'));
        }
        
              ////////////////////
              $chech_if_Id_InUse=null;
              $corpses =Corpse::where('manner_id',$id)->get();
              foreach ($corpses as $corpse) {
                 $chech_if_Id_InUse= $corpse;
              }
              
              if (!empty($chech_if_Id_InUse)) {
                  Session::flash('error','Entity integrity constraints Enforces, Cannot be deleted !');
                  return redirect(route('manners.index'));
              }  
              /////////////////////////

       $manner->delete($id);

       Session::flash('success','Manner  deleted successfully.');

        return redirect(route('manners.index'));
    }
}
