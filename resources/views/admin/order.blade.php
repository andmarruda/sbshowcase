@extends('template.admin')

@section('page')
<form method="post" action="{{route('admin.order.search')}}" autocomplete="off">
    <input type="hidden" name="id" id="id" value="{{$User->id ?? ''}}">
    @csrf

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Pedidos</a></li>
        </ol>
    </nav>

    <div class="row">
        <div class="col">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Nome do cliente" value="{{session('customer_name') ?? ''}}">
                <label for="customer_name">Nome do cliente</label>
            </div>
        </div>

        <div class="col">
            <div class="form-floating">
                <input type="text" class="form-control" id="customer_document" name="customer_document" placeholder="CPF / CNPJ do cliente" value="{{session('customer_document') ?? ''}}">
                <label for="customer_document">CPF / CNPJ do cliente</label>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            Período da compra
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="form-floating mb-3">
                <input type="date" class="form-control" id="initial_order_date" name="initial_order_date" placeholder="Data inicial" value="{{session('initial_order_date') ?? ''}}">
                <label for="initial_order_date">Data inicial</label>
            </div>
        </div>

        <div class="col">
            <div class="form-floating">
                <input type="date" class="form-control" id="final_order_date" name="final_order_date" placeholder="Data final" value="{{session('final_order_date') ?? ''}}">
                <label for="final_order_date">Data final</label>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            Período do cancelamento da compra
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="form-floating mb-3">
                <input type="date" class="form-control" id="initial_order_date_delete" name="initial_order_date_delete" placeholder="Data inicial" value="{{session('initial_order_date_delete') ?? ''}}">
                <label for="initial_order_date_delete">Data inicial</label>
            </div>
        </div>

        <div class="col">
            <div class="form-floating">
                <input type="date" class="form-control" id="final_order_date_delete" name="final_order_date_delete" placeholder="Data final" value="{{session('final_order_date_delete') ?? ''}}">
                <label for="final_order_date_delete">Data final</label>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="form-floating">
                <select class="form-select" id="order_status_id" name="order_status_id">                    
                    @foreach($OrderStatus as $status)
                        @if((session('order_status_id') ?? 1) == $status->id)
                        <option value="{{$status->id}}" selected="selected">{{$status->status}}</option>
                        @else
                        <option value="{{$status->id}}">{{$status->status}}</option>
                        @endif
                    @endforeach
                </select>
                <label for="order_status_id">Status do pedido</label>
            </div>
        </div>

        <div class="col">
            <button type="submit" class="btn btn-primary" style="margin-top:0.6rem; margin-left:2rem;"><i class="fa-solid fa-magnifying-glass"></i> Pesquisar</button>
        </div>
    </div>

    <div class="row" style="margin-top: 2rem;">
        <div class="col">
            <div class="alert alert-warning">Caso nenhum filtro seja selecionado aparecem todos os pedidos pendentes!</div>
        </div>
    </div>

    <div class="row" style="margin-top: 2rem;">
        <div class="col">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Nº do pedido</th>
                        <th>Data</th>
                        <th>Valor</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($Orders as $order)
                    <tr>
                        <td>{{$order->id}}</td>
                        <td>{{date('d/m/Y H:i:s', strtotime($order->created_at))}}</td>
                        <td>R${{number_format($order->total, 2, ',', '.')}}</td>
                        @if(is_null($order->deleted_at))
                        <td><span class="badge" style="background:{{$order->order_status()->first()->hex_color}}; border:1px solid #000;">&nbsp;</span> {{$order->order_status()->first()->status}}</td>
                        @else
                        <td><span class="badge" style="background:red; border:1px solid #000;">&nbsp;</span> Cancelado</td>
                        @endif
                        <td><a href="#" class="btn btn-outline-primary">Detalhes</a></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">Nenhum pedido encontrado</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</form>
@endsection