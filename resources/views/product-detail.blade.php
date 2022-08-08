@extends('template.public')

@section('page')
<div class="row">
    <div class="col-md-12 product-list">
        <div class="row">
            <section class="col-md-4">
                <img src="{{asset($Product->getImage())}}" alt="{{$Product->name}}" srcset="{{$Product->getImgSrcSet()}}" style="max-width:300px;">
            </section>

            <section class="col-md-8">
                <div class="infos">
                    <h1>{{$Product->name}}</h1>
                    <p>{{$Product->name}}</p>
                    <p class="old-price">De: R${{number_format($Product->old_price, 2, ',', '.')}}</p>
                    <p class="price">Por: R${{number_format($Product->price, 2, ',', '.')}}</p>
                    <small>Em até {{$Product->installments_limit}}xR${{number_format(($Product->price / $Product->installments_limit), 2, ',', '.')}} sem juros no cartão de crédito</small><br><br>
                    <a href="#" role="button" class="btn" style="background-color: #{{$template['templates']->highlightbg}}; color:#{{$template['templates']->highlightcolor}};">+ Carrinho</a>
                </div>
            </section>
        </div>

        <div class="row">
            <article class="col-md-12">
                
            <h2 style="text-decoration: underline;">Sobre o produto</h2>

            <div class="col-md-6" style="margin-bottom:2rem;">
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <td>Marca</td>
                            <td>{{$Product->brand()->first()->name}}</td>
                        </tr>

                        <tr>
                            <td>Tipo</td>
                            <td>{{$Product->type()->first()->name}}</td>
                        </tr>

                        <tr>
                            <td>Medida (em cm)</td>
                            <td>{{$Product->measure()->first()->getLabel()}}</td>
                        </tr>

                        <tr>
                            <td>Cor</td>
                            <td><span class="badge" style="background:{{$Product->color()->first()->hex_code}}; border:1px solid #000;">&nbsp;</span> {{$Product->color()->first()->name}}</td>
                        </tr>

                        <tr>
                            <td>Categoria</td>
                            <td>{{$Product->category()->first()->name}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            {!! $Product->description !!}
        
            </article>
        </div>
    </div>
</div>
@endsection