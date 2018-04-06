{{ Form::hidden('type', $user->type) }}

@if ($user->type == 2)

    <div class="form-group">
        <div class="form-group">
            {{ Form::label('may_sell', 'Разрешить продавать') }}
            {!! Form::boolean('may_sell', $user->may_sell) !!}
        </div>
    </div>

    <h3>О компании</h3>

    <div class="form-group">
        <div class="form-group {{ $errors->has('company') ? ' has-error' : '' }}">
            {{ Form::label('company', 'Название компании (только для юр. лиц)*') }}
            {{ Form::text('company', $user->company->name, ['class'=>'form-control']) }}
            @if ($errors->has('company'))
            <p class="help-block">
                {{ $errors->first('company') }}
            </p>
            @endif
        </div>
    </div>

    <div class="form-group">
        <div class="form-group {{ $errors->has('inn') ? ' has-error' : '' }}">
            {{ Form::label('inn', 'ИНН') }}
            {{ Form::text('inn', $user->company->inn, ['class'=>'form-control']) }}
            @if ($errors->has('inn'))
            <p class="help-block">
                {{ $errors->first('inn') }}
            </p>
            @endif
        </div>
    </div>
@endif

<h3>Личная информация</h3>

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

<h3>Адрес</h3>

<div class="form-group {{ $errors->has('region_id') ? ' has-error' : '' }}">
    {{ Form::label('region_id', 'Регион') }}
    {{ Form::select('region_id', $regions, $currentRegionId, ['class' => 'single-select select-region']) }}
    @if ($errors->has('region_id'))
    <p class="help-block">
        {{ $errors->first('region_id') }}
    </p>
    @endif
</div>

<div class="form-group {{ $errors->has('city_id') ? ' has-error' : '' }}">
    {{ Form::label('city_id', 'Город') }}
    {{ Form::select('city_id', $cities, $currentCityId, ['class' => 'single-select select-cities']) }}
    @if ($errors->has('city_id'))
    <p class="help-block">
        {{ $errors->first('city_id') }}
    </p>
    @endif
</div>

<div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
    {{ Form::label('address', 'Адрес*') }}
    {{ Form::text('address', (null !== $user->address) ? $user->address->address : null, ['class'=>'form-control']) }}
    @if ($errors->has('address'))
    <p class="help-block">
        {{ $errors->first('address') }}
    </p>
    @endif
</div>

<div class="form-group {{ $errors->has('postcode') ? ' has-error' : '' }}">
    {{ Form::label('postcode', 'Индекс*') }}
    {{ Form::text('postcode', (null !== $user->address) ? $user->address->postcode : null, ['class'=>'form-control']) }}
    @if ($errors->has('postcode'))
    <p class="help-block">
        {{ $errors->first('postcode') }}
    </p>
    @endif
</div>

<div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
    {{ Form::label('description', 'Описание*') }}
    {{ Form::textarea('description', (null !== $user->address) ? $user->address->description : null, ['class'=>'form-control']) }}
    @if ($errors->has('description'))
    <p class="help-block">
        {{ $errors->first('description') }}
    </p>
    @endif
</div>

<!-- select -->
{{ Form::button('Сохранить!', ['class'=>'btn btn-primary btn-flat', 'type'=>'submit']) }}
<a class="btn bg-gray btn-flat margin" href="{{ route('admin.users.index') }}">
    <i class="fa fa-undo margin-r-5"></i>
    Отменить
</a>

@push ('scripts')
    <script src="/js/admin/users/main.js"></script>
@endpush