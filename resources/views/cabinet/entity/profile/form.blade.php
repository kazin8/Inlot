<div class="form-group">
    <div class="row">
        <div class="col-xs-12 col-md-6 col-sm-6">
            <div class="row">
                <div class="col-xs-12 col-md-12 col-sm-12">
                    {{ Form::label('company', '* Название компании') }}
                </div>
                <div class="col-xs-12 col-md-12 col-sm-12">
                    {{ Form::text('company', Auth::user()->companyName, ['class'=>'form-control', 'placeholder' => 'Укажите название компании']) }}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="row">
        <div class="col-xs-12 col-md-6 col-sm-6">
            <div class="row">
                <div class="col-xs-12 col-md-12 col-sm-12">
                    {{ Form::label('name', '* Контактное лицо') }}
                </div>
                <div class="col-xs-12 col-md-12 col-sm-12">
                    {{ Form::text('name', Auth::user()->name, ['class'=>'form-control', 'placeholder' => 'Укажите фамилию и имя']) }}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-md-12 col-sm-12">
        <h2>Для получения статуса продавца</h2>
    </div>
</div>
<div class="form-group">
    <div class="row">
        <div class="col-xs-12 col-md-6 col-sm-6">
            <div class="row">
                <div class="col-xs-12 col-md-12 col-sm-12">
                    {{ Form::label('phone', '* Телефон') }}
                </div>
                <div class="col-xs-12 col-md-12 col-sm-12">
                    {{ Form::text('phone', Auth::user()->phone, ['class'=>'form-control', 'placeholder' => '+7 (___) ___-__-__', 'data-item' => 'phone']) }}
                </div>
            </div>
        </div>
        <!--<div class="col-xs-12 col-md-6 col-sm-6">
            <div class="my-tooltip">
                <div>
                    <i class="fa fa-question-circle" data-html="true" data-toggle="tooltip" data-placement="right" title="<div class='tooltip-inner-header'>Не подтвержден. <a href='#''>Подтвердить</a></div><div><small>Чтобы начать продавать товары на inlot.ru необходимо подтвердить номер телефона</small></div>"></i>
                </div>
            </div>
        </div>-->
    </div>
</div>
<div class="form-group">
    <div class="row">
        <div class="col-xs-12 col-md-6 col-sm-6">
            <div class="row">
                <div class="col-xs-12 col-md-12 col-sm-12">
                    {{ Form::label('region_id', 'Регион') }}
                </div>
                <div class="col-xs-12 col-md-12 col-sm-12">
                    {{ Form::select('region_id', $regions, $profile['currentRegion'], ['class'=>'form-control select-regions', 'data-item' => 'select']) }}
                </div>
            </div>
        </div>
        <!--<div class="col-xs-12 col-md-6 col-sm-6">
            <div class="my-tooltip">
                <div>
                    <i class="fa fa-question-circle" data-html="true" data-toggle="tooltip" data-placement="right" title="<div><small>Чтобы начать продавать товары на inlot.ru необходимо указать регион, город  и адрес</small></div>"></i>
                </div>
            </div>
        </div>-->
    </div>

</div>
<div class="form-group">
    <div class="row">
        <div class="col-xs-12 col-md-6 col-sm-6">
            <div class="row">
                <div class="col-xs-12 col-md-12 col-sm-12">
                    {{ Form::label('city_id', 'Город') }}
                </div>
                <div class="col-xs-12 col-md-12 col-sm-12">
                    {{ Form::select('city_id', $cities, $profile['currentCity'], ['class'=>'form-control select-cities', 'data-item' => 'select']) }}
                </div>
            </div>
        </div>
    </div>

</div>
<div class="form-group">
    <div class="row">
        <div class="col-xs-12 col-md-6 col-sm-6">
            <div class="row">
                <div class="col-xs-12 col-md-12 col-sm-12">
                    {{ Form::label('address', 'Адрес') }}
                </div>
                <div class="col-xs-12 col-md-12 col-sm-12">
                    {{ Form::text('address', Auth::user()->adds, ['class'=>'form-control', 'placeholder' => 'Введите Ваш адрес']) }}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="row">
        <div class="col-xs-12 col-md-6 col-sm-6">
            <div class="row">
                <div class="col-xs-12 col-md-12 col-sm-12">
                    {{ Form::label('postcode', 'Почтовый индекс') }}
                </div>
                <div class="col-xs-12 col-md-12 col-sm-12">
                    {{ Form::text('postcode', Auth::user()->postcode, ['class'=>'form-control', 'placeholder' => 'Введите Ваш почтовый индекс']) }}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="row">
        <div class="col-xs-12 col-md-6 col-sm-6">
            <div class="row">
                <div class="col-xs-12 col-md-12 col-sm-12">
                    {{ Form::label('inn', 'ИНН') }}
                </div>
                <div class="col-xs-12 col-md-12 col-sm-12">
                    {{ Form::text('inn', Auth::user()->inn, ['class'=>'form-control', 'placeholder' => 'Введите ИНН']) }}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="row">
        <div class="col-xs-12 col-md-8 col-sm-8">
            <div class="row">
                <div class="col-xs-12 col-md-12 col-sm-12">
                    {{ Form::label('description', 'Описание') }}
                </div>
                <div class="col-xs-12 col-md-12 col-sm-12">
                    {{ Form::textarea('description', Auth::user()->addressDesc, ['class'=>'form-control', 'type' => 'text', 'rows' => '6']) }}
                </div>
            </div>
        </div>
    </div>

</div>
<div class="form-group">
    <div class="row">
        <div class="col-xs-12 col-md-12 col-sm-12">
            <div class="row">
                <div class="col-xs-12 col-md-12 col-sm-12">
                    <label>Логотип</label>
                </div>
                <div class="col-xs-12 col-md-12 col-sm-12 photo-upload-container one">
                    <img height="200" width="200" src="{{ Auth::user()->getImagePathEmpty() ?: 'http://placehold.it/200x200' }}">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-4 col-sm-4">
                    <div class="btn-file">
                        <button type="button" class="btn btn-gray with-icon"><span><i class="fa fa-upload"></i></span> <span>Загрузить изображение</span></button>
                        {{ Form::file('image', ['data-item' => 'photo', 'class' => 'btn btn-gray btn-block']) }}
                    </div>
                </div>
                <div class="col-xs-12 col-md-8 col-sm-8">
                    <div class="my-tooltip no-fields">
                        <div>
                            <i class="fa fa-question-circle" data-html="true" data-toggle="tooltip" data-placement="right" title="<div><small>Лучше всего загрузить квадратное изображение.</small></div>"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-xs-12 col-md-12 col-sm-12">
        <hr>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-md-3 col-sm-3">
        {{ Form::button('Сохранить', ['class'=>'btn btn-orange btn-block save-profile', 'type'=>'submit']) }}
    </div>
    @if (!Auth::user()->may_sell)
        <div class="col-xs-12 col-md-3 col-sm-3">
            <a href="{{ route('cabinet.profile.becomeDealer') }}" class="btn btn-info btn-block become-a-dealer">Стать продавцом</a>
        </div>
    @endif
</div>
@include('modals/become_a_dealer')