@if(!empty($breadcrumbs))
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <ul class="bread-crumbs no-margin">
                @foreach($breadcrumbs as $bread)
                    @if(isset($bread['url']))
                        <li>{!! link_to($bread['url'], $bread['name']) !!}</li>
                    @else
                        <li>{!! $bread['name'] !!}</li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
@endif