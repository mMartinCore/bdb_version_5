<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Corpse;
 
use Validator;
use Response;
use Illuminate\Support\Facades\Input;
use App\http\Requests;
use Session;
 
use Illuminate\Support\Facades\Redirect; 
use App\Comment;
use Prettus\Repository\Criteria\RequestCriteria;


class FeedbackController extends Controller
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
        $feedbacks =  Comment:: paginate(10);

        return view('feedbacks.index', compact("feedbacks"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('feedbacks.create');
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
            'subject' =>  'string|required|min:3|max:100',   
            'feedback' =>  'string|required|min:7|max:1000'   
            ]);   
            $feedback = new Comment;
            $feedback->subject= $request->subject;
            $feedback->feedback= $request->feedback;
            $feedback->user_id=$request->user_id = auth()->user()->id; 
            try {
                $feedback->save();   
                Session::flash('success','Your Feedback is appreciated, Thanks !');   
            } catch (\Throwable $th) {
                Session::flash('error','Sorry something went wrong !');   
                return back();
            }

            return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $feedback =Comment::findOrFail($id);
        if (empty($feedback)) {
            Session::flash('error','feedback  not found');
            return redirect(route('feedbacks.index'));
        } 

        return view('feedbacks.show', compact("feedback"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return back();
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
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $feedback =Comment::findOrFail($id);

        if (empty($feedback)) {
            Session::flash('error','feedback  not found');

            return redirect(route('feedbacks.index'));
        }  
               

       $feedback->delete($id);

       Session::flash('success','feedback  deleted successfully.');

        return redirect(route('feedbacks.index'));
    }
    
}
