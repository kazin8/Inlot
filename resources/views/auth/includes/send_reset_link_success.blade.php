<!--title and description-->
<div class="row">
    <div class="col-xs-12 col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
        <h1 class="text-center">Письмо отправлено</h1>
        <p class="text-center"><big>На почту {{ session('email') }} отправлено письмо с инструкцией по созданию нового пароля.</big></p>

    </div>
</div>
<!-- title end -->

<!-- Registration -->
<div class="Registration" data-item="Registration">
    <div class="row">
        <div class="col-xs-12 col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
            <div class="row">
                <div class="col-xs-12 col-md-12 col-sm-12">
                    <!-- Registration form physic`s-->
                    <form class="Registration-form" action="" method="post">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-12 col-md-12 col-sm-12 text-center">
                                    <i class="fa fa-check-circle-o text-success icon-ok"></i>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-md-12 col-sm-12">
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-md-12 col-sm-12 text-center">
                                <p><a href="{{ url('/password/reset') }}"><big>Отправить письмо повторно</big></a></p>
                            </div>
                        </div>
                    </form>
                    <!-- Registration form physic`s END-->
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Registration END -->