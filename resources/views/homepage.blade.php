@extends('template.public')

@section('page')
<div class="row" style="margin-bottom:2rem;">
    <div class="col-md-12">
        <div id="carouselExampleCaptions" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-indicators">
                @for($i=0; $i<$Banner->count(); $i++)
                    @if($i==0)
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{$i}}" class="active" aria-current="true" aria-label="Slide {{$i+1}}"></button>
                    @else
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{$i}}" class="" aria-label="Slide {{$i+1}}"></button>
                    @endif
                @endfor
            </div>
            <div class="carousel-inner">
                @php
                $first=0;
                @endphp
                @foreach($Banner as $b)
                <div class="carousel-item{{($first++) == 0 ? ' active' : ''}}">
                    <a href="{{$b->link}}" title="{{$b->name}}">
                        <img src="{{asset($b->getImage())}}" class="d-block w-100" alt="{{$b->name}}" srcset="{!! $b->getImgSrcSet() !!}" sizes="{!! $b->getImgSizeSet() !!}">
                    </a>
                </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div> 
    </div>
</div>

<div class="col-md-12" style="margin-bottom:2rem;">
    <h1>Promoções</h1>
</div>

@php
    $hp1 = $template['general']->highlightProduct1()->first();
    $hp2 = $template['general']->highlightProduct2()->first();
    $hp3 = $template['general']->highlightProduct3()->first(); 
@endphp

@if(!is_null($hp1) || !is_null($hp2) || !is_null($hp3))
<div class="row" style="margin-bottom:2rem;">
    <div class="col-md-12 product-list" style="background:#{{$template['templates']->secondarybg}};">
        <div class="row">
            @if(!is_null($hp1))
            @include('template.includes.product', ['product' => $template['general']->highlightProduct1()->first()])
            @endif

            @if(!is_null($hp2))
            @include('template.includes.product', ['product' => $template['general']->highlightProduct2()->first()])
            @endif

            @if(!is_null($hp3))
            @include('template.includes.product', ['product' => $template['general']->highlightProduct3()->first()])
            @endif
        </div>
    </div>
</div>
@endif

<div class="col-md-12">
    <h1>Novidades</h1>
</div>

<div class="row" style="margin-bottom:2rem;">
    <div class="col-md-12 product-list">
        <div class="row">
            @forelse($Latest as $prd)
            @include('template.includes.product', ['product' => $prd])
            @empty
            <div class="col-md-12">
                <p>Nenhum produto encontrado</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection