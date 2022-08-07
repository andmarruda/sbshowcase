@extends('template.public')

@section('page')
<div class="row">
    <div class="col-md-12" style="margin: 2rem 0;">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="javascript: void(0);">{{$Category->name}}</a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#aside-menu" aria-controls="aside-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>
    </div>

    <div class="col-md-3 collapse" id="aside-menu">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Tamanho</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Largura x Comprimento x Altura</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">Active</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>

            <li class="nav-item">
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Cor</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">Active</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
        </ul>
    </div>

    <div class="col-md-9 product-list">
        <div class="row">
            <section class="col-md-4">
                <img src="images/example.png" alt="Produto tal">
                <div class="infos">
                    <h2>CONJ. Box Queen Sealy Charleston Resort</h2>
                    <p>Colchão Sealy Charleston, sua estrutura de suporte central é formada por um dos sistemas de molas, mais eficiente do planeta...</p>
                    <p class="old-price">De: R$2.700,00</p>
                    <p class="price">Por: R$1.990,00</p>
                    <small>Em até 12xR$164.90 sem juros no cartão de crédito</small>
                </div>

                <div class="action">
                    <a href="#" role="button" class="btn btn-light">Saiba mais</a>
                    <a href="#" role="button" class="btn" style="background-color: #665132; color:#fff;">+ Carrinho</a>
                </div>
            </section>

            <section class="col-md-4">
                <img src="images/example.png" alt="Produto tal">
                <div class="infos">
                    <h2>CONJ. Box Queen Sealy Charleston Resort</h2>
                    <p>Colchão Sealy Charleston, sua estrutura de suporte central é formada por um dos sistemas de molas, mais eficiente do planeta...</p>
                    <p class="old-price">De: R$2.700,00</p>
                    <p class="price">Por: R$1.990,00</p>
                    <small>Em até 12xR$164.90 sem juros no cartão de crédito</small>
                </div>

                <div class="action">
                    <a href="#" role="button" class="btn btn-light">Saiba mais</a>
                    <a href="#" role="button" class="btn" style="background-color: #665132; color:#fff;">+ Carrinho</a>
                </div>
            </section>

            <section class="col-md-4">
                <img src="images/example.png" alt="Produto tal">
                <div class="infos">
                    <h2>CONJ. Box Queen Sealy Charleston Resort</h2>
                    <p>Colchão Sealy Charleston, sua estrutura de suporte central é formada por um dos sistemas de molas, mais eficiente do planeta...</p>
                    <p class="old-price">De: R$2.700,00</p>
                    <p class="price">Por: R$1.990,00</p>
                    <small>Em até 12xR$164.90 sem juros no cartão de crédito</small>
                </div>

                <div class="action">
                    <a href="#" role="button" class="btn btn-light">Saiba mais</a>
                    <a href="#" role="button" class="btn" style="background-color: #665132; color:#fff;">+ Carrinho</a>
                </div>

                <div class="free-shipping position-absolute top-0 rounded-pill w-75" role="alert" style="background: #3D8DCB; color:#fff;">
                    Frete grátis Rib. Preto - SP
                </div>
            </section>
        </div>

        <div class="row">
            <section class="col-md-4">
                <img src="images/example.png" alt="Produto tal">
                <div class="infos">
                    <h2>CONJ. Box Queen Sealy Charleston Resort</h2>
                    <p>Colchão Sealy Charleston, sua estrutura de suporte central é formada por um dos sistemas de molas, mais eficiente do planeta...</p>
                    <p class="old-price">De: R$2.700,00</p>
                    <p class="price">Por: R$1.990,00</p>
                    <small>Em até 12xR$164.90 sem juros no cartão de crédito</small>
                </div>

                <div class="action">
                    <a href="#" role="button" class="btn btn-light">Saiba mais</a>
                    <a href="#" role="button" class="btn" style="background-color: #665132; color:#fff;">+ Carrinho</a>
                </div>
            </section>

            <section class="col-md-4">
                <img src="images/example.png" alt="Produto tal">
                <div class="infos">
                    <h2>CONJ. Box Queen Sealy Charleston Resort</h2>
                    <p>Colchão Sealy Charleston, sua estrutura de suporte central é formada por um dos sistemas de molas, mais eficiente do planeta...</p>
                    <p class="old-price">De: R$2.700,00</p>
                    <p class="price">Por: R$1.990,00</p>
                    <small>Em até 12xR$164.90 sem juros no cartão de crédito</small>
                </div>

                <div class="action">
                    <a href="#" role="button" class="btn btn-light">Saiba mais</a>
                    <a href="#" role="button" class="btn" style="background-color: #665132; color:#fff;">+ Carrinho</a>
                </div>
            </section>

            <section class="col-md-4">
                <img src="images/example.png" alt="Produto tal">
                <div class="infos">
                    <h2>CONJ. Box Queen Sealy Charleston Resort</h2>
                    <p>Colchão Sealy Charleston, sua estrutura de suporte central é formada por um dos sistemas de molas, mais eficiente do planeta...</p>
                    <p class="old-price">De: R$2.700,00</p>
                    <p class="price">Por: R$1.990,00</p>
                    <small>Em até 12xR$164.90 sem juros no cartão de crédito</small>
                </div>

                <div class="action">
                    <a href="#" role="button" class="btn btn-light">Saiba mais</a>
                    <a href="#" role="button" class="btn" style="background-color: #665132; color:#fff;">+ Carrinho</a>
                </div>

                <div class="free-shipping position-absolute top-0 rounded-pill w-75" role="alert" style="background: #3D8DCB; color:#fff;">
                    Frete grátis Rib. Preto - SP
                </div>
            </section>
        </div>

        <div class="row">
            <section class="col-md-4">
                <img src="images/example.png" alt="Produto tal">
                <div class="infos">
                    <h2>CONJ. Box Queen Sealy Charleston Resort</h2>
                    <p>Colchão Sealy Charleston, sua estrutura de suporte central é formada por um dos sistemas de molas, mais eficiente do planeta...</p>
                    <p class="old-price">De: R$2.700,00</p>
                    <p class="price">Por: R$1.990,00</p>
                    <small>Em até 12xR$164.90 sem juros no cartão de crédito</small>
                </div>

                <div class="action">
                    <a href="#" role="button" class="btn btn-light">Saiba mais</a>
                    <a href="#" role="button" class="btn" style="background-color: #665132; color:#fff;">+ Carrinho</a>
                </div>
            </section>

            <section class="col-md-4">
                <img src="images/example.png" alt="Produto tal">
                <div class="infos">
                    <h2>CONJ. Box Queen Sealy Charleston Resort</h2>
                    <p>Colchão Sealy Charleston, sua estrutura de suporte central é formada por um dos sistemas de molas, mais eficiente do planeta...</p>
                    <p class="old-price">De: R$2.700,00</p>
                    <p class="price">Por: R$1.990,00</p>
                    <small>Em até 12xR$164.90 sem juros no cartão de crédito</small>
                </div>

                <div class="action">
                    <a href="#" role="button" class="btn btn-light">Saiba mais</a>
                    <a href="#" role="button" class="btn" style="background-color: #665132; color:#fff;">+ Carrinho</a>
                </div>
            </section>

            <section class="col-md-4">
                <img src="images/example.png" alt="Produto tal">
                <div class="infos">
                    <h2>CONJ. Box Queen Sealy Charleston Resort</h2>
                    <p>Colchão Sealy Charleston, sua estrutura de suporte central é formada por um dos sistemas de molas, mais eficiente do planeta...</p>
                    <p class="old-price">De: R$2.700,00</p>
                    <p class="price">Por: R$1.990,00</p>
                    <small>Em até 12xR$164.90 sem juros no cartão de crédito</small>
                </div>

                <div class="action">
                    <a href="#" role="button" class="btn btn-light">Saiba mais</a>
                    <a href="#" role="button" class="btn" style="background-color: #665132; color:#fff;">+ Carrinho</a>
                </div>

                <div class="free-shipping position-absolute top-0 rounded-pill w-75" role="alert" style="background: #3D8DCB; color:#fff;">
                    Frete grátis Rib. Preto - SP
                </div>
            </section>
        </div>
    </div>
</div>
@endsection