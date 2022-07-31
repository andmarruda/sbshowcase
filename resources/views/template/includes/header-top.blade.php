<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-between">
            <ul class="list-inline">
                @foreach($socialNetworks as $label => $sn)
                <li class="list-inline-item"><a href="{{$sn->url}}" title="{{$sn->socialMedia()->first()->name}}"><img src="{{asset($sn->socialMedia()->first()->icon)}}" alt="{{$sn->socialMedia()->first()->name}}" width="20px" height="20px"></a></li>
                @endforeach
                @if(!is_null($general->whatsapp_number))
                <li class="list-inline-item"><a href="tel:{{$general->whatsapp_number}}" title="Whatsapp"><img src="{{asset('images/icon-zap.png')}}" alt="Whatsapp" width="20px" height="20px"></a></li>
                <li class="list-inline-item">{{$general->whatsapp_number}}</li>
                @endif
            </ul>

            <ul class="list-inline">
                <li class="list-inline-item"><a href="{{route('our-stores')}}" title="{{__('sbshowcase.our.stores')}}">{{__('sbshowcase.our.stores')}}</a></li>
                <li class="list-inline-item">|</li>
                <li class="list-inline-item"><a href="void(0);" title="{{__('sbshowcase.my.orders')}}">{{__('sbshowcase.my.orders')}}</a></li>
            </ul>
        </div>
    </div>
</div>