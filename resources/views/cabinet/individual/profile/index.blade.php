@extends('layouts.cabinet')

@section('content')

<!-- content  -->
<section class="content">
    <div class="container">
        <!--title and description-->
        <div class="row">

            @include('includes.left_menu')

            <div class="col-xs-12 col-md-9 col-sm-9">
                <div class="Settings-header">
                    <h1>Профиль</h1>
                </div>
                <div class="Settings-content">
                    <div>
                        <!-- Nav tabs -->
                        <ul class="my-navigation-tablink" role="tablist">
                            <li class="active"><a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab">Личные данные</a></li>
                            <!--<li><a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab">Доставка и оплата</a></li>-->
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab1">
                                {!! Form::open(['url' => route('cabinet.profile.update'), 'method' => 'PATCH', 'enctype' => 'multipart/form-data', 'class' => 'Profile', 'autocomplete' => 'off']) !!}

                                    @include('cabinet.individual.profile.form')

                                {!! Form::close() !!}
                            </div>
                            <!--<div class="tab-pane" id="tab2">
                                Second tab.
                            </div>-->
                        </div>

                    </div>
                </div>
            </div>
        </div><!-- title end -->
    </div>
</section>
<!-- content END -->

@endsection