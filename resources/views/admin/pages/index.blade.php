@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Добро пожаловать в административную панель
            <small>INLOT.ru</small>
        </h1>
    </section>
                <!-- Main content -->
    <section class="content">

        @if (Session::has('success_message'))
            <div class="alert alert-info">{{ Session::get('success_message') }} </div>
        @endif
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Текстовые страницы</h3>
                <a href="{{ route('pages.add') }}" class="btn btn-success pull-right">+Добавить</a>
            </div>
            <div class="box-body">
                {!! $dataTable->table() !!}
            </div>
            <div class="box-footer">
                <span>С выбранными: </span>
                <a class="btn ajax-delete-many btn-xs btn-danger" data-action="{{ route('pages.deleteMany') }}">
                    <i class="fa fa-remove"></i>
                </a>
            </div>
        </div>
    </section>
@stop

@push('scripts')
<script src="https://cdn.datatables.net/buttons/1.1.2/js/dataTables.buttons.min.js"></script>
<script src="/vendor/datatables/buttons.server-side.js"></script>
{!! $dataTable->scripts() !!}
@endpush