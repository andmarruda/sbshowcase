<!DOCTYPE html>
<html lang="pt-BR">
    @include('template.includes.head', ['title' => $template['general']->brand.' - Área do cliente'])
    <body class="body-admin">
        <div class="container-lg">
            <div class="row">
                <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #{{$template['templates']->primarybg}}; color: #{{$template['templates']->primarycolor}}; font-weight:bold;">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#">{{$template['general']->brand}}</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#admin-navbar" aria-controls="admin-navbar" aria-expanded="false">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="admin-navbar">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="{{route('customer-area')}}">Meus pedidos</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="{{route('customer-change-password')}}">Alterar senha</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="{{route('customer-registration-data')}}">Dados cadastrais</a>
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
                        <h5 class="modal-title">Sair da área do cliente?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Deseja sair da área do cliente?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-angle-left"></i> Permanecer</button>
                        <a href="{{route('customer-logout')}}" role="button" class="btn btn-primary"><i class="fa-solid fa-power-off"></i> Sair</a>
                    </div>
                </div>
            </div>
        </div>

        <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('js/fontawesome/all.min.js')}}"></script>
        <script src="{{asset('js/sbadmin.js')}}"></script>
        @if(\Request::route()->getName()=='registration-data')
        <script src="{{asset('js/sbpublic.js')}}"></script>
        <script src="{{asset('js/vanilla-masker.min.js')}}"></script>
        @endif
    </body>
</html>