<div class="form-group {{ $errors->has('active') ? ' has-error' : '' }}">
    {{ Form::label('active', 'Активность') }}
    {{ Form::checkbox('active') }}
    @if ($errors->has('active'))
        <p class="help-block">
            {{ $errors->first('active') }}
        </p>
    @endif
</div>

<div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
    {{ Form::label('name', 'Заголовок*') }}
    {{ Form::text('name', null, ['class'=>'form-control']) }}
    @if ($errors->has('name'))
        <p class="help-block">
            {{ $errors->first('name') }}
        </p>
    @endif
</div>

<div class="form-group {{ $errors->has('full_text') ? ' has-error' : '' }}">
    {{ Form::label('full_text', 'Полный текст') }}
    {{ Form::textarea('full_text', null, ['class'=>'ckeditor']) }}
    @if ($errors->has('full_text'))
        <p class="help-block">
            {{ $errors->first('full_text') }}
        </p>
    @endif
</div>

<div class="form-group {{ $errors->has('slug') ? ' has-error' : '' }}">
    {{ Form::label('slug', 'ЧПУ*') }}
    {{ Form::text('slug', null, ['class'=>'form-control']) }}
    @if ($errors->has('slug'))
        <p class="help-block">
            {{ $errors->first('slug') }}
        </p>
    @endif
</div>

<div class="form-group {{ $errors->has('t') ? ' has-error' : '' }}">
    {{ Form::label('t', 'Мета-заголовок') }}
    {{ Form::text('t', null, ['class'=>'form-control']) }}
    @if ($errors->has('t'))
        <p class="help-block">
            {{ $errors->first('t') }}
        </p>
    @endif
</div>

<div class="form-group {{ $errors->has('d') ? ' has-error' : '' }}">
    {{ Form::label('d', 'Мета-описание') }}
    {{ Form::text('d', null, ['class'=>'form-control']) }}
    @if ($errors->has('t'))
        <p class="help-block">
            {{ $errors->first('d') }}
        </p>
    @endif
</div>

<div class="form-group {{ $errors->has('k') ? ' has-error' : '' }}">
    {{ Form::label('k', 'Мета-слова') }}
    {{ Form::text('k', null, ['class'=>'form-control']) }}
    @if ($errors->has('k'))
        <p class="help-block">
            {{ $errors->first('k') }}
        </p>
    @endif
</div>

<!-- select -->
{{ Form::button('Сохранить!', ['class'=>'btn btn-primary btn-flat', 'type'=>'submit']) }}
<a class="btn bg-gray btn-flat margin" href="{{ route('pages.index') }}">
    <i class="fa fa-undo margin-r-5"></i>
    Отменить
</a>