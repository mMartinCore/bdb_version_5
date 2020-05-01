<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Validator;
use Response;
use App\Corpse;
use Illuminate\Support\Facades\Input;
use App\http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Station;
use App\Division;
use Prettus\Repository\Criteria\RequestCriteria;

class StationController extends  Controller
{
    public function __construct() {
        $this->middleware(['auth', 'isAdmin']);
    }

    public function index(Request $request)    {
        $divisions= Division::get();
        $stations =  Station::paginate(10);
        return view('stations.index')->withStations($stations)->withDivisions($divisions);
    }

    /**
     * Show the form for creating a new Station.
     *
     * @return Response
     */
    public function create()
    {
        $divisions= Division::get();
        return view('stations.create')->withDivisions($divisions);
    }

    /**
     *
     *
     * @param CreateStationRequest $request
     *
     * @return Response
   */
    public function store(Request $request){
        $this->validate($request, [
         'station' =>  'required|min:3|max:30|unique:stations,station',
         'stationCode' =>  'required|min:2|max:10|unique:stations,stationCode',
         'division_id' => 'integer',
         ]);

          $station = new Station();
          $station->station= $request->station;
          $station->stationCode= $request->stationCode;
          $station->division_id= $request->division_id;
          $station->user_id=$request->user_id = auth()->user()->id;
          $station->modify_by =0;// $request->modify_by = 0;
          $station->save();

         Session::flash('success','Station added successfully.');

        return redirect(route('stations.index'));
    }

    /**
     * Display the specified Station.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $station = Station::find($id);
        if (empty($station)) {
            Session::flash('error','Station not found');
            return redirect(route('stations.index'));
        }
        $divisions= Division::get();
        return view('stations.show')->withStation($station)->withDivisions($divisions);
    }

    /**
     * Show the form for editing the specified station.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $station = Station::find($id);

        if (empty($station)) {
            Session::flash('error','Station not found');

            return redirect(route('stations.index'));
        }

        $divisions= Division::get();
        return view('stations.edit')->withStation($station)->withDivisions($divisions);
    }

    /**
     * Update the specified stations in storage.
     *
     * @param  int              $id
     * @param UpdateDivisionRequest $request
     *
     * @return Response
     */
    public function update(Request $request, $id){

        $this->validate($request, [
            'station' =>  'required|min:3|max:30',
            'stationCode' =>  'required|min:2|max:10',
            'division_id' => 'integer',
            ]);


        $station = Station::find($id);
        if (empty($station)) {
            Session::flash('error','Station not found');
            return redirect(route('stations.index'));
        }
        $station->station= $request->station;
        $station->stationCode= $request->stationCode;
        $station->division_id= $request->division_id;
        $station->modify_by = $request->modify_by = auth()->user()->id;
        $station->save();

       Session::flash('success','Station updated successfully.');
        return redirect(route('stations.index'));
    }

    /**
     * Remove the specified station from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {

        $station = Station::find($id);

        if (empty($station)) {
            Session::flash('error','Station not found');

            return redirect(route('stations.index'));
        }
       ////////////////////
       $chech_if_Id_InUse=null;
       $corpses =Corpse::where('station_id',$id)->get();
       foreach ($corpses as $corpse) {
          $chech_if_Id_InUse= $corpse;
       }
       
       if (!empty($chech_if_Id_InUse)) {
           Session::flash('error','Entity integrity constraints Enforces, Cannot be deleted !');
           return redirect(route('stations.index'));
       }  
       /////////////////////////
        $station->delete($id);

       Session::flash('success','Station deleted successfully.');

        return redirect(route('stations.index'));
    }
}
