@extends('template.admin')

@section('page')
<form method="post" action="{{route('users.save')}}" autocomplete="off">
    <input type="hidden" name="id" id="id" value="{{$User->id ?? ''}}">
    @csrf

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        </ol>
    </nav>

    <div class="row" style="margin-top:2rem;">
        <div class="col-md-6">
            <h4>Pedidos no mês atual</h4>
        </div>

        <div class="col-md-6">
            <div class="alert alert-info">Aqui é mostrado produtos que tem menos de 5 disponível para venda!</div>

            <table class="table table-bordered table-striped" style="margin-top:2rem;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Produto</th>
                        <th>Categoria</th>
                        <th>Medida</th>
                        <th>Em estoque</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($Products as $product)
                    <tr>
                        <td>{{$product->id}}</td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->category()->first()->name}}</td>
                        <td>{{$product->measure()->first()->getLabel()}}</td>
                        <td>{{$product->quantity}}</td>
                        <td><a href="#" class="btn btn-outline-primary" role="button"><i class="fa-solid fa-file-pen"></i> Editar</a></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">Nenhum produto encontrado!</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="row" style="margin-top:2rem;">
        <div class="col-md-12">
            <h4>Produtos em destaque</h4>
        </div>
    </div>

    <div class="row" style="background:#{{$template['templates']->secondarybg}}; padding-top:1rem; padding-bottom:1rem; margin-bottom:2rem;">
        <div class="col-md-4" style="margin-bottom:0;">
            @include('admin.dashboard-highlight')
        </div>

        <div class="col-md-4" style="margin-bottom:0;">
            @include('admin.dashboard-highlight')
        </div>

        <div class="col-md-4" style="margin-bottom:0;">
            @include('admin.dashboard-highlight')
        </div>
    </div>
</form>
@endsection