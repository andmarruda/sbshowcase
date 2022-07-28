@extends('template.admin')

@section('page')
<form method="post" action="{{route('store.save')}}" autocomplete="off">
    <input type="hidden" name="id" id="id" value="{{$Store->id ?? ''}}">
    @csrf

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Configurações</a></li>
            <li class="breadcrumb-item active" aria-current="page">Lojas</li>
        </ol>
    </nav>

    <div class="mb-3">
        <label for="name" class="form-label">Nome da loja</label>
        <input type="text" minlength="3" maxlength="50" class="form-control" id="name" name="name" placeholder="Nome da loja" required value="{{$Store->name ?? ''}}">
    </div>

    <div class="mb-3">
        <label for="address" class="form-label">Endereço</label>
        <input type="text" minlength="3" maxlength="60" class="form-control" id="address" name="address" placeholder="Endereço" required value="{{$Store->address ?? ''}}">
    </div>

    <div class="mb-3">
        <label for="address_number" class="form-label">Número</label>
        <input type="text" minlength="1" maxlength="60" class="form-control" id="address_number" name="address_number" placeholder="Número" required value="{{$Store->address_number ?? ''}}">
    </div>

    <div class="mb-3">
        <label for="address_complement" class="form-label">Complemento</label>
        <input type="text" class="form-control" id="address_complement" name="address_complement" placeholder="Complemento" value="{{$Store->address_complement ?? ''}}">
    </div>

    <div class="mb-3">
        <label for="address_neighborhood" class="form-label">Bairro</label>
        <input type="text" minlength="3" maxlength="60" class="form-control" id="address_neighborhood" name="address_neighborhood" placeholder="Bairro" required value="{{$Store->address_neighborhood ?? ''}}">
    </div>

    <div class="mb-3">
        <label for="address_city" class="form-label">Cidade</label>
        <input type="text" minlength="3" maxlength="60" class="form-control" id="address_city" name="address_city" placeholder="Cidade" required value="{{$Store->address_city ?? ''}}">
    </div>

    <div class="mb-3">
        <label for="address_state" class="form-label">UF</label>
        <input type="text" minlength="2" maxlength="3" class="form-control" id="address_state" name="address_state" placeholder="UF" required value="{{$Store->address_state ?? ''}}">
    </div>

    <div class="mb-3">
        <label for="address_zipcode" class="form-label">CEP</label>
        <input type="text" maxlength="10" class="form-control" id="address_zipcode" name="address_zipcode" placeholder="CEP" required value="{{$Store->address_zipcode ?? ''}}">
    </div>

    <div class="mb-3">
        <label for="phone" class="form-label">Telefone</label>
        <input type="text" minlength="15" maxlength="20" class="form-control" id="phone" name="phone" placeholder="Número" required value="{{$Store->phone ?? ''}}">
    </div>

    <div class="mb-3">
        <label for="address_country" class="form-label">País</label>
        <input type="text" maxlength="30" class="form-control" id="address_country" name="address_country" placeholder="País" required value="{{$Store->address_country ?? 'Brasil'}}">
    </div>

    <div class="mb-3">
        <label for="google_maps_embeded" class="form-label">Google Maps</label>
        <input type="text" minlength="5" class="form-control" id="google_maps_embeded" name="google_maps_embeded" placeholder="Google Maps" required value="{{$Store->google_maps_embeded ?? ''}}">
    </div>

    @include('template.includes.alert-error')

    @if(!is_null(session('saved')))
        @include('template.includes.alert-saved', ['success' => 'Marca salva com sucesso!', 'error' => 'Erro ao salvar marca!', 'saved' => session('saved')])
    @endif

    <div class="mb-3">
        @if(is_null($Store) || is_null($Store->deleted_at))
        <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk"></i> Salvar</button>
        @endif

        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#searchModal">Pesquisar</button>

        @if(!is_null($Store))
        @include('template.includes.disable-enable', ['enabled' => is_null($Store->deleted_at), 'route' => route('store.delete'), 'id' => $Store->id, 'token' => csrf_token()])
        @endif
    </div>
</form>

@include('template.includes.search-modal', ['modalTitle' => 'Pesquisar marca', 'placeholder' => 'Marca', 'route' => route('store.search'), 'loadRoute' => route('store'), 'ths' => ['#', 'Marca', 'Ativa?']])
@endsection