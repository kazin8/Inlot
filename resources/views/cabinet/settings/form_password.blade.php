{!! method_field('patch') !!}

<div class="form-group form-group-password">
    <div class="row">
        <div class="col-xs-12 col-md-6 col-sm-6">
            <div class="row">
                <div class="col-xs-12 col-md-12 col-sm-12">
                    {{ Form::label('current_password', '* Текущий пароль') }}
                </div>
                <div class="col-xs-12 col-md-12 col-sm-12">
                    {{ Form::password('current_password', ['class'=>'form-control', 'placeholder' => 'Укажите текущий пароль']) }}
                    <span class="fa form-control-feedback fa-eye-slash toggle-password" aria-hidden="true"></span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-group form-group-password">
    <div class="row">
        <div class="col-xs-12 col-md-6 col-sm-6">
            <div class="row">
                <div class="col-xs-12 col-md-12 col-sm-12">
                    {{ Form::label('password', '* Новый пароль') }}
                </div>
                <div class="col-xs-12 col-md-12 col-sm-12">
                    {{ Form::password('password', ['class'=>'form-control', 'placeholder' => 'Укажите новый пароль']) }}
                    <span class="fa form-control-feedback fa-eye-slash toggle-password" aria-hidden="true"></span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-group form-group-password">
    <div class="row">
        <div class="col-xs-12 col-md-6 col-sm-6">
            <div class="row">
                <div class="col-xs-12 col-md-12 col-sm-12">
                    {{ Form::label('password_confirmation', '* Повторите пароль') }}
                </div>
                <div class="col-xs-12 col-md-12 col-sm-12">
                    {{ Form::password('password_confirmation', ['class'=>'form-control', 'placeholder' => 'Повторите пароль']) }}
                    <span class="fa form-control-feedback fa-eye-slash toggle-password" aria-hidden="true"></span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-md-3 col-sm-3">
        {!! Form::button('Сохранить', ['class' => 'btn btn-orange btn-block', 'type' => 'submit']) !!}
    </div>
</div>