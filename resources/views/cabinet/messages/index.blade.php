@extends('layouts.cabinet')

@section('title', 'Личный кабинет — Сообщения — Inlot.ru')

@section('content')
<!-- content  -->
<section class="content">
    <div class="container">
        <!--title and description-->
        <div class="row">
            @include('includes.left_menu')
            <div class="col-xs-12 col-md-9 col-sm-9">
                <div class="Settings-header">
                    <h1>Сообщения</h1>
                </div>
                <div class="Message">
                    <div class="Message-content">
                        @if (!empty($dialogs))
                            @foreach($dialogs as $dialog)
                                <div class="Message-preview-item" data-item="target-delete">
                                    <div class="col-1">
                                        <div class="Message-preview-item-img">
                                            <a href="{{route('cabinet.dialog.view', ['dialog_id'=>$dialog->id])}}">
                                                @if ($individual)
                                                    <img src="{{ $dialog->entity->image80Path }}">
                                                @else
                                                    <img src="{{ $dialog->individual->image80Path }}">
                                                @endif
                                            </a>
                                            <span class="badge">99</span>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div>
                                            <div>
                                                @if ($individual)
                                                    <p><strong>{{$dialog->entity->company->name}}</strong></p>
                                                @else
                                                    <p><strong>{{$dialog->individual->login}}</strong></p>
                                                @endif
                                            </div>
                                            <div>
                                                <p data-item="overflow">{{$dialog->messages()->orderBy('id','DESC')->first()->message}}</p>
                                            </div>
                                            @if ($dialog->good)
                                            <div>
                                                <div class="Message-preview-item-subject">
                                                    <p>Товар:
                                                        <a href="{{route('goods.item', ['good'=>$dialog->good->id])}}" target="_blank">{{$dialog->good->name}}</a>
                                                    </p>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div>
                                            <div>
                                                <div class="Message-preview-item-date">
                                                    <div><i class="fa fa-check" aria-hidden="true"></i></div>
                                                    <div>{{$dialog->updated_at->format('d.m.Y')}}</div>
                                                </div>
                                            </div>
                                            <!--<div>
                                                <a href="#" data-item="delete">Удалить диалог</a>
                                            </div>-->
                                            <div>

                                            </div>
                                        </div>
                                    </div>
                                    <a href="{{route('cabinet.dialog.view', ['dialog_id'=>$dialog->id])}}"></a>
                                </div>
                            @endforeach
                        @else
                            <p>У вас пока еще нет открытых диалогов</p>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-md-12 col-sm-12">
                        <button type="button" class="btn btn-default btn-block">Показать еще 30</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-12 col-sm-12">
                        <br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-12 col-sm-12">
                        <p class="text-center">Показано 4 сообщения из 152</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-12 col-sm-12">
                        <br>
                    </div>
                </div>
        </div><!-- title end -->
    </div>
</section>
<!-- content END -->
@endsection