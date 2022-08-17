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

        </div>

        <div class="col-md-6">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Produtos sem estoque</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Produtos com pouco estoque</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">...</div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
            </div>
        </div>
    </div>

    <div class="row" style="margin-top:2rem;">
        <div class="col-md-12">
            <h4>Produtos em destaque</h4>
        </div>
    </div>

    <div class="row" style="background:#{{$template['templates']->secondarybg}}; padding-top:1rem; padding-bottom:1rem;">
        <div class="col-md-4" style="margin-bottom:0;">
            <div class="card">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <a href="#" class="btn btn-primary">Pesquisar</a>
                </div>
            </div>
        </div>

        <div class="col-md-4" style="margin-bottom:0;">
            <div class="card">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <a href="#" class="btn btn-primary">Pesquisar</a>
                </div>
            </div>
        </div>

        <div class="col-md-4" style="margin-bottom:0;">
            <div class="card">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <a href="#" class="btn btn-primary">Pesquisar</a>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection