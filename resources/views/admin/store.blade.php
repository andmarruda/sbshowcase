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

    $table->string('name');
            $table->string('address');
            $table->string('address_number');
            $table->string('address_complement')->nullable();
            $table->string('address_neighborhood');
            $table->string('address_city');
            $table->string('address_state');
            $table->string('address_zipcode');
            $table->string('address_country');
            $table->string('google_maps_embeded');
            $table->string('phone');

    <div class="mb-3">
        <label for="name" class="form-label">Nome da loja</label>
        <input type="text" minlength="3" maxlength="50" class="form-control" id="name" name="name" placeholder="Nome da marca" required value="{{$Brand->name ?? ''}}">
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
        @include('template.includes.disable-enable', ['enabled' => is_null($Store->deleted_at), 'route' => route('brand.delete'), 'id' => $Store->id, 'token' => csrf_token()])
        @endif
    </div>
</form>

@include('template.includes.search-modal', ['modalTitle' => 'Pesquisar marca', 'placeholder' => 'Marca', 'route' => route('brand.search'), 'loadRoute' => route('brand'), 'ths' => ['#', 'Marca', 'Ativa?']])
@endsection