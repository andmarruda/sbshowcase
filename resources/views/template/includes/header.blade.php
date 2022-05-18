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

<div class="row">
    <div class="col-md-4">
        <img src="{{asset('images/brand-example.png')}}" alt="{{$title}}">
    </div>

    <div class="col-md-4">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2">
            <button class="btn btn-outline-secondary" type="button" id="button-addon2">Button</button>
        </div>
    </div>

    <div class="col-md-4">
    </div>
</div>