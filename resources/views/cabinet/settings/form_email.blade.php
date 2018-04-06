{!! method_field('patch') !!}

<div class="row">
    <div class="col-xs-12 col-md-6 col-sm-6">
        <div class="form-group">
            <div class="row">
                <div class="col-xs-12 col-md-12 col-sm-12">
                    {{ Form::label('email', '* Новый E-mail') }}
                </div>
                <div class="col-xs-12 col-md-12 col-sm-12">
                    {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Укажите e-mail']) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-md-3 col-sm-3">
        <label class="opacity">immulate height</label>
        {!! Form::button('Продолжить', ['class' => 'btn btn-gray btn-block', 'type' => 'submit']) !!}
    </div>
</div>