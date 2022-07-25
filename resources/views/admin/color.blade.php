@extends('template.admin')

@section('page')
<form method="post" action="{{route('color.save')}}" autocomplete="off">
    <input type="hidden" name="id" id="id" value="{{$Color->id ?? ''}}">
    @csrf

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Produto</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cores</li>
        </ol>
    </nav>

    <div class="mb-3">
        <label for="name" class="form-label">Nome da cor</label>
        <input type="text" required step="1" maxlength="15" class="form-control" id="name" name="name" placeholder="Nome da cor" value="{{$Color->name ?? ''}}">
    </div>

    <div class="mb-3">
        <label for="hex_color" class="form-label">Cor</label>
        <input type="color" required class="form-control" id="hex_code" name="hex_code" placeholder="Cor" value="{{$Color->hex_code ?? ''}}">
    </div>

    @include('template.includes.alert-error')

    @if(!is_null(session('saved')))
        @include('template.includes.alert-saved', ['success' => 'Medida salva com sucesso!', 'error' => 'Erro ao salvar medida!', 'saved' => session('saved')])
    @endif

    <div class="mb-3">
        @if(is_null($Color) || is_null($Color->deleted_at))
        <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk"></i> Salvar</button>
        @endif

        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#searchModal">Pesquisar</button>

        @if(!is_null($Color))
        @include('template.includes.disable-enable', ['enabled' => is_null($Color->deleted_at), 'route' => route('color.delete'), 'id' => $Color->id, 'token' => csrf_token()])
        @endif
    </div>
</form>

@include('template.includes.search-modal', ['modalTitle' => 'Pesquisar cores', 'placeholder' => 'Cor', 'route' => route('color.search'), 'loadRoute' => route('color'), 'ths' => ['#', 'Cor', 'Ativa?']])
@endsection