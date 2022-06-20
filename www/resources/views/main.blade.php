<!DOCTYPE html>
<html lang="en">

  <head>

    @include('partials._head')

  </head>

  <body>

    @yield('content')

    @include('partials._scripts')
    
  </body>
</html>

<script>
  var APP_PREFIX = '{{ env('APP_PREFIX') }}';
</script>
