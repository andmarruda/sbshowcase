<!DOCTYPE html>
<html>
    <head>
        @include('template.includes.head')
    </head>
    <body>
        <header>
            @include('template.includes.header')
        </header>
        
        @yield('page')

        <footer>
            @include('template.includes.footer')
        </footer>
        <script src="{{asset('js/bootstrap.bundle.min.js')}}" type="text/javascript">
        <script src="{{asset('js/fontawesome/all.min.js')}}" type="text/javascript">
    </body>
</html>