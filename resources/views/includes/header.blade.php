<nav class="navbar navbar-expand-lg navbar-light navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="#">MercaTodo</a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                @if (Route::has('login'))
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('category.index') }}">{{__('category_nav')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('products.index') }}">{{__('product_nav')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('product.shoppingCart') }}">{{__('shopping_nav')}}
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                <span class="badge">{{ Session::has('cart') ? Session::get('cart')->totalQty : '' }}</span>
                            </a>
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
            </ul>
        </div>
    </div>
</nav>
