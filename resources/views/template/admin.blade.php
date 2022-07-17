<!DOCTYPE html>
<html>
    @include('template.includes.head', ['title' => 'SBShowcase - Admin'])
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bglight">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">SBShowcase</a>
            </div>
        </nav>
        
        <div class="container-lg">
            <div class="row">
                @yield('page')
            </div>
        </div>
    </body>
</html>