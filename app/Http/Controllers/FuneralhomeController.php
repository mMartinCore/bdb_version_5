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
use App\Funeralhome;
use Prettus\Repository\Criteria\RequestCriteria;

class FuneralhomeController  extends  Controller
{

    public function __construct() {
        $this->middleware(['auth', 'isAdmin']);
    }
    /**
     * Display a listing of the Funeralhome.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $funeralhomes =  Funeralhome::paginate(10);

        return view('funeralhomes.index')->with('funeralhomes', $funeralhomes);
    }

    /**
     * Show the form for creating a new Funeralhome.
     *
     * @return Response
     */
    public function create()
    {
        return view('funeralhomes.create');
    }

    /**
     * Store a newly created Funeralhome in storage.
     *
     * @param CreateDivisionRequest $request
     *
     * @return Response
   */
    public function store(Request $request){
        $this->validate($request, [
         'funeralhome' =>  'required|min:3|max:30|unique:funeralhomes,funeralhome'

         ]);

         $funeralhome = new Funeralhome;
         $funeralhome->funeralhome= $request->funeralhome;
         $funeralhome->user_id=$request->user_id = auth()->user()->id;
         $funeralhome->modify_by = $request->modify_by = 0;
         $funeralhome->save();

         Session::flash('success','Funeral Home added successfully.');

        return redirect(route('funeralhomes.index'));
    }

    /**
     * Display the specified Funeralhome.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
       $funeralhome = Funeralhome::find($id);
        if (empty($funeralhome)) {
            Session::flash('error','Funeral Home not found');
            return redirect(route('funeralhomes.index'));
        }
        return view('funeralhomes.show')->with('funeralhome',$funeralhome);
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
       $funeralhome = Funeralhome::find($id);

        if (empty($funeralhome)) {
            Session::flash('error','Funeral home not found');

            return redirect(route('funeralhomes.index'));
        }

        return view('funeralhomes.edit')->with('funeralhome',$funeralhome);
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
       $funeralhome = Funeralhome::find($id);
        if (empty($funeralhome)) {
            Session::flash('error','Funeral home not found');
            return redirect(route('divisions.index'));
        }
       $funeralhome->funeralhome= $request->funeralhome;
       $funeralhome->modify_by = $request->modify_by = auth()->user()->id;
       $funeralhome->save();

       Session::flash('success','Funeral home updated successfully.');
        return redirect(route('funeralhomes.index'));
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

       $funeralhome = Funeralhome::find($id);

        if (empty($funeralhome)) {
            Session::flash('error','Funeral home not found');

            return redirect(route('funeralhomes.index'));
        }

              ////////////////////
              $chech_if_Id_InUse=null;
              $corpses =Corpse::where('funeralhome_id',$id)->get();
              foreach ($corpses as $corpse) {
                 $chech_if_Id_InUse= $corpse;
              }
              
              if (!empty($chech_if_Id_InUse)) {
                  Session::flash('error','Entity integrity constraints Enforces, Cannot be deleted !');
                  return redirect(route('funeralhomes.index'));
              }  
              /////////////////////////
       $funeralhome->delete($id);

       Session::flash('success','Funeral home deleted successfully.');

        return redirect(route('funeralhomes.index'));
    }
}
