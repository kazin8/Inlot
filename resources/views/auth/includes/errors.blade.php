<div class="row">
    <div class="col-xs-12 col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
        <ul>

            @foreach ($errors->all() as $error)

            <li class="text-danger">{{ $error }}</li>

            @endforeach

        </ul>
        <hr>
    </div>
</div>