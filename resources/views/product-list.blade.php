@extends('template.public')

@section('page')
<div class="row">
    <div class="col-md-12" style="margin: 2rem 0;">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="javascript: void(0);">{{$Category->name}}</a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#aside-menu" aria-controls="aside-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>
    </div>

    <div class="col-md-3 collapse" id="aside-menu">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Tamanho</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Largura x Comprimento x Altura</a>
            </li>

            @forelse($Measures as $measure)
            <li class="nav-item">
                <a class="nav-link" href="{{route('product-list', ['id' => $Category->id, 'name' => str_replace(' ', '-', $Category->name), 'filter' => 'measure', 'filter_id' => $measure->id])}}">{{$measure->getLabel()}}</a>
            </li>
            @empty
            <li class="nav-item">
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Nenhuma medida encontrada</a>
            </li>
            @endforelse

            <li class="nav-item">
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Marca</a>
            </li>

            @forelse($Brands as $brand)
            <li class="nav-item">
                <a class="nav-link" href="{{route('product-list', ['id' => $Category->id, 'name' => str_replace(' ', '-', $Category->name), 'filter' => 'brand', 'filter_id' => $brand->id])}}">{{$brand->name}}</a>
            </li>
            @empty
            <li class="nav-item">
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Nenhuma marca encontrada</a>
            </li>
            @endforelse

            <li class="nav-item">
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Cor</a>
            </li>

            @forelse($Colors as $color)
            <li class="nav-item">
                <a class="nav-link" href="{{route('product-list', ['id' => $Category->id, 'name' => str_replace(' ', '-', $Category->name), 'filter' => 'color', 'filter_id' => $color->id])}}"><span class="badge" style="background:{{$color->hex_code}}; border:1px solid #000;">&nbsp;</span> {{$color->name}}</a>
            </li>
            @empty
            <li class="nav-item">
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Nenhuma cor encontrada</a>
            </li>
            @endforelse

            <li class="nav-item">
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Tipo</a>
            </li>

            @forelse($Types as $type)
            <li class="nav-item">
                <a class="nav-link" href="{{route('product-list', ['id' => $Category->id, 'name' => str_replace(' ', '-', $Category->name), 'filter' => 'type', 'filter_id' => $type->id])}}">{{$type->name}}</a>
            </li>
            @empty
            <li class="nav-item">
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Nenhum tipo encontrado</a>
            </li>
            @endforelse
        </ul>
    </div>

    <div class="col-md-9 product-list">
        <div class="row">
            @forelse($Products as $prd)
                @include('template.includes.product', [
                    'id' => $prd->id,
                    'image' => asset($prd->getImage()),
                    'name' => $prd->name,
                    'description' => $prd->name,
                    'old_price' => $prd->old_price,
                    'price' => $prd->price,
                    'installments_limit' => $prd->installments_limit,
                    'srcset' => $prd->getImgSrcSet(),
                    'sizeset' => $prd->getImgSizeSet(),
                    'highlightbg' => $template['templates']->highlightbg,
                    'highlightcolor' => $template['templates']->highlightcolor,
                    'primarybg' => $template['templates']->primarybg,
                    'primarycolor' => $template['templates']->primarycolor,
                ])
            @empty
                <div class="col-md-12">
                    <p>Nenhum produto encontrado</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection