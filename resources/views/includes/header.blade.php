<div class="header">
    <header class="header__site-header">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h1 class="header__logo">
                        <a href="{{ url('/') }}">
                            <img src="{{ asset('images/logo2.png') }}" alt="logo">
                        </a>
                    </h1>
                </div>
                <div class="col-md-6 header__right">
                    <div class="header__auth-links">
                        @if(Route::has('login'))
                            @auth
                                <span class="header__profile">
                                    Hello, {{$you->name}}
                                    <ul class="header__profile-list">
                                        <li class="header__profile-item">
                                            <a href="{{ url('/profile') }}">
                                                <i class="far fa-user"></i>
                                                <span class="header__text--spacer"></span>
                                                Profile
                                            </a>
                                        </li>
                                        <li class="header__profile-item">
                                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                <i class="fas fa-sign-out-alt"></i>
                                                <span class="header__text--spacer"></span>
                                                Logout
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" hidden>@csrf</form>
                                        </li>
                                        @can(['is-admin'])
                                        <hr class="small-hr">
                                        <li class="header__profile-item">
                                            <a href="{{ route('admin.users.index') }}">
                                                <i class="fas fa-users"></i>
                                                <span class="header__text--spacer"></span>
                                                User management
                                            </a>
                                        </li>
                                        @endcan
                                    </ul>
                                </span>
                            @else
                                <a href="{{ route('login') }}" class="header__links">Sign in</a>
                                @if(Route::has('register'))
                                    <span class="header__text--spacer">or</span>
                                    <a href="{{ route('register') }}" class="header__links">Create an Account</a>
                                @endif
                            @endauth
                        @endif
                    </div>
                    <div class="header-with-search">
                        <form action="/search" method="get" class="header__search-bar" role="search">
                            <input type="hidden" name="type" value="product">
                            
                            <input type="text" class="header__search-input" name="q" value="" placeholder="Search all products..." aria-label="Search all products...">
                            <button type="submit" class="header__search-bar-submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>

                        <a href="/cart" class="header__cart-btn header-btn">
                            <i class="fas fa-shopping-cart"></i>
                            Cart 
                            <span class="header__cart-count">0</span>
                        </a>

                        <a href="/votes" class="header__votes-btn header-btn">
                            <i class="fas fa-heart"></i>
                            Votes
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <nav class="header__navbar">
        <div class="container header__navbar-wrapper">
            <ul class="header__nav-list">
                <li class="header__nav-item">
                    <a href="#" class="header__nav-link">Cameras</a>
                </li>
                <li class="header__nav-item header__nav-item--active">
                    <a href="#" class="header__nav-link">Cases</a>
                </li>
                <li class="header__nav-item">
                    <a href="#" class="header__nav-link">Video</a>
                </li>
                <li class="header__nav-item">
                    <a href="#" class="header__nav-link">Accessories</a>
                </li>
            </ul>
        </div>
    </nav>
</div>