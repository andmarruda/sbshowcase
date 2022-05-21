<!DOCTYPE html>
<html>
    <head>
        @include('template.includes.head', ['title' => $title])
    </head>
    <body>
        <div class="container-md">
            <header>
                @include('template.includes.header', ['instagram' => $instagram, 'facebook' => $facebook, 'whatsapp' => $whatsapp, 'title' => $title])
            </header>

            @yield('page')

            <footer>
                @include('template.includes.footer')
            </footer>
        </div>
        <script src="{{asset('js/bootstrap.bundle.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('js/fontawesome/all.min.js')}}" type="text/javascript"></script>
    </body>
</html>