@extends('template.public')

@section('page')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                Endereço de entrega / cobrança
            </div>

            <div class="card-body">
                <p class="mb-0"><b>Endereço:</b> {{$customerAddress->address ?? ''}}, {{$customerAddress->number ?? ''}} - {{$customerAddress->neighborhood ?? ''}}</p>
                <p class="mb-0"><b>CEP:</b> {{$customerAddress->zip_code ?? ''}}</p>
                <p class="mb-0"><b>Complemento:</b> {{$customerAddress->complement ?? ''}}</p>
                <p class="mb-0"><b>Cidade:</b> {{$customerAddress->city()->first()->city_name}} - {{$customerAddress->state()->first()->state_initials}}</p>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                Total
            </div>
            <div class="card-body" style="text-align: right; font-size: 18px;">
                <p><b>Subtotal: </b> R${{number_format($products_price, 2, ',', '.')}}</p>
                <p><b>Frete: </b> R${{number_format($shipping_price, 2, ',', '.')}}</p>
                <p><b>Total: </b> R${{number_format(($products_price + $shipping_price), 2, ',', '.')}}</p>
            </div>
        </div>
    </div>
</div>

<div class="row" style="margin-top: 2rem;">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                Produtos do pedido
            </div>

            <div class="card-body">
                @if(!is_null($Products))
                    @foreach($Products as $Product)
                    <div class="card mb-3">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="images/example.png" class="img-fluid rounded-start" alt="Produto tal" style="width:100px;">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <h5>{{$Product['product']->name}}</h5>
                                        <div>
                                            <p class="price">Quantidade: {{$Product['quantity']}}<br>Preço: R${{number_format(($Product['quantity'] * $Product['product']->price), 2, ',', '.')}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="alert alert-danger">Nenhum produto selecionado!</div>
                @endif

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                Forma de pagamento
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="alert alert-info">A nossa forma de pagamento é através do recebimento no momento da entrega do produto!</div>
                                    </div>
                                </div>

                                <form autocomplete="off">
                                    @csrf
                                    <div class="row">
                                        <div class="col">
                                            <label for="payment-method" class="form-label">Forma de pagamento</label>
                                            <select class="form-control" id="payment-method" name="payment-method" required="">
                                                <option value="">Selecione</option>
                                                @foreach($all_payment_methods as $method)
                                                <option value="{{ $method->id }}" data-max-installments="{{$method->installments}}">{{ $method->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col">
                                            <label for="installments" class="form-label">Parcelas</label>
                                            <select class="form-control" id="installments" name="installments" required="">
                                                <option value="">Selecione</option>
                                            </select>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                @if(!is_null($Products))
                <div class="row" style="margin-top: 2rem;">
                    <div class="col" style="text-align: right;">
                        <a href="#" class="btn btn-primary">Confirmar pedido</a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    const order_total = {{$products_price + $shipping_price}};

    const generatesOptions = (max_installments, combobox) => {
        let html = '<option value="">Selecione</option>';
        for(let i=1; i<=max_installments; i++){
            html += `<option value="${i}">${i}x de ${(order_total / i).toLocaleString('pt-BR', {minimumFractionDigits: 2 , style: 'currency', currency: 'BRL'})} sem juros</option>`;
        }

        combobox.innerHTML = html;
    }

    document.addEventListener('DOMContentLoaded', () => {
        const installments = document.getElementById('installments');
        installments.disabled = true;

        document.getElementById('payment-method').addEventListener('change', ({target}) => {
            if(target.value==''){
                installments.value = '';
                installments.disabled = true;
                return;
            }

            installments.disabled = false;
            let max = target.querySelector('option:checked').dataset.maxInstallments;
            generatesOptions(max, installments);
        });
    });
</script>
@endsection