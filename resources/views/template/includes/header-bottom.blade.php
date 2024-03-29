<div class="row">
    <div class="col-md-9 offset-md-3">
        <nav class="navbar navbar-expand-lg navbar-dark main-menu" style="background-color: #{{$template->primarybg}}; color: #{{$template->primarycolor}}; font-weight:bold;">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        @foreach($menu as $item)
                            <li class="nav-item">
                                <a class="nav-link active" href="{{route('product-list', ['id' => $item->id, 'name' => str_replace(' ', '-', $item->name)])}}" title="{{$item->name}}">{{$item->name}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>