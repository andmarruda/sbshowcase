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
        <tbody></tbody>
    </table>
</div>
@endsection