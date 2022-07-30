@extends('template.admin')

@section('page')
<form method="post" action="{{route('social-media.save')}}" autocomplete="off">
    @csrf

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Configurações</a></li>
            <li class="breadcrumb-item active" aria-current="page">Media Social</li>
        </ol>
    </nav>

    @foreach($SocialMedia as $sm)
    <div class="input-group mb-3">
        <span class="input-group-text"><img src="{{asset($sm->icon)}}" alt="{{$sm->name}}"></span>
        <input type="text" class="form-control" placeholder="URL da rede social" aria-label="Username" aria-describedby="basic-addon1">
    </div>
    @endforeach

    @include('template.includes.alert-error')

    @if(!is_null(session('saved')))
        @include('template.includes.alert-saved', ['success' => 'Medias sociais salvsa com sucesso!', 'error' => 'Erro ao salvar medias sociais!', 'saved' => session('saved')])
    @endif

    <div class="mb-3">
        <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk"></i> Salvar</button>
    </div>
</form>
@endsection