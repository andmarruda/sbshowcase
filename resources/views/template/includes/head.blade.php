<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title}}</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/sbshowcase.css')}}">
    @if(\Request::route()->getName()=='product')
    <link rel="stylesheet" href="{{asset('css/quill.snow.css')}}">
    <link rel="stylesheet" href="{{asset('css/monokai-sublime.min.css')}}">
    @endif
</head>