@extends('template.admin')

@section('page')
<form method="post" id="BannerForm" action="{{route('category.save')}}" autocomplete="off" enctype="multipart/form-data">
    <input type="hidden" name="id" id="id" value="{{$Banner->id ?? ''}}">
    @csrf

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Configurações</a></li>
            <li class="breadcrumb-item active" aria-current="page">Banner</li>
        </ol>
    </nav>

    <div class="row" style="margin-bottom:1.5rem;">
        <div class="col">
            <label for="name" class="form-label">Nome do banner</label>
            <input type="text" minlength="6" maxlength="150" class="form-control" id="name" name="name" placeholder="Nome do banner" required value="{{$Banner->name ?? ''}}">
        </div>

        <div class="col">
            <label for="link_id" class="form-label">Link do produto</label>
            <select class="form-control" id="link_id" name="link_id" required>
                <option value="">Selecione...</option>
            </select>
        </div>
    </div>

    <div class="row" style="margin-bottom:1.5rem;">
        <div class="col">
            <h6>Imagem atual</h6><hr>
            <img src="{{!is_null($Banner) ? asset('storage/'.$Banner->image) : ''}}" id="img-preview" class="img-thumbnail" alt="Imagem do produto">
        </div>
    </div>

    <div class="row" style="margin-bottom:1.5rem;">
        <div class="col">
            <label for="image" class="form-label">Imagem do produto</label>
            <input type="file" class="form-control" id="image" name="image" placeholder="Imagem do produto">
        </div>

        <div class="col">
            <label for="alt" class="form-label">Descrição do banner</label>
            <input type="text" minlength="6" maxlength="150" class="form-control" id="alt" name="alt" placeholder="Descrição do banner" required value="{{$Banner->alt ?? ''}}">
        </div>
    </div>

    @include('template.includes.alert-error')

    @if(!is_null(session('saved')))
        @include('template.includes.alert-saved', ['success' => 'Banner salvo com sucesso!', 'error' => 'Erro ao salvar o banner!', 'saved' => session('saved')])
    @endif

    <div class="mb-3">
        @if(is_null($Banner) || is_null($Banner->deleted_at))
        <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk"></i> Salvar</button>
        @endif

        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fa-solid fa-magnifying-glass"></i> Pesquisar</button>

        @if(!is_null($Banner))
        @include('template.includes.disable-enable', ['enabled' => is_null($Banner->deleted_at), 'route' => route('category.delete'), 'id' => $Banner->id, 'token' => csrf_token()])
        @endif
    </div>
</form>

@include('template.includes.search-modal', ['modalTitle' => 'Pesquisar banner', 'placeholder' => 'Banner', 'route' => route('category.search'), 'loadRoute' => route('banner'), 'ths' => ['#', 'Banner', 'Ativa?']])

<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.getElementById('image').addEventListener('change', (event) => {
            previewImage(event, 'img-preview');
        });
    });
</script>
@endsection