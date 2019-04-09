<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- favicon icon -->

    <title>Руккола</title>

    <!-- common css -->
    <link rel="stylesheet" href="{{ asset('css/front.css') }}">
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">

    <!-- HTML5 shim and Respond.js IE9 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="assets/js/html5shiv.js"></script>
    <script src="assets/js/respond.js"></script>


    <![endif]-->

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/images/favicon.ico">
    <script src="{{ asset('js/front.js' )}}"></script>
</head>

<body>

<nav class="navbar main-menu navbar-default">
    <div class="container">
        <div class="menu-content">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <a class="navbar-brand" href="\"><img src="/images/logo_rukola.png" alt=""></a>
            </div>


            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                <ul class="nav navbar-nav text-uppercase">
                    @auth()
                    @if(Auth::user()->is_admin == 1)
                        <li><a href="/admin">Личный кабинет</a></li>
                    @endif
                        <li><a href="/story">Мои заказы</a></li>
                    @endauth()
                </ul>

                <ul class="nav navbar-nav text-uppercase pull-right">
                    @auth()

                        <li><a href="/cart">Корзина</a></li>
                        <li><a href="/profile">Профиль</a></li>
                        <li><a href="/logout">Выйти</a></li>
                    @endauth()
                    @guest()
                            <li><a href="/register">Регистрация</a></li>
                            <li><a href="/login">Авторизация</a></li>
                        @endguest()





                </ul>

            </div>
            <!-- /.navbar-collapse -->


            <div class="show-search">
                <form role="search" method="get" id="searchform" action="#">
                    <div>
                        <input type="text" placeholder="Search and hit enter..." name="s" id="s">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</nav>


    @yield('content')
<!--footer start-->


<footer class="footer-widget-section">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <aside class="footer-widget">
                    <div class="about-img"><img src="/images/footer_rukola.png" alt=""></div>
                    <div class="address">
                        <h4 class="text-uppercase">Контакты</h4>

                        <p>г. Краматорск, б-р Машиностроителей 30/607</p>

                        <p>Номер телефона: +38 (095) 674 06 10</p>

                        <p>Informationtechnology@google.com</p>
                    </div>
                </aside>
            </div>

            <div class="col-md-4">
                <aside class="footer-widget">
                    <h3 class="widget-title text-uppercase">Instagram</h3>


                    <div class="custom-post">
                        <div>
                            <a href="https://www.instagram.com/rucola_cafe/"><img src="/images/footer-img.png" alt=""></a>
                        </div>

                    </div>
                </aside>
            </div>
            <div class="col-md-4">
                <aside class="footer-widget">
                    <h3 class="widget-title text-uppercase">О нас:</h3>


                    <div class="custom-post">

                        <div>
                            <a href="\" class="text-uppercase">РУККОЛА - это лучшие кулинарные рецепты Италии, настоящая неаполитанская пицца из дровяной печи, стейк-меню, блюда на древесных углях, домашние пасты, салаты, сыры и лучшие сорта вин Тосканы, Венето, Лигурии!

                            </a>

                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
    <div class="footer-copy">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center"><a href="https://it20academy.com/">It 2.0</a> Information Technology <i
                                class="fa fa-heart"></i><a href="#"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- js files -->
<script src="{{ asset('js/front.js' )}}"></script>

</body>
</html>