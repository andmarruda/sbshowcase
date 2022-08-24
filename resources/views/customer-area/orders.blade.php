@extends('template.customer')

@section('page')
<div class="col-md-12">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Área do cliente</a></li>
            <li class="breadcrumb-item active" aria-current="page">Meus pedidos</li>
        </ol>
    </nav>

    <p>Bem vindo(a) {{$_SESSION['sbcustomer-area']['name']}}</p>

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
                <td><a href="{{route('customer-order-detail', ['id' => $order->id])}}" class="btn btn-outline-primary">Detalhes</a></td>
            </tr>
            @empty
            <tr>
                <td colspan="5">Nenhum pedido encontrado!</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection