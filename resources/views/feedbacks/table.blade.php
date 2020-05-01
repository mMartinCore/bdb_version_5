<table class="table table-responsive" id="feedbacks-table" >
    <thead>
        <tr>
       <th>User</th>
       <th>Subject</th> 
       <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($feedbacks as $feedback)
        <tr>
            <td width=25%>{!! $feedback->user->email !!}</td>
            <td>{{ $feedback->subject }}</td> 
            <td width=10%>
                {!! Form::open(['route' => ['feedbacks.destroy', $feedback->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('feedbacks.show', [$feedback->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    {{-- <a href="{!! route('feedbacks.edit', [$feedback->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a> --}}
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<td colspan="2">{!! $feedbacks->links()  !!} 
</td>