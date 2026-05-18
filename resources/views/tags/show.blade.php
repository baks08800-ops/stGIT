<!DOCTYPE HTML>
<html>
<head>
    <title>#{{ $tag->title }} - Тег | Мой блог</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="{{ asset('assets/asset/css/main.css') }}" />
</head>
<body class="homepage is-preload">
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

    <section id="main" class="wrapper style2">
        <div class="title">Тег: #{{ $tag->title }}</div>
        <div class="container">
            <div class="row gtr-150">
                
                <div class="col-8 col-12-medium imp-medium">
                    <div id="content">
                        
                        <ol class="breadcrumb" style="list-style: none; padding: 0; margin-bottom: 20px;">
                            <li style="display: inline-block;"><a href="{{ route('home') }}">Главная</a> &nbsp;→&nbsp;</li>
                            <li style="display: inline-block; color: #f1c40f;">#{{ $tag->title }}</li>
                        </ol>


                        @if($tag->description)
                            <div class="tag-description" style="background: #f9f9f9; padding: 15px; margin-bottom: 30px; border-left: 4px solid #3498db;">
                                {{ $tag->description }}
                            </div>
                        @endif

                        <div class="feature-list">
                            <div class="row">
                                @forelse($posts as $post)
                                <div class="col-6 col-12-medium">
                                    <section class="blog-box">
                                        <div class="post-media">
                                            <a href="{{ route('posts.show', $post->slug) }}" title="{{ $post->title }}">
                                                @if($post->thumbnail)
                                                    <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }}" class="img-fluid" style="width: 100%; border-radius: 8px;">
                                                @else
                                                    <img src="{{ asset('assets/images/pic01.jpg') }}" alt="{{ $post->title }}" class="img-fluid" style="width: 100%; border-radius: 8px;">
                                                @endif
                                            </a>
                                        </div>
                                        <div class="blog-meta big-meta text-center">
                                            <h3>
                                                <a href="{{ route('posts.show', $post->slug) }}" title="{{ $post->title }}">
                                                    {{ $post->title }}
                                                </a>
                                            </h3>
                                            <p>{{ Str::limit($post->description, 100) }}</p>
                                            <div class="post-meta-info">
                                                <small>
                                                    <a href="{{ route('categories.single', $post->category->slug ?? '#') }}">
                                                        {{ $post->category->title ?? 'Без категории' }}
                                                    </a>
                                                </small>
                                                <small>{{ $post->created_at->format('d.m.Y') }}</small>
                                                <small><i class="fa fa-eye"></i> {{ $post->views }}</small>
                                            </div>
                                            <ul class="actions">
                                                <li><a href="{{ route('posts.show', $post->slug) }}" class="button style1 small">Читать далее</a></li>
                                            </ul>
                                        </div>
                                    </section>
                                </div>
                                @empty
                                <div class="col-12">
                                    <div class="alert alert-info" style="padding: 20px; background: #f4f6f9; text-align: center;">
                                        <p>Нет статей с тегом <strong>#{{ $tag->title }}</strong></p>
                                        <a href="{{ route('home') }}" class="button style1 small">На главную</a>
                                    </div>
                                </div>
                                @endforelse
                            </div>
                        </div>

                        <div class="pagination-wrapper" style="margin-top: 30px; text-align: center;">
                            {{ $posts->links() }}
                        </div>

                    </div>
                </div>

                <div class="col-4 col-12-medium">
                    @include('layouts.sidebar')
                </div>

            </div>
        </div>
    </section>

    <!-- Footer -->
    <section id="footer" class="wrapper">
        <div class="title">Свяжитесь со мной</div>
        <div class="container">
            <div class="row">
                <div class="col-6 col-12-medium">
                    <section>
                        <form method="post" action="#">
                            @csrf
                            <div class="row gtr-50">
                                <div class="col-6 col-12-small">
                                    <input type="text" name="name" id="contact-name" placeholder="Ваше имя" />
                                </div>
                                <div class="col-6 col-12-small">
                                    <input type="text" name="email" id="contact-email" placeholder="Email" />
                                </div>
                                <div class="col-12">
                                    <textarea name="message" id="contact-message" placeholder="Сообщение" rows="4"></textarea>
                                </div>
                                <div class="col-12">
                                    <ul class="actions">
                                        <li><input type="submit" class="style1" value="Отправить" /></li>
                                        <li><input type="reset" class="style2" value="Очистить" /></li>
                                    </ul>
                                </div>
                            </div>
                        </form>
                    </section>
                </div>
                <div class="col-6 col-12-medium">
                    <section class="feature-list small">
                        <div class="row">
                            <div class="col-6 col-12-small">
                                <section>
                                    <h3 class="icon solid fa-home">Адрес</h3>
                                    <p>Мой блог<br />Москва, Россия</p>
                                </section>
                            </div>
                            <div class="col-6 col-12-small">
                                <section>
                                    <h3 class="icon solid fa-envelope">Email</h3>
                                    <p><a href="#">info@myblog.com</a></p>
                                </section>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <div id="copyright">
                <ul>
                    <li>&copy; Мой блог на Laravel.</li>
                    <li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
                </ul>
            </div>
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