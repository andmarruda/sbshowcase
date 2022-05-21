<div class="d-flex justify-content-between align-items-center">
    <ul class="list-inline header-top">
        <li class="list-inline-item"><a href="{{$facebook}}" target="_blank"><img src="{{asset('images/facebook.png')}}" alt="Facebook"></a></li>
        <li class="list-inline-item"><a href="{{$instagram}}" target="_blank"><img src="{{asset('images/instagram.png')}}" alt="Instagram"></a></li>
        <li class="list-inline-item"><a href="{{$whatsapp}}" target="_blank"><img src="{{asset('images/whatsapp.png')}}" alt="Whatsapp"> (16)99999-9999</a></li>
    </ul>

    <ul class="list-inline header-top-menu">
        <li class="list-inline-item"><a href="{{route('stores')}}">Nossas lojas</a></li>
        <li class="list-inline-item"> | </li>
        <li class="list-inline-item"><a href="{{route('orders')}}">Meus Pedidos</a></li>
    </ul>
</div>

<div class="row align-items-center">
    <div class="col-md-4">
        <a href="#" title="Página inicial">
            <img src="{{asset('images/brand-example.png')}}" alt="{{$title}}">
        </a>
    </div>

    <div class="col-md-4" style="text-align:center;">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Pesquisar produto" aria-label="Pesquisar produto" aria-describedby="button-addon2">
            <button class="btn search-btn" type="button" id="button-addon2"><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>
    </div>

    <div class="col-md-4 menu-icons">
        <div class="d-flex flex-row justify-content-end bd-highlight mb-3">
            <div class="p-2 bd-highlight">
                <ul class="list-inline">
                    <li class="list-inline-item"><a href="#" title="Área do cliente"><i class="fa-solid fa-user"></i></a></li>
                    <li class="list-inline-item"><a href="#" title="Entre ou cadastre-se">Entre ou<br>cadastre-se</a></li>
                    <li class="list-inline-item"><a href="#" title="Carrinho de compra"><i class="fa-solid fa-cart-shopping"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="row justify-content-end">
    <div class="col-md-10">
        <nav class="nav justify-content-end menu-bg">
            <a class="nav-link active" aria-current="page" href="#">Active</a>
            <a class="nav-link" href="#">Link</a>
            <a class="nav-link" href="#">Link</a>
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
        </nav>
    </div>
</div>

<!-- #0D0D0D | #404040 | #BFBFBF -->