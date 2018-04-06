<div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
    {{ Form::label('name', 'ФИО*') }}
    {{ Form::text('name', null, ['class'=>'form-control']) }}
    @if ($errors->has('name'))
        <p class="help-block">
            {{ $errors->first('name') }}
        </p>
    @endif
</div>

<div class="form-group {{ $errors->has('login') ? ' has-error' : '' }}">
    {{ Form::label('login', 'Логин*') }}
    {{ Form::text('login', null, ['class'=>'form-control']) }}
    @if ($errors->has('login'))
    <p class="help-block">
        {{ $errors->first('login') }}
    </p>
    @endif
</div>

<div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
    {{ Form::label('email', 'E-mail*') }}
    {{ Form::text('email', null, ['class'=>'form-control']) }}
    @if ($errors->has('email'))
    <p class="help-block">
        {{ $errors->first('email') }}
    </p>
    @endif
</div>

<div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
    {{ Form::label('phone', 'Телефон*') }}
    {{ Form::text('phone', null, ['class'=>'form-control']) }}
    @if ($errors->has('phone'))
    <p class="help-block">
        {{ $errors->first('phone') }}
    </p>
    @endif
</div>

<div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
    {{ Form::label('password', 'Пароль*') }}
    {{ Form::password('password', ['class'=>'form-control']) }}
    @if ($errors->has('password'))
    <p class="help-block">
        {{ $errors->first('password') }}
    </p>
    @endif
</div>

<div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
    {{ Form::label('password_confirmation', 'Повторите пароль') }}
    {{ Form::password('password_confirmation', ['class'=>'form-control']) }}
    @if ($errors->has('password_confirmation'))
    <p class="help-block">
        {{ $errors->first('password_confirmation') }}
    </p>
    @endif
</div>

<!-- select -->
{{ Form::button('Сохранить!', ['class'=>'btn btn-primary btn-flat', 'type'=>'submit']) }}
<a class="btn bg-gray btn-flat margin" href="{{ route('admin.administrators.index') }}">
    <i class="fa fa-undo margin-r-5"></i>
    Отменить
</a>