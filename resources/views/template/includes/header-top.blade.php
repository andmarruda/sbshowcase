<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-between">
            <ul class="list-inline">
                @foreach($socialNetworks as $label => $sn)
                <li class="list-inline-item"><a href="{{$sn['url']}}" title="{{$label}}"><img src="{{$sn['img']}}" alt="{{$label}}" width="{{$sn['width']}}" height="{{$sn['height']}}"></a></li>
                @endforeach
                <li class="list-inline-item">{{$phone}}</li>
            </ul>

            <ul class="list-inline">
                <li class="list-inline-item"><a href="void(0);" title="{{__('sbshowcase.our.stores')}}">{{__('sbshowcase.our.stores')}}</a></li>
                <li class="list-inline-item">|</li>
                <li class="list-inline-item"><a href="void(0);" title="{{__('sbshowcase.my.orders')}}">{{__('sbshowcase.my.orders')}}</a></li>
            </ul>
        </div>
    </div>
</div>