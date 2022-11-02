@extends('template.admin')

@section('page')
<form method="post" action="{{route('payment-footer.store')}}" autocomplete="off" enctype="multipart/form-data">
    @csrf
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Template</a></li>
            <li class="breadcrumb-item active" aria-current="page">Bandeiras de Pagamento disponíveis</li>
        </ol>
    </nav>

    <div class="row" style="margin-bottom:1.5rem;">
        <div class="col">
            <h6>Imagem da forma de pagamento</h6><hr>
            <img src="" srcset="" id="img-preview" class="img-thumbnail" alt="Imagem da forma de pagamento">
        </div>
    </div>

    <div class="row" style="margin-bottom:1.5rem;">
        <div class="col">
            <label for="image" class="form-label">Imagem da forma de pagamento <small>Recomendado 25x25 pixels</small></label>
            <input type="file" class="form-control" id="image" name="image" placeholder="Imagem da forma de pagamento">
        </div>

        <div class="col">
            <label for="alt" class="form-label">Descrição da forma de pagamento</label>
            <input type="text" minlength="3" maxlength="50" class="form-control" id="description" name="description" placeholder="Descrição da forma de pagamento" required value="">
        </div>
    </div>

    @include('template.includes.alert-error')

    @if(!is_null(session('saved')))
        @include('template.includes.alert-saved', ['success' => 'Bandeira de forma de pagamento salva com sucesso!', 'error' => 'Erro ao salvar a bandeira da forma de pagamento!', 'saved' => session('saved')])
    @endif

    <div class="mb-3">
        <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk"></i> Salvar</button>
        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fa-solid fa-magnifying-glass"></i> Pesquisar</button>
    </div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.getElementById('image').addEventListener('change', (event) => {
            previewImage(event, 'img-preview');
        });
    });
</script>
@endsection