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
use App\Division;
use App\Investigator;
use App\User;
use Prettus\Repository\Criteria\RequestCriteria;

class RanksController extends  Controller
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
    public function index(Request $request)
    {

        $ranks =  Rank::paginate(10);

        return view('ranks.index')            ->with('ranks', $ranks);
    }

    /**
     * Show the form for creating a new Division.
     *
     * @return Response
     */
    public function create()
    {
        return view('ranks.create');
    }

    /**
     * Store a newly created Division in storage.
     *
     * @param CreateRankRequest $request
     *
     * @return Response
   */
    public function store(Request $request){
        $this->validate($request, [
         'rank' =>  'required|min:3|max:30|unique:ranks,rank'

         ]);

         $rank = new Rank;
         $rank->rank= $request->rank;
         $rank->user_id=$request->user_id = auth()->user()->id;
         $rank->modify_by = 0;// $request->modify_by = 0;
         $rank->save();

         Session::flash('success','Rank added successfully.');

        return redirect(route('ranks.index'));
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
       $rank = Rank::find($id);
        if (empty($rank)) {
            Session::flash('error','Rank not found');
            return redirect(route('ranks.index'));
        }
        return view('ranks.show')->with('rank',$rank);
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
       $rank = Rank::find($id);

        if (empty($rank)) {
            Session::flash('error','rank not found');

            return redirect(route('ranks.index'));
        }

        return view('ranks.edit')->with('rank',$rank);
    }

    /**
     * Update the specified Division in storage.
     *
     * @param  int              $id
     * @param UpdateRankRequest $request
     *
     * @return Response
     */
    public function update(Request $request, $id){


       $rank = Rank::find($id);
        if (empty($rank)) {
            Session::flash('error','Rank not found');
            return redirect(route('ranks.index'));
        }
       $rank->rank= $request->rank;
       $rank->modify_by = $request->modify_by = auth()->user()->id;
       $rank->save();

       Session::flash('success','Rank updated successfully.');
        return redirect(route('ranks.index'));
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

       $rank = Rank::find($id);

        if (empty($rank)) {
            Session::flash('error','rank not found');

            return redirect(route('ranks.index'));
        }
       ////////////////////
       $chech_if_Id_InUse=null;
       $chech_if_Id_InUse2=null;
       $corpses =User::where('rank_id',$id)->get();
       $corpses2 =Investigator::where('rank_id',$id)->get();

       foreach ($corpses as $corpse) {
          $chech_if_Id_InUse= $corpse;
       }

       if (!empty($chech_if_Id_InUse)) {
            Session::flash('error','Entity integrity constraints Enforces, Cannot be deleted !');
        return redirect(route('ranks.index'));
    }  

       foreach ($corpses2 as $corpse) {
        $chech_if_Id_InUse2= $corpse;
        }
     
  
       if (!empty($chech_if_Id_InUse2)) {
            Session::flash('error','Entity integrity constraints Enforces, Cannot be deleted !');
            return redirect(route('ranks.index'));
    }  
       /////////////////////////
      $rank->delete($id);

       Session::flash('success','rank deleted successfully.');

        return redirect(route('ranks.index'));
    }
}
