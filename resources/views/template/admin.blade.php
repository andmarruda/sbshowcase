<!DOCTYPE html>
<html>
    @include('template.includes.head', ['title' => 'SBShowcase - Admin'])
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bglight">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">SBShowcase</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#admin-navbar" aria-controls="admin-navbar" aria-expanded="false">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="admin-navbar">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Dashboard</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#">Pedidos</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Produto
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{route('category')}}">Categoria</a></li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Configurações
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Template</a></li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#">Sair</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        
        <div class="container-lg">
            <div class="row">
                @yield('page')
            </div>
        </div>

        <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
    </body>
</html>