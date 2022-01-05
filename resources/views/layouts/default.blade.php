<!DOCTYPE html>
<!------ Include the above in your HEAD tag ---------->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<html>
    <head>
        @include('includes.head')
    </head>
    <body>
        <div class="container">
            <header class="row">
                @include('includes.header')
            </header>
            <div class="notification is-primary">
                @yield('content')
            </div>
            <footer class="row">
                @include('includes.footer')
            </footer>
        </div>
    </body>
</html>
