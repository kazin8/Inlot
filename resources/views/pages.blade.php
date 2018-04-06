@extends('layouts/home')

@section('title', $data->t.' — Торговая площадка Inlot.ru')
@section('d', $data->d)

@section('content')

    <!-- content  -->
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <br>
                    <h1>{{$data->name}}</h1>
                    <br>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-page">
                    {!! $data->full_text !!}
                </div>
            </div>

        </div>
    </section>

@endsection