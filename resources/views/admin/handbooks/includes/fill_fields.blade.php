@foreach (old('names') as $key => $name)

    <div class="form-group">
        <div class="row">
            <div class="col-xs-6">
                {{ Form::text("names[$key]", $name, ['class'=>'form-control']) }}
            </div>
        </div>
    </div>

@endforeach