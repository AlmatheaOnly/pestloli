<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $meta_description }}">
    <meta name="author" content="{{ $author }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }}</title>

    {{-- Styles --}}
    <link href="{{ asset('css/blog.css') }}" rel="stylesheet">
    @yield('styles')
</head>
<body id="app">
@include('blog.partials.nav')

@yield('page-header')

@yield('content')

@include('blog.partials.footer')

{{-- Scripts --}}
<script src="{{ asset('js/blog.js') }}"></script>
@yield('scripts')
</body>
</html>