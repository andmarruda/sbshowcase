@extends('template.public')

@section('page')
<div class="row">
    <div class="col-md-12">
        <h1 class="text-center" style="font-size:2rem;">Nossas lojas</h1>
    </div>
</div>

@foreach($Stores as $Store)
<article class="row" style="margin-top:2rem;">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{$Store->name}}</h5>
                <p class="card-text">{{$Store->address}}, {{$Store->address_number}} - {{$Store->address_neighborhood}}, {{$Store->address_city}} - {{$Store->address_state}}, {{$Store->address_zipcode}}</p>
                @if(!empty($Store->address_complement))
                <p class="card-text">Complemento: $Store->address_complement</p>
                @endif
                <p class="card-text">Telefone: {{$Store->phone}}</p>
                {!! $Store->google_maps_embeded !!}
            </div>
        </div>
    </div>
</article>
@endforeach

@endsection