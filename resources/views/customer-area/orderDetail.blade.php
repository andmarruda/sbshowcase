@extends('template.customer')

@section('page')
<div class="col-md-12">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Área do cliente</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detalhe do pedido</li>
        </ol>
    </nav>

    <p>Bem vindo(a) {{$_SESSION['sbcustomer-area']['name']}}</p>

    @if(!is_null($Order->deleted_at))
    <div class="alert alert-danger">Pedido cancelado em {{date('d/m/Y H:i:s', strtotime($Order->deleted_at))}}</div>
    @endif

    @include('template.includes.order-details', ['Order' => $Order, 'OrderAddress' => $OrderAddress, 'Products' => $Products, 'PaymentMethod' => $PaymentMethod])

    @if(is_null($Order->deleted_at))
    <div class="row" style="margin-top:2rem;">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Cancelamento do pedido
                </div>
                <div class="card-body">
                    @if($Order->order_status_id==1)
                    <form method="post" action="{{route('customer-cancel-order')}}">
                        @csrf
                        <input type="hidden" name="id" value="{{$Order->id}}">
                        <button type="submit" class="btn btn-outline-danger">Cancelar pedido</button>
                    </form>
                    @else
                    Para cancelar um pedido que já está em andamento é necessário entrar em contato através do nosso Whatsapp.
                    @endif

                    @include('template.includes.alert-error')
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection