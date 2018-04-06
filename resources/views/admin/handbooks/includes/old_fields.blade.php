@foreach ($handbook->records as $record)
<div class="form-group group-{{ $record->id }}">
    <div class="row">
        <div class="col-xs-6">
            {{ Form::text("old_names[$record->id]", $record->name, ['class'=>'form-control']) }}
        </div>
        <div class="col-xs-6">
            <a class="btn delete-record btn-xs btn-danger" data-id="{{ $record->id }}"
               data-action="{{ route('admin.handbooks.deleteRecord', ['records' => $record->id]) }}">
                <i class="fa fa-remove"></i>
            </a>
        </div>
    </div>
</div>
@endforeach