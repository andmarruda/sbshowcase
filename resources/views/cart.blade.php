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
                        @if($logged)
                        <div>
                            <h4>Endereço de entrega</h4>
                            <p class="mb-0"><b>Endereço:</b> Rua tal, 123 - Centro</p>
                            <p class="mb-0"><b>CEP:</b> 14010-060</p>
                            <p class="mb-0"><b>Complemento:</b> </p>
                            <p class="mb-0"><b>Cidade:</b> Ribeirão Preto - SP</p>
                        </div>
                        @else
                        <div>
                            <h4>Calcular frete</h4>
                            <form action="javascript: void(0);" id="shippment-calculation-form" data-url="{{route('cart-calculate-shipping')}}">
                                @csrf
                                <div class="input-group mb-3">
                                    <input type="text" maxlength="9" required="" autocomplete="off" class="form-control" id="cart-zip-code" name="cart-zip-code" placeholder="CEP">
                                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Calcular</button>
                                </div>
                            </form>
                            <p>Ou faça <a href="{{route('customer-login', ['redirect' => 'cart'])}}">login</a> para calcular o frete</p>
                        </div>
                        @endif
                        <div style="text-align: right;">
                            <h5 id="cart-subtotal">Subtotal: R$0,00</h5>
                            <h5 id="cart-delivery">Frete:    Digite o cep</h5>
                            <h5 id="cart-total">Total:    R$0,00</h5>

                            <a href="{{route('cart-empty')}}" class="btn btn-outline-danger mt-3">Limpar carrinho</a>
                            <a href="#" class="btn btn-primary mt-3" id="finish-order-button">Finalizar compra</a>
                        </div>
                    </div>

                    <div class="alert alert-danger" id="no-shippment-advice" style="margin-top:2rem; display:none;">Infelizmente não atendemos sua cidade! Qualquer dúvida ou sugestão pode ficar a vontade para entrar em contato através de nossas redes sociais!</div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    const cartSubTotalValue = {{$subtotal}};
    const shippingValue = 0;

    const cartInputItems = ({target}, sum) => {
        let input = target.closest('.input-group').querySelector('input[type="number"]');
        let newValue = Number(input.value) + (sum);
        if(newValue == 0){
            let a = document.getElementById('remove_product_'+ input.getAttribute('data-id'));
            a.click();
            return;
        }
        let idTarget='input-quantity-'+input.getAttribute('data-id');
        input.value = (newValue < input.min) ? input.min : (newValue > input.max) ? input.max : newValue;
        window.location.href = input.getAttribute('data-url').replace('-99', newValue) + '/' + idTarget;
    }

    const removeFromCart = (url) => {
        if(confirm('Deseja realmente remover este item do carrinho?')) {
            window.location.href = url;
        }
    }

    const calculateTotals = (shippingVal=null) => {
        const cartTotal = document.getElementById('cart-total'),
            cartSubTotal = document.getElementById('cart-subtotal'),
            cartDelivery = document.getElementById('cart-delivery');

        if(cartTotal==null || cartSubTotal==null || cartDelivery==null)
            return;

        cartTotalValue = shippingVal==null ? cartSubTotalValue + shippingValue : cartSubTotalValue + Number(shippingVal);

        cartSubTotal.innerText = 'Subtotal: ' + cartSubTotalValue.toLocaleString('pt-BR', {style: 'currency', currency: 'BRL'});
        cartTotal.innerText = 'Total: ' + cartTotalValue.toLocaleString('pt-BR', {style: 'currency', currency: 'BRL'});
        cartDelivery.innerText = (shippingVal==null) ? 'Frete: Digite o cep' : 'Frete: ' + Number(shippingVal).toLocaleString('pt-BR', {style: 'currency', currency: 'BRL'});
    }

    document.addEventListener('DOMContentLoaded', () => {
        document.getElementById('cart-details').querySelectorAll('.input-group button').forEach(button => {
            button.addEventListener('click', (event) => {
                cartInputItems(event, (event.target.getAttribute('data-type') == 'minus' ? -1 : 1));
            });
        });

        calculateTotals();
        let cartZipCode = document.getElementById('cart-zip-code');
        if(cartZipCode !== null){
            VMasker(cartZipCode).maskPattern("99999-999");
        }

        document.getElementById('shippment-calculation-form').addEventListener('submit', async (event) => {
            event.preventDefault();
            document.getElementById('no-shippment-advice').style.display = 'none';

            let button = event.target.querySelector('button'),
                beforeHtml = button.innerHTML,
                cepInput = event.target.querySelector('#cart-zip-code');
            button.disabled = true;
            button.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Carregando...';

            let data = await searchCep(cepInput.value);
            let token = event.target.querySelector('input[name="_token"]').value;

            let fd = new FormData(event.target);
            fd.append('ibge', data.ibge);
            fd.delete('_token');

            let h = new Headers();
            h.append('X-CSRF-TOKEN', token);

            let f = await fetch(event.target.getAttribute('data-url'), {
                method: 'POST',
                headers: h,
                body: fd
            });

            let json = await f.json();
            button.innerHTML = beforeHtml;
            button.disabled = false;

            if(json.hasOwnProperty('shipping')){
                document.getElementById('no-shippment-advice').style.display = 'block';
                cepInput.value = '';
                calculateTotals(null);
                return;
            }

            calculateTotals(json.price);
        });
    });
</script>
@endsection