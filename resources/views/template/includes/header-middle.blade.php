<div class="row quick-menu">
    <div class="col-md-12">
        <div class="d-flex justify-content-between">
            <div class="logo">
                <a href="javascript: void(0);" title="{{$general->brand}}">
                    <img src="{{asset($general->getBrandImage())}}" alt="{{$general->brand}}">
                </a>
            </div>

            <ul class="list-inline align-self-center" style="margin-right:2%;">
                <li class="list-inline-item">
                    <a href="{{route('customer-area')}}" title="Área do cliente">
                        <img src="images/icon-user.png" alt="Usuário">
                        Área do cliente
                    </a>
                </li>
                
                <li class="list-inline-item">
                    <a href="void(0);" title="Meu carrinho" class="position-relative">
                        <img src="images/icon-cart.png" alt="Meu carrinho">
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill" style="background-color: #{{$template->secondarybg}}; color: #{{$template->secondarycolor}};">
                            2
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>