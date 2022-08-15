<!DOCTYPE html>
<html lang="pt-BR">
    @include('template.includes.head', ['title' => 'Biosono Colchões'])
    <body>
        <header class="container-lg">
            @include('template.includes.header-top', [
                'general' => $template['general'],
                'socialNetworks' => $template['SocialMedia']
            ])

            @include('template.includes.header-middle', [
                'template'   => $template['templates'],
                'general' => $template['general'],
                'CartCount' => $template['CartCount']
            ])

            @include('template.includes.header-bottom', [
                'template'   => $template['templates'],
                'menu'       => $template['categories']
            ])
        </header>

        <div class="container-md" style="margin-top: 2rem;">
            @include('template.includes.middle-top', [
                'general' => $template['general'],
                'template'   => $template['templates']
            ])
        </div>

        <main class="container-lg" style="margin-top: 2rem;">
            @yield('page')
        </main>

        <footer class="container-lg">
            @include('template.includes.footer-infos', [
                'PaymentMethod' => $template['PaymentMethod'],
                'general' => $template['general']
            ])

            @include('template.includes.footer-poweredby', ['blog' => $template['general']->blog_url, 'sitemap' => null])
        </footer>

        @include('template.includes.eligible-delivery')

        <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
        @if(\Request::route()->getName()=='customer-register')
        <script src="{{asset('js/sbpublic.js')}}"></script>
        <script src="{{asset('js/vanilla-masker.min.js')}}"></script>
        @endif
    </body>
</html>