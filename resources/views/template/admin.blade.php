<!DOCTYPE html>
<html>
    @include('template.includes.head', ['title' => 'SBShowcase - Admin'])
    <body class="body-admin">
        <div class="container-lg">
            <div class="row">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
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
            </div>

            <div class="row admin-content">
                @yield('page')
            </div>

            <footer class="row">
                <div class="d-flex justify-content-between align-items-center">
                    Todos os direitos reservados. © 2021-2031

                    <div>
                        SBShowcase Powered By <a href="https://sysborg.com.br" target="_blank" title="https://sysborg.com.br">
                            <img src="{{asset('images/poweredby.png')}}" alt="Powered By Sysborg">
                        </a> <span style="margin-left:10px; margin-right:10px;">|</span> <a href="https://andersonarruda.com.br" target="_blank" title="https://andersonarruda.com.br">
                            <img src="{{asset('images/poweredby2.png')}}" alt="Powered By Anderson Arruda">
                        </a>
                    </div>
                </div>
            </footer>
        </div>

        <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('js/sbadmin.js')}}"></script>
    </body>
</html>