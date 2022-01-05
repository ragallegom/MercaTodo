<!DOCTYPE html>
<!------ Include the above in your HEAD tag ---------->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <link rel="icon" href="Favicon.png">

    <title>Laravel</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="#">MercaTodo</a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('category.index') }}">{{__('category_nav')}}</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{__('login')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{__('register')}}</a>
                            </li>
                        @endauth
                    @endif
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <span class="caret">{{__('language')}}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="lang/en"><img width="25px"> {{__('language_en')}}</a>
                        <a class="dropdown-item" href="lang/es"><img width="25px"> {{__('language_es')}}</a>
                    </div>
                </li>
                <li>
                    <div class="nav-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button>Logout</button>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

<main class="login-form">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{__('login')}}</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{__('name')}}</th>
                                <th scope="col">{{__('email')}}</th>
                                <th scope="col">{{__('disable')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($users as $user)
                                <tbody>
                                <tr>
                                    <th scope="row">{{ $user->id }}</th>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>NO</td>
                                </tr>
                                </tbody>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
