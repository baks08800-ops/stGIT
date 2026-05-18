<!DOCTYPE HTML>
<html>
<head>
    <title>{{ $post->title }} - Мой блог на Laravel</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="{{ asset('assets/asset/css/main.css') }}" />
</head>
<body class="left-sidebar is-preload">
<div id="page-wrapper">

    
    <section id="header" class="wrapper">
        <div id="logo">
            <h1><a href="{{ route('home') }}">Мой блог</a></h1>
            <p>Добро пожаловать в мой блог на Laravel</p>
        </div>
        <nav id="nav">
            <ul>
                <li><a href="{{ route('home') }}">Главная</a></li>
                <li><a href="#">О блоге</a></li>
                <li><a href="#">Контакты</a></li>
                @auth
                    <li><a href="{{ route('admin.index') }}">Админ-панель</a></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" style="background: none; border: none; color: #fff; cursor: pointer;">Выйти</button>
                        </form>
                    </li>
                @else
                    <li><a href="{{ route('login.create') }}">Войти</a></li>
                    <li><a href="{{ route('register.create') }}">Регистрация</a></li>
                @endauth
            </ul>
        </nav>
    </section>

    <!-- Main -->
    <section id="main" class="wrapper style2">
        <div class="title">{{ $post->title }}</div>
        <div class="container">
            <div class="row gtr-150">
                <div class="col-4 col-12-medium">
                    <!-- Sidebar -->
                    <div id="sidebar">
                        <section class="box">
                            <header>
                                <h2>О статье</h2>
                            </header>
                            <ul class="style3">
                                <li><strong>Категория:</strong> {{ $post->category->title ?? 'Без категории' }}</li>
                                <li><strong>Дата:</strong> {{ $post->created_at->format('d.m.Y') }}</li>
                                <li><strong>Просмотров:</strong> {{ $post->views }}</li>
                            </ul>
                            <a href="{{ route('home') }}" class="button style1">← На главную</a>
                        </section>
                    </div>
                </div>

                <div class="col-8 col-12-medium imp-medium">
                    <!-- Content -->
                    <div id="content">
                        <article class="box post">
                            <header class="style1">
                                <h2>{{ $post->title }}</h2>
                                <div class="blog-meta big-meta">
                                    <small>{{ $post->created_at->format('d.m.Y') }}</small>
                                    <small><i class="fa fa-eye"></i> {{ $post->views }}</small>
                                </div>
                            </header>

                            <!-- === ВСТАВЛЕННЫЙ БЛОК С ИЗОБРАЖЕНИЕМ, КОНТЕНТОМ И ТЕГАМИ === -->
                            
                            <!-- Изображение статьи -->
                            <div class="single-post-media">
                                @if($post->thumbnail)
                                    <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }}" class="img-fluid">
                                @else
                                    <img src="{{ asset('assets/images/pic01.jpg') }}" alt="{{ $post->title }}" class="img-fluid">
                                @endif
                            </div><!-- end media -->

                            <!-- Контент статьи -->
                            <div class="blog-content">
                                {!! $post->content !!}
                            </div><!-- end content -->

                            <div class="blog-title-area">
                                <!-- Теги -->
                                @if(isset($post->tags) && $post->tags->count())
                                <div class="tag-cloud-single">
                                    <span>Теги:</span>
                                    @foreach($post->tags as $tag)
                                        <small>
                                            <a href="{{ route('tags.single', ['slug' => $tag->slug]) }}" title="">
                                                {{ $tag->title }}
                                            </a>
                                        </small>
                                    @endforeach
                                </div>
                                @endif

                                <!-- Кнопки шаринга -->
                                <div class="post-sharing">
                                    <ul class="list-inline">
                                        <li>
                                            <a href="#" class="fb-button btn btn-primary">
                                                <i class="fa fa-facebook"></i>
                                                <span class="down-mobile">Share on Facebook</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="tw-button btn btn-primary">
                                                <i class="fa fa-twitter"></i>
                                                <span class="down-mobile">Tweet on Twitter</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div><!-- end title-area -->
                            
                            <!-- === КОНЕЦ ВСТАВЛЕННОГО БЛОКА === -->
                            
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <section id="footer" class="wrapper">
        <div class="title">Свяжитесь со мной</div>
        <div class="container">
            <!-- ... ваш footer ... -->
        </div>
    </section>

</div>

<script src="{{ asset('assets/asset/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/asset/js/jquery.dropotron.min.js') }}"></script>
<script src="{{ asset('assets/asset/js/browser.min.js') }}"></script>
<script src="{{ asset('assets/asset/js/breakpoints.min.js') }}"></script>
<script src="{{ asset('assets/asset/js/util.js') }}"></script>
<script src="{{ asset('assets/asset/js/main.js') }}"></script>
</body>
</html>