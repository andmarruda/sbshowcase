@extends('template.public')

@section('page')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                Endereço de entrega / cobrança
            </div>

            <div class="card-body">
                <p>
                    <b>Endereço: </b>Travessa Mario Spanó, 135 - <b>Bairro</b>> Vila tibério - <b>CEP</b> 14050-169
                </p>
                <p><b>Complemento:</b> Perto da igreja Santa Luzia</p>
                <p>Ribeirão Preto - SP</p>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                Total
            </div>
            <div class="card-body" style="text-align: right; font-size: 18px;">
                <p><b>Subtotal: </b> R$12.000,00</p>
                <p><b>Frete: </b> R$0,00</p>
                <p><b>Total: </b> R$12.000,00</p>
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
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="images/example.png" class="img-fluid rounded-start" alt="Produto tal" style="width:100px;">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <h5>CONJ. Box Queen Sealy Charleston Resort</h5>
                                    <div>
                                        <p class="price">Por: R$1.990,00</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="images/example.png" class="img-fluid rounded-start" alt="Produto tal" style="width:100px;">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <h5>CONJ. Box Queen Sealy Charleston Resort</h5>
                                    <div>
                                        <p class="price">Por: R$1.990,00</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

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

                                <div class="row">
                                    <div class="col">
                                        <label for="payment-method" class="form-label">Forma de pagamento</label>
                                        <select class="form-control" id="payment-method" name="payment-method" required="">
                                            <option value="1">Cartão Visa</option>
                                            <option value="2">Cartão Master</option>
                                            <option value="3">PIX</option>
                                        </select>
                                    </div>

                                    <div class="col">
                                        <label for="installments" class="form-label">Parcelas</label>
                                        <select class="form-control" id="installments" name="installments" required="">
                                            <option value="1">1x</option>
                                            <option value="2">2x</option>
                                            <option value="3">3x</option>
                                            <option value="4">4x</option>
                                            <option value="5">5x</option>
                                            <option value="6">6x</option>
                                            <option value="7">7x</option>
                                            <option value="8">8x</option>
                                            <option value="9">9x</option>
                                            <option value="10">10x</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" style="margin-top: 2rem;">
                    <div class="col" style="text-align: right;">
                        <a href="#" class="btn btn-primary">Confirmar pedido</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection