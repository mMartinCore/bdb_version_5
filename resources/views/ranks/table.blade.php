<table class="table table-responsive" id="ranks-table">
    <thead>
        <tr>
        <th>Ranks</th>
       <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($ranks as $rank)
        <tr>
            <td> {{ $rank->rank }}</td>
            <td>
                {!! Form::open(['route' => ['ranks.destroy', $rank->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('ranks.show', [$rank->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('ranks.edit', [$rank->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{{-- {!! $ranks->links()  !!} --}}
