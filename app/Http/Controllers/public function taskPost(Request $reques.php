public function taskPost(Request $request)

{

    $task = new Task();
    $task->user_id = auth()->user()->id;
    $task->address_to_id =    $this->test_input( $request->input('address_to_id'));
    $task->corpse_id =   $this->test_input( $request->input('corpse_id'));
    $task->task =   $this->test_input($request->input('task'));
    $task->modify_by = 0;

    $error_array = '';
    $success_output = '';

try{
    $task->saveOrFail();
    }
    catch (\Throwable $th) {
        $error_array ='<div class="alert alert-danger"> Something occurred while saving Task! </div>';
    }
    $sendTo = User::where('id', '=', $task->address_to_id)->get();
    $data = array(
        'id' => $task->corpse_id,
        'type' => 'task',
        "from" => auth()->user()->email
    );

   //try{
        if (\Notification::send($sendTo, new newCorpseNotification($data))) {
           // return back();
        }
    //  }
    // catch (\Throwable $th) {
    //     $error_array =  '<div class="alert alert-danger"> Something occurred while retrieving record! </div>';
    // }

   $success_output = '<div class="alert alert-success">  Task sent sucessfully! </div>';

    $output = array(
        'error'     =>  $error_array,
        'success'   =>  $success_output
    );

    echo json_encode($output);
}
//////////////////////////////////////////////////////

