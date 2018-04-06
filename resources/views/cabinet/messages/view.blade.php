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
                    <div class="Message">
                        <div class="Message-header">
                            <div class="Message-header-review">
                                <a href="{{route('cabinet.dialog.index')}}">← Все диалоги</a>
                                @if ($individual)
                                    <h1>{{ $dialog->entity->company->name }}</h1>
                                @else
                                    <h1>{{ $dialog->individual->login }}</h1>
                                @endif
                                @if ($dialog->good)
                                    <p>Товар: <a href="{{route('goods.item', ['good'=>$dialog->good->id])}}" target="_blank">{{$dialog->good->name}}</a></p>
                                @endif
                            </div>
                        </div>
                        @if (count($dialog->messages))
                            @foreach($dialog->messages as $message)
                            <div class="Message-content Inbox">
                                <div class="Message-preview-item Inbox" data-item="target-delete">
                                    <div class="col-1">
                                        <div class="Message-preview-item-img">

                                            @if ($message->is_individual)
                                                <img src="{{ $dialog->individual->image80Path }}">
                                            @else
                                                <img src="{{ $dialog->entity->image80Path }}">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div>
                                            <div>
                                                @if ($message->is_individual)
                                                    <p><strong>{{$dialog->individual->login}}</strong></p>
                                                @else
                                                    <p><strong>{{$dialog->entity->company->name}}</strong></p>
                                                @endif
                                            </div>
                                            <div>
                                                {!! nl2br(e($message->message)) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div>
                                            <!--<div>
                                                <a href="#" data-item="delete">Удалить</a>
                                            </div>-->
                                            <div>
                                                <div class="Message-preview-item-date">
                                                    <div><!-- <i class="fa fa-check" aria-hidden="true"></i> --></div>
                                                    @if ($message->created_at)
                                                        <div>{{$message->created_at->format('d.m.Y H:i:s')}}</div>
                                                    @else
                                                        <div>Ошибка даты</div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            @endforeach
                        @endif
                        <div class="Message-footer Inbox">
                            <div class="Message-preview-item Inbox" data-item="target-delete">
                                <div class="col-1">
                                    <div class="Message-preview-item-img">
                                        <img src="{{ Auth::user()->image80Path }}">
                                    </div>
                                </div>
                                <div class="col-2">
                                    {!! Form::open(['url' => route('cabinet.dialog.message.create', ['dialog_id' => $dialog->id]), 'class'=>'full-width', 'autocomplete' => 'off']) !!}
                                        <div class="form-group">
                                            {{ Form::textarea('message', '', ['class'=>'form-control', 'rows' => '6']) }}
                                        </div>
                                        <button class="btn btn-orange" type="submit">Отправить сообщение</button>

                                    {!! Form::close() !!}
                                </div>
                                <div class="col-3">
                                    <div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
            </div>
    </section>
    <!-- content END -->
@endsection