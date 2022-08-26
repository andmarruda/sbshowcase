@extends('template.admin')

@section('page')
<div class="col-md-12">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        </ol>
    </nav>

    <div class="row" style="margin-top:2rem;">
        <div class="col-md-6">
            <h4>Pedidos no mês atual</h4>
            <div class="alert alert-info">Estatística do mês corrente, referente do dia 1 ao último dia do mês.</div>
            <p><b>Período</b> {{$initial_date}} até {{$final_date}}</p>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Status</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($OrderStatus as $status)
                    <tr>
                        <td><span class="badge" style="background:{{$status->hex_color}}; border:1px solid #000;">&nbsp;</span> <strong>{{$status->status}}</strong></td>
                        <td>R${{number_format($status->order()->whereBetween('created_at', [$initial_date, $final_date])->withTrashed()->sum('total'), 2, ',', '.')}}</td>
                    </tr>
                    @empty
                    <tr><td colspan="2">Nenhum status encontrado!</td></tr>
                    @endforelse
                </tbody>
            </table>
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
                        <td><a href="{{route('product', ['id' => $product->id])}}" class="btn btn-outline-primary" role="button"><i class="fa-solid fa-file-pen"></i> Editar</a></td>
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
        <div class="col-md-4" style="margin-bottom:0;" data-target="1">
            @include('admin.dashboard-highlight', ['product' => $General->highlightProduct1()->first()])
        </div>

        <div class="col-md-4" style="margin-bottom:0;" data-target="2">
            @include('admin.dashboard-highlight', ['product' => $General->highlightProduct2()->first()])
        </div>

        <div class="col-md-4" style="margin-bottom:0;" data-target="3">
            @include('admin.dashboard-highlight', ['product' => $General->highlightProduct3()->first()])
        </div>
    </div>
</div>

<div class="modal fade" id="dashboard-product" tabindex="-1">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Pesquisar produto</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form class="row g-3" id="formModalSearchDashboard" action="javascript: searchProductDashboard('{{{route('search-product')}}}');" autocomplete="off">
                <input type="hidden" name="highlight_target" id="highlight_target" value="">
                @csrf
                <div class="col-md-6">
                    <input type="text" class="form-control" id="searchInput" name="searchInput" placeholder="Nome do produto" required="">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary mb-3">Pesquisar</button>
                </div>
            </form>
            <table class="table table-bordered table-striped" style="margin-top:2rem;" id="gridDashboardProduct">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Produto</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
  </div>
</div>

<form style="display:none;" id="form-change-highlight-product" action="{{route('update-highlight-product')}}" method="post">
    @csrf
    <input type="hidden" name="highlight_target" id="highlight_target" value="">
    <input type="hidden" name="product_id" id="product_id" value="">
</form>

<script>
    const highlight_choosed = ({target}) => {
        let number = target.closest('.col-md-4').getAttribute('data-target');
        document.getElementById('highlight_target').value = number;
    }

    document.addEventListener('DOMContentLoaded', () => {
        document.getElementById('dashboard-product').addEventListener('hidden.bs.modal', function (event) {
            document.getElementById('highlight_target').value = '';
            let tbody = document.getElementById('gridDashboardProduct').querySelector('TBODY');
            tbody.innerHTML = '';
        });
    });

    const searchProductDashboard = async (url) => {
        let fd = new FormData(document.getElementById('formModalSearchDashboard'));
        let tbody = document.getElementById('gridDashboardProduct').querySelector('TBODY');
        tbody.innerHTML = '';
        let f = await fetch(url, {
            method: 'POST',
            body: fd
        });

        let j = await f.json();
        if(j.length > 0){
            for(let i of j){
                tbody.innerHTML += '<tr>\
                    <td>'+i.id+'</td>\
                    <td>'+i.name+'</td>\
                    <td><a href="javascript: void(0);" onclick="javascript: confirmHighlight('+ i.id +');" role="button" class="btn btn-primary">Alterar destaque</a></td>\
                </tr>';
            }
        } else{
            tbody.innerHTML += '<tr>\
                <td colspan="3">Nenhum produto encontrado!</td>\
            </tr>';
        }
    }

    const confirmHighlight = (product_id) => {
        if(confirm("Deseja alterar o produto de destaque?")){
            let form = document.getElementById('form-change-highlight-product');
            form.querySelector('#highlight_target').value = document.getElementById('highlight_target').value;
            form.querySelector('#product_id').value = product_id;
            form.submit();
        }
    }
</script>

@endsection