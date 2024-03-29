<div class="row quick-menu">
    <div class="col-md-12">
        <div class="d-flex justify-content-between">
            <div class="logo">
                <a href="{{route('main')}}" title="{{$general->brand}}">
                    <img src="{{asset($general->getBrandImage())}}" alt="{{$general->brand}}">
                </a>
            </div>

            <ul class="list-inline align-self-center" style="margin-right:2%;">
                <li class="list-inline-item">
                    <a href="{{route('customer-area')}}" title="Área do cliente">
                        <img src="{{asset('images/icon-user.png')}}" alt="Usuário">
                        Área do cliente
                    </a>
                </li>
                
                <li class="list-inline-item">
                    <a href="{{route('cart')}}" title="Meu carrinho" class="position-relative">
                        <img src="{{asset('images/icon-cart.png')}}" alt="Meu carrinho">
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill" style="background-color: #{{$template->secondarybg}}; color: #{{$template->secondarycolor}};">
                            {{$CartCount}}
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>