@extends('template.public')

@section('page')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                Carrinho de compra
            </div>

            <div class="card-body" id="cart-details">
                @if(session('message'))
                <div class="alert alert-danger">
                    {{session('message')}}
                </div>
                @endif

                @if(is_null($Products))
                <div class="card mb-3">
                    <div class="row g-0">
                        <h3>Seu carrinho de compras está vazio!</h3>
                    </div>
                </div>
                @else
                @foreach($Products as $product)
                @if(!is_null($product['product']))
                <div class="card mb-3">
                    <div class="row g-0">
                        @include('template.includes.cart-item', ['Product' => $product])
                    </div>
                </div>
                @endif
                @endforeach

                <div>
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4>Endereço de entrega</h4>
                            <p class="mb-0"><b>Endereço:</b> Rua tal, 123 - Centro</p>
                            <p class="mb-0"><b>CEP:</b> 14010-060</p>
                            <p class="mb-0"><b>Complemento:</b> </p>
                            <p class="mb-0"><b>Cidade:</b> Ribeirão Preto - SP</p>
                        </div>
                        <div style="text-align: right;">
                            <h5>Subtotal: R$12.000,00</h5>
                            <h5>Frete:    R$   100,00</h5>
                            <h5>Total:    R$12.100,00</h5>

                            <a href="{{route('cart-empty')}}" class="btn btn-outline-danger mt-3">Limpar carrinho</a>
                            <a href="#" class="btn btn-primary mt-3">Finalizar compra</a>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    const cartInputItems = ({target}, sum) => {
        let input = target.closest('.input-group').querySelector('input[type="number"]');
        let newValue = Number(input.value) + (sum);
        input.value = (newValue < input.min) ? input.min : (newValue > input.max) ? input.max : newValue;
    }

    document.addEventListener('DOMContentLoaded', () => {
        document.getElementById('cart-details').querySelectorAll('.input-group button').forEach(button => {
            button.addEventListener('click', (event) => {
                cartInputItems(event, (event.target.getAttribute('data-type') == 'minus' ? -1 : 1));
            });
        });
    });
</script>
@endsection