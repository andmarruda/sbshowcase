@extends('template.admin')

@section('page')
<form method="post" action="{{route('template.save')}}" autocomplete="off">
    <input type="hidden" name="id" id="id" value="{{$Template->id}}">
    @csrf

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Template</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cores do layout</li>
        </ol>
    </nav>

    <div class="mb-3">
        <label for="primarybg" class="form-label">Bg primário</label>
        <input type="color" class="form-control" id="primarybg" name="primarybg" placeholder="Bg primário" required value="#{{$Template->primarybg}}">
    </div>

    <div class="mb-3">
        <label for="primarycolor" class="form-label">Cor do texto primário</label>
        <input type="color" class="form-control" id="primarycolor" name="primarycolor" placeholder="Cor do texto primário" required value="#{{$Template->primarycolor}}">
    </div>

    <div class="mb-3">
        <label for="secondarybg" class="form-label">Bg secundário</label>
        <input type="color" class="form-control" id="secondarybg" name="secondarybg" placeholder="Bg secundário" required value="#{{$Template->secondarybg}}">
    </div>

    <div class="mb-3">
        <label for="secondarycolor" class="form-label">Cor do texto secundário</label>
        <input type="color" class="form-control" id="secondarycolor" name="secondarycolor" placeholder="Cor do texto secundário" required value="#{{$Template->secondarycolor}}">
    </div>

    <div class="mb-3">
        <label for="highlightbg" class="form-label">Bg destaque 1</label>
        <input type="color" class="form-control" id="highlightbg" name="highlightbg" placeholder="Bg destaque 1" required value="#{{$Template->highlightbg}}">
    </div>

    <div class="mb-3">
        <label for="highlightcolor" class="form-label">Cor do texto destaque 1</label>
        <input type="color" class="form-control" id="highlightcolor" name="highlightcolor" placeholder="Cor do texto destaque 1" required value="#{{$Template->highlightcolor}}">
    </div>

    @include('template.includes.alert-error')

    @if(!is_null(session('saved')))
        @include('template.includes.alert-saved', ['success' => 'Template salvo com sucesso!', 'error' => 'Erro ao salvar template!', 'saved' => session('saved')])
    @endif

    <div class="mb-3">
        <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk"></i> Salvar</button>
    </div>
</form>
@endsection