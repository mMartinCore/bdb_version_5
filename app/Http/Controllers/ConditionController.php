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
use App\Condition;
use Prettus\Repository\Criteria\RequestCriteria;

class ConditionController  extends  Controller
{

    public function __construct() {
        $this->middleware(['auth', 'isAdmin']);
    }
    /**
     * Display a listing of the condition.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $conditions =  Condition::paginate(10);

        return view('conditions.index')->with('conditions', $conditions);
    }

    /**
     * Show the form for creating a new Condition.
     *
     * @return Response
     */
    public function create()
    {
        return view('conditions.create');
    }

    /**
     * Store a newly created Condition in storage.
     *
     * @param CreateDivisionRequest $request
     *
     * @return Response
   */
    public function store(Request $request){
        $this->validate($request, [
         'condition' =>  'required|min:3|max:30|unique:conditions,condition'

         ]);

         $condition = new Condition;
         $condition->condition= $request->condition;
         $condition->user_id=$request->user_id = auth()->user()->id;
         $condition->modify_by = $request->modify_by = 0;
         $condition->save();

         Session::flash('success','Condition  added successfully.');

        return redirect(route('conditions.index'));
    }

    /**
     * Display the specified condition.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
       $condition = Condition::findOrFail($id);
        if (empty($condition)) {
            Session::flash('error','Condition  not found');
            return redirect(route('conditions.index'));
        }
        return view('conditions.show')->with('condition',$condition);
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
       $condition = Condition::findOrFail($id);

        if (empty($condition)) {
            Session::flash('error','Condition  not found');

            return redirect(route('conditions.index'));
        }

        return view('conditions.edit')->with('condition',$condition);
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
       $condition = Condition::findOrFail($id);
        if (empty($condition)) {
            Session::flash('error','Condition  not found');
            return redirect(route('divisions.index'));
        }
       $condition->condition= $request->condition;
       $condition->modify_by = $request->modify_by = auth()->user()->id;
       $condition->save();

       Session::flash('success','Condition  updated successfully.');
        return redirect(route('conditions.index'));
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

       $condition = Condition::findOrFail($id);

        if (empty($condition)) {
            Session::flash('error','Condition  not found');

            return redirect(route('conditions.index'));
        }
////////////////////
        $chech_if_Id_InUse=null;
        $corpses =Corpse::where('condition_id',$id)->get();
        foreach ($corpses as $corpse) {
           $chech_if_Id_InUse= $corpse;
        }
        
        if (!empty($chech_if_Id_InUse)) {
            Session::flash('error','Entity integrity constraints Enforces, Cannot be deleted !');
            return redirect(route('conditions.index'));
        }  
/////////////////////////
       $condition->delete($id);

       Session::flash('success','Condition  deleted successfully.');

        return redirect(route('conditions.index'));
    }
}
