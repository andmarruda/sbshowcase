@extends('template.public')

@section('page')
<div class="row">
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
                        <img src="{{asset($b->getImage())}}" class="d-block w-100" alt="{{$b->name}}" srcset="{!! $b->getImgSrcSet() !!}">
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

<div class="row">
    <div class="col-md-11 product-list" style="background:#{{$template->secondarycolor}};">
        <div class="row">
            @include('template.includes.product', [
                'image' => asset('img/colchao-ortobom-queen.jpg'),
                'name' => 'Colchão Ortobom Queen',
                'description' => 'Colchão Ortobom Queen',
                'old_price' => 1979,
                'price' => 1000,
                'installments_limit' => 10
            ])

            @include('template.includes.product', [
                'image' => asset('img/colchao-ortobom-queen.jpg'),
                'name' => 'Colchão Ortobom Queen',
                'description' => 'Colchão Ortobom Queen',
                'old_price' => 1979,
                'price' => 1000,
                'installments_limit' => 10
            ])

            @include('template.includes.product', [
                'image' => asset('img/colchao-ortobom-queen.jpg'),
                'name' => 'Colchão Ortobom Queen',
                'description' => 'Colchão Ortobom Queen',
                'old_price' => 1979,
                'price' => 1000,
                'installments_limit' => 10
            ])
        </div>
    </div>
</div>
@endsection