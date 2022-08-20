<!DOCTYPE html>
<html lang="pt-BR">
    @include('template.includes.head', ['title' => config('app.name').' - Admin'])
    <body class="body-admin">
        <div class="container-lg">
            <div class="row">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="{{route('dashboard')}}">SBShowcase</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#admin-navbar" aria-controls="admin-navbar" aria-expanded="false">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="admin-navbar">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="{{route('dashboard')}}">Dashboard</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('order')}}">Pedidos</a>
                                </li>

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Produto
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item" href="{{route('category')}}">Categoria</a></li>
                                        <li><a class="dropdown-item" href="{{route('measurement')}}">Medidas</a></li>
                                        <li><a class="dropdown-item" href="{{route('color')}}">Cores</a></li>
                                        <li><a class="dropdown-item" href="{{route('brand')}}">Marcas</a></li>
                                        <li><a class="dropdown-item" href="{{route('type')}}">Tipos</a></li>
                                        <li><a class="dropdown-item" href="{{route('product')}}">Produtos</a></li>
                                        <li><a class="dropdown-item" href="{{route('product.search')}}">Listar produtos</a></li>
                                    </ul>
                                </li>

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Configurações
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item" href="{{route('email.notifications')}}">Notificar emails</a></li>
                                        <li><a class="dropdown-item" href="{{route('template')}}">Template</a></li>
                                        <li><a class="dropdown-item" href="{{route('banner')}}">Banner</a></li>
                                        <li><a class="dropdown-item" href="{{route('store')}}">Lojas</a></li>
                                        <li><a class="dropdown-item" href="{{route('general')}}">Geral</a></li>
                                        <li><a class="dropdown-item" href="{{route('social-media')}}">Redes Sociais</a></li>
                                        <li><a class="dropdown-item" href="{{route('payment-methods')}}">Formas de pagamento</a></li>
                                        <li><a class="dropdown-item" href="{{route('delivery')}}">Entrega</a></li>
                                        <li><a class="dropdown-item" href="{{route('users')}}">Usuários</a></li>
                                        <li><a class="dropdown-item" href="{{route('change-password')}}">Alterar senha</a></li>
                                        <li><a class="dropdown-item" href="{{route('email.providers')}}">Provedor de Email</a></li>
                                    </ul>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="javascript: void(0);" data-bs-toggle="modal" data-bs-target="#logoutModal">Sair</a>
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

        <div class="modal fade" id="logoutModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Sair do sistema</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Deseja prosseguir e sair do sistema?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-angle-left"></i> Permanecer</button>
                        <a href="{{route('logout')}}" role="button" class="btn btn-primary"><i class="fa-solid fa-power-off"></i> Sair</a>
                    </div>
                </div>
            </div>
        </div>


        <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('js/fontawesome/all.min.js')}}"></script>
        <script src="{{asset('js/sbadmin.js')}}"></script>
        
        @if(\Request::route()->getName()=='product')
        <script src="{{asset('js/highlight.min.js')}}"></script>
        <script src="{{asset('js/quill.min.js')}}"></script>
        @endif

        @if(\Request::route()->getName()=='dashboard')
        <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
        @endif
    </body>
</html>