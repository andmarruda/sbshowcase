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
                'secBg'      => '#C9E8FF',
                'secColor'   => '#000',
                'brandImage' => 'images/logo.png',
                'brandAlt'   => 'Biosono'
            ])

            @include('template.includes.header-bottom', [
                'priBg'      => '#3D8DCB',
                'menu'       => [
                    ['Cama Box', 'rota', 'parametros'],
                    ['Colchão', 'rota', 'parametros'],
                    ['Conjunto', 'rota', 'parametros'],
                    ['Estofados', 'rota', 'parametros'],
                    ['Acessórios', 'rota', 'parametros']
                ]
            ])
        </header>
    </body>
</html>