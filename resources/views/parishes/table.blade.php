<table class="table table-responsive" id="parishes-table">
    <thead>
        <tr>
        <th>parish</th>
       <th    >Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($parishes as $parish)
        <tr>
            <td>{!! $parish->parish !!}</td>
            <td>
                {!! Form::open(['route' => ['parishes.destroy', $parish->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('parishes.show', [$parish->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('parishes.edit', [$parish->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{{-- {!! $parishes->links()  !!} --}}
