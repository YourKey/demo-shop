<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('partials.head')
<body class="min-h-screen">
<div id="app">
    @include('partials.header', ['without_sidebar' => true])
        <div class="container mx-auto pt-6 px-6">
            @yield('content')
            @include('partials.footer')
        </div>
    </div>
</div>
</body>
<script src="{{ asset('js/app.js') }}"></script>
</html>
