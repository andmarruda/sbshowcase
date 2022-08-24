@extends('template.admin')

@section('page')
<div class="col-md-12">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Detalhe do pedido</li>
        </ol>
    </nav>

    @if(!is_null($Order->deleted_at))
    <div class="alert alert-danger">Pedido cancelado em {{date('d/m/Y H:i:s', strtotime($Order->deleted_at))}}</div>
    @endif

    @if(is_null($Order->deleted_at))
    <div class="row" style="margin-top:2rem;">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Alterações do pedido
                </div>
                <div class="card-body">
                    @if($Order->order_status_id!=4 && $Order->order_status_id!=5)
                    <div class="row">
                        <div class="col">
                            <form method="post" action="">
                                @csrf
                                <input type="hidden" name="id" value="{{$Order->id}}">
                                <div class="form-floating">
                                    <select class="form-select" id="order_status_id" name="order_status_id">                    
                                        @foreach($OrderStatus as $status)
                                            @if($Order->order_status_id == $status->id)
                                            <option value="{{$status->id}}" selected="selected">{{$status->status}}</option>
                                            @else
                                            <option value="{{$status->id}}">{{$status->status}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <label for="order_status_id">Status do pedido</label>
                                </div>
                                <button type="submit" class="btn btn-primary" style="margin-top:1rem;">Alterar status do pedido</button>
                            </form>
                        </div>
                        
                        <div class="col">
                            <form method="post" action="">
                                @csrf
                                <input type="hidden" name="id" value="{{$Order->id}}">
                                <button type="submit" class="btn btn-danger">Cancelar pedido</button>
                            </form>
                        </div>
                    </div>
                    @endif

                    @include('template.includes.alert-error')
                </div>
            </div>
        </div>
    </div>
    @endif

    @include('template.includes.order-details', ['Order' => $Order, 'OrderAddress' => $OrderAddress, 'Products' => $Products, 'PaymentMethod' => $PaymentMethod])
</div>
@endsection