@extends('admin.layouts.app')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-4">
                <h3 class="title">Редактирование страницы</h3>
            </div>
            <div class="col-md-8">
                <p></p>
                <a href="{{ route('pages.index') }}">
                    <button class="btn bg-gray btn-flat margin">
                        <i class="fa fa-undo margin-r-5"></i>
                        Назад
                    </button>
                </a>
            </div>
        </div>
        @if (Session::has('success_message'))
            <div class="alert alert-info">{{ Session::get('success_message') }} </div>
            @endif
        <!-- Default box -->
        <div class="row">
            <div class="col-md-12">
                <div class="box box-success">
                    <div class="box-body">
                        {!! Form::model($page, ['route' => ['pages.update', $page->id], 'method' => 'patch']) !!}
                            @include('admin.pages.form')
                        {{ Form::close() }}
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>

    </section><!-- /.content -->
@endsection