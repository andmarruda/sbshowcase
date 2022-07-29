<!DOCTYPE html>
<html>
    @include('template.includes.head', ['title' => 'Biosono Colchões'])
    <body>
        <header class="container-lg">
            @include('template.includes.header-top', [
                'phone' => '(16)98133-4003',
                'socialNetworks' => [
                    'Facebook' => [
                        'img' => 'images/facebook.png',
                        'width' => '20px',
                        'height' => '20px',
                        'url' => 'https://facebook.com/biosonocolchoesrp'
                    ],

                    'Instagram' => [
                        'img' => 'images/instagram.png',
                        'width' => '20px',
                        'height' => '20px',
                        'url' => 'https://instagram.com/biosonocolchoesrp'
                    ],

                    'Whatsapp' => [
                        'img' => 'images/icon-zap.png',
                        'width' => '20px',
                        'height' => '20px',
                        'url' => 'javascript: void(0);'
                    ]
                ]
            ])

            @include('template.includes.header-middle', [
                'template'   => $template['templates'],
                'brandImage' => 'images/logo.png',
                'brandAlt'   => 'Biosono'
            ])

            @include('template.includes.header-bottom', [
                'template'   => $template['templates'],
                'menu'       => $template['categories']
            ])
        </header>

        <div class="container-md" style="margin-top: 2rem;">
            @include('template.includes.middle-top', [
                'highlight1' => [
                    'title' => 'Entregamos antes da hora de dormir!',
                    'img' => 'images/icon-entrega.png',
                    'alt' => 'Icone de Entrega'
                ],

                'highlight2' => [
                    'title' => 'Atendimento de qualidade!',
                    'img' => 'images/icon-suporte.png',
                    'alt' => 'Icone de atendimento'
                ],

                'template'   => $template['templates']
            ])
        </div>

        <footer class="container-lg">
            @include('template.includes.footer-infos', [
                'imgPagamento' => 'images/meio-pagamento.png',
                'cnpj' => '10.561.781/0001-47',
                'razaoSocial' => 'Alex Manolito Arteman'
            ])

            @include('template.includes.footer-poweredby')
        </footer>
    </body>
</html>