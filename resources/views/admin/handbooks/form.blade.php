<div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
    <div class="form-group">
        <div class="row">
            <div class="col-xs-6">
                {{ Form::label('name', 'Название') }}
                {{ Form::text('name', null, ['class'=>'form-control']) }}
                @if ($errors->has('name'))
                    <p class="help-block">
                        {{ $errors->first('name') }}
                    </p>
                @endif
            </div>
        </div>
    </div>
</div>

<h2>Содержимое справочника</h2>

<div class="fields-container">

    @if (isset($handbook))

        @include('admin.handbooks.includes.old_fields', ['handbook' => $handbook])

    @endif

    @if (null !== old('names'))

        @include('admin.handbooks.includes.fill_fields')

    @else

        @include('admin.handbooks.includes.new_fields')

    @endif


</div>

<div class="form-group">
    <a href="javascript:void();" class="add-field">Добавить поле</a>
</div>

<!-- select -->
{{ Form::button('Сохранить!', ['class'=>'btn btn-primary btn-flat', 'type'=>'submit']) }}
<a class="btn bg-gray btn-flat margin" href="{{ route('admin.administrators.index') }}">
    <i class="fa fa-undo margin-r-5"></i>
    Отменить
</a>

@push('scripts')
<script src="/js/admin/handbooks/main.js"></script>
@endpush