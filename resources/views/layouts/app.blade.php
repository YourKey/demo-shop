<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('partials.head')
<body class="min-h-screen">
<div id="app">
    @include('partials.header')
    <div class="drawer drawer-mobile">
        <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content container mx-auto pt-6 px-6">
            @yield('content')
            @include('partials.footer')
        </div>
        @include('partials.sidebar')
    </div>
</div>
</body>
<script src="{{ asset('js/app.js') }}"></script>
</html>
