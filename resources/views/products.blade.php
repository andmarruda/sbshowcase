@extends('template.publicTemplate', ['instagram' => 'https://www.instagram.com/biosonocolchoesrp', 'facebook' => 'https://biosonocolchoes.com.br/dist/icons/fb.png', 'whatsapp' => 'https://api.whatsapp.com/send?phone=55(16)99999-0000', 'title' => 'SBShowCase'])

@section('page')
<div id="sbshowcase-banner" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{asset('images/banner-example.png')}}" class="d-block w-100" alt="Banner">
        </div>
    </div>
</div>
@endsection