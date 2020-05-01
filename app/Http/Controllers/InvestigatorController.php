<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Investigator;
use App\Station;
use App\Rank;
use Auth;

//Importing laravel-permission models

//Enables us to output flash messaging
use Session;


class InvestigatorController extends Controller
{

    public function __construct() {
        $this->middleware(['auth', 'isAdmin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Get all users and pass it to the view
        $investigators = Investigator::get();
        return view('investigators.index')->with('investigators', $investigators);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ranks = Rank::get();
        $stations = Station::get();
        return view('investigators.create')->withStations($stations)->withRanks($ranks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'investigator_first_name' => 'required|min:4|max:15',
            'investigator_last_name' => 'required|min:4|max:15',
            'rank_id' => 'required',
            'assign_date' => 'required|date',
            'contact_no' => 'min:5|max:10',
            'regNum' => 'required|min:3|max:6',
            'station_id' => 'required'
        ]);
       $investigator= new Investigator();
       $investigator->investigator_first_name = $request->input('investigator_first_name');
       $investigator->investigator_last_name=$request->input('investigator_last_name');
       $investigator->assign_date=$request->input('assign_date');
       $investigator->contact_no=$request->input('contact_no');
       $investigator->rank_id=$request->input('rank_id');
       $investigator->station_id=$request->input('station_id');
       $investigator->regNum=$request->input('regNum');
       $investigator->user_id=auth()->user()->id;
       $investigator->modified_by= 0;//auth()->investigator()->id;
       $investigator->corpse_id =  1;
       $investigator->save();
       return redirect()->route('investigators.index')->with('flash_message','Investigator successfully added.'    );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $investigator = investigator::findOrFail($id);
        if (empty($investigator)) {
            Session::flash('error','Investigator not found');
            return redirect(route('investigators.index'));
        }
        return view('investigators.show')->with('investigator', $investigator);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $stations = Station::get();
        $ranks = Rank::get();
        $investigator = investigator::findOrFail($id);
        return view('investigators.edit')->withInvestigator($investigator)->withStations($stations)->withRanks($ranks); //pass investigator and roles data to view

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $investigator = investigator::findOrFail($id); //Get role specified by id

        $this->validate($request, [
            'investigator_first_name' => 'required|min:4|max:15',
            'investigator_last_name' => 'required|min:4|max:15',
            'rank_id' => 'required',
            'assign_date' => 'required|date',
            'contact_no' => 'min:5|max:10',
            'regNum' => 'required|min:3|max:6',
            'station_id' => 'required'
        ]);

        $investigator->investigator_first_name = $request->input('investigator_first_name');
        $investigator->investigator_last_name=$request->input('investigator_last_name');
        $investigator->rank_id=$request->input('rank_id');
        $investigator->station_id=$request->input('station_id');
        $investigator->contact_no=$request->input('contact_no');
        $investigator->regNum=$request->input('regNum');

        $investigator->modified_by= auth()->user()->id;

        try{
        $investigator->save();
        }
        catch (\Throwable $th) {
            $error_array =['Error, Something occurred while deleting!'];
        }

        return redirect()->route('investigators.index')->with( 'flash_message','investigator successfully edited.' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(Request $request)
    {

        $validation = Validator::make($request->all(), [
            'id' => 'required'
        ]);

        $error_array = array();
        $success_output = '';
        if ($validation->fails()) {
            foreach ($validation->messages()->getMessages() as $field_name => $messages) {
                $error_array[] = $messages;
            }
        } else {
            try{
            $investigator = investigator::findOrFail($request->input('id'));
            $investigator->delete();
            $success_output = '<div class="alert alert-success"> Deleted Sucessfully! </div>';
             }
            catch (\Throwable $th) {
                $error_array =['Error, Something occurred while deleting!'];
            }

        }
        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output
        );

        echo json_encode($output);
    }
}
