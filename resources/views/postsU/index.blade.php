<!DOCTYPE HTML>
<!--
	Escape Velocity by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Мой блог на Laravel</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="{{ asset('assets/asset/css/main.css') }}" />
	</head>
	<body class="homepage is-preload">
		<div id="page-wrapper">

			<!-- Header -->
				<section id="header" class="wrapper">

					<!-- Logo -->
						<div id="logo">
							<h1><a href="{{ route('home') }}">Мой блог</a></h1>
							<p>Добро пожаловать в мой блог на Laravel</p>
						</div>

					<!-- Nav -->
						<nav id="nav">
							<ul>
								<li class="current"><a href="{{ route('home') }}">Главная</a></li>
								<li>
									<a href="#">Рубрики</a>
									<ul>
										<li><a href="#">Laravel</a></li>
										<li><a href="#">PHP</a></li>
										<li><a href="#">JavaScript</a></li>
										<li>
											<a href="#">Базы данных</a>
											<ul>
												<li><a href="#">MySQL</a></li>
												<li><a href="#">PostgreSQL</a></li>
												<li><a href="#">MongoDB</a></li>
											</ul>
										</li>
										<li><a href="#">Советы</a></li>
									</ul>
								</li>
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

			<!-- Intro -->
				<section id="intro" class="wrapper style1">
					<div class="title">Добро пожаловать</div>
					<div class="container">
						<p class="style1">Добро пожаловать в мой блог о веб-разработке!</p>
						<p class="style2">
							Здесь я делюсь своими знаниями<br class="mobile-hide" />
							и опытом в <a href="#" class="nobr">Laravel, PHP и современных технологиях</a>
						</p>
						<p class="style3">Этот блог создан на <strong>Laravel</strong> с использованием адаптивного шаблона <strong>Escape Velocity</strong>. Здесь вы найдёте полезные статьи, примеры кода и советы по веб-разработке.</p>
						<ul class="actions">
							<li><a href="#main" class="button style3 large">Читать статьи</a></li>
						</ul>
					</div>
				</section>

			<!-- Main -->
				<section id="main" class="wrapper style2">
					<div class="title">Последние статьи</div>
					<div class="container">

						<!-- Image -->
							<a href="#" class="image featured">
								<img src="{{ asset('/assets/images/pic01.jpg') }}" alt="Баннер блога" />
							</a>

						<!-- Features - Динамические посты из скрина -->
							<section id="features">
								<header class="style1">
									<h2>Свежие публикации</h2>
									<p>Интересные статьи о веб-разработке и программировании</p>
								</header>
								
								<div class="feature-list">
									<div class="row">
										@foreach($posts as $post)
										<div class="col-6 col-12-medium">
											<div class="blog-box wow fadeIn">
												<div class="post-media">
													<a href="{{ route('posts.single', ['slug' => $post->slug]) }}" title="">
														<img src="{{ $post->thumbnail }}" alt="" class="img-fluid">
														<div class="hovereffect">
															<span></span>
														</div>
														<!-- end hover -->
													</a>
												</div>
												<!-- end media -->
												<div class="blog-meta big-meta text-center">
													<div class="post-sharing"><!-- end post-sharing --></div>
													<h4><a href="{{ route('posts.single', ['slug' => $post->slug]) }}" title="">{{ $post->title }}</a></h4>
													{!! $post->description !!}
													<small><a href="{{ route('posts.single', ['slug' => $post->category->slug]) }}" title="">{{ $post->category->title }}</a></small>
													<small>{{ $post->created_at->format('d.m.Y') }}</small>
													<small><i class="fa fa-eye"></i> {{ $post->views }}</small>
												</div>
												<!-- end meta -->
											</div>
											<!-- end blog-box -->
											<hr class="invis">
										</div>
										@endforeach
									</div>
								</div>
								
								<ul class="actions special">
									<li><a href="#" class="button style1 large">Все статьи</a></li>
									<li><a href="#" class="button style2 large">Подписаться</a></li>
								</ul>
							</section>

					</div>
				</section>

			<!-- Highlights -->
				<section id="highlights" class="wrapper style3">
					<div class="title">Популярные статьи</div>
					<div class="container">
						<div class="row aln-center">
							<div class="col-4 col-12-medium">
								<section class="highlight">
									<a href="#" class="image featured"><img src="{{ asset('/assets/images/pic02.jpg') }}" alt="" /></a>
									<h3><a href="#">10 советов для начинающих в Laravel</a></h3>
									<p>Полезные советы, которые помогут вам быстрее освоить Laravel и избежать типичных ошибок.</p>
									<ul class="actions">
										<li><a href="#" class="button style1">Читать</a></li>
									</ul>
								</section>
							</div>
							<div class="col-4 col-12-medium">
								<section class="highlight">
									<a href="#" class="image featured"><img src="{{ asset('/assets/images/pic03.jpg') }}" alt="" /></a>
									<h3><a href="#">Оптимизация запросов в Eloquent</a></h3>
									<p>Как ускорить работу вашего приложения с помощью оптимизации запросов к базе данных.</p>
									<ul class="actions">
										<li><a href="#" class="button style1">Читать</a></li>
									</ul>
								</section>
							</div>
							<div class="col-4 col-12-medium">
								<section class="highlight">
									<a href="#" class="image featured"><img src="{{ asset('/assets/images/pic04.jpg') }}" alt="" /></a>
									<h3><a href="#">Blade: мощный шаблонизатор Laravel</a></h3>
									<p>Изучите все возможности Blade для создания красивых и динамичных представлений.</p>
									<ul class="actions">
										<li><a href="#" class="button style1">Читать</a></li>
									</ul>
								</section>
							</div>
						</div>
					</div>
				</section>

			<!-- Footer -->
				<section id="footer" class="wrapper">
					<div class="title">Свяжитесь со мной</div>
					<div class="container">
						<header class="style1">
							<h2>Остались вопросы?</h2>
							<p>
								Если у вас есть вопросы, предложения или вы хотите сотрудничать,<br />
								напишите мне через форму ниже.
							</p>
						</header>
						<div class="row">
							<div class="col-6 col-12-medium">

								<!-- Contact Form -->
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

								<!-- Contact -->
									<section class="feature-list small">
										<div class="row">
											<div class="col-6 col-12-small">
												<section>
													<h3 class="icon solid fa-home">Адрес</h3>
													<p>
														Мой блог<br />
														1234 Примерная ул.<br />
														Москва, Россия
													</p>
												</section>
											</div>
											<div class="col-6 col-12-small">
												<section>
													<h3 class="icon solid fa-comment">Соцсети</h3>
													<p>
														<a href="#">@myblog</a><br />
														<a href="#">linkedin.com/in/myblog</a><br />
														<a href="#">facebook.com/myblog</a>
													</p>
												</section>
											</div>
											<div class="col-6 col-12-small">
												<section>
													<h3 class="icon solid fa-envelope">Email</h3>
													<p>
														<a href="#">info@myblog.com</a>
													</p>
												</section>
											</div>
											<div class="col-6 col-12-small">
												<section>
													<h3 class="icon solid fa-phone">Телефон</h3>
													<p>
														+7 (999) 123-45-67
													</p>
												</section>
											</div>
										</div>
									</section>

							</div>
						</div>
						<div id="copyright">
							<ul>
								<li>&copy; Мой блог на Laravel.</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
							</ul>
						</div>
					</div>
				</section>

		</div>

		<!-- Scripts -->
			<script src="{{ asset('assets/asset/js/jquery.min.js') }}"></script>
			<script src="{{ asset('assets/asset/js/jquery.dropotron.min.js') }}"></script>
			<script src="{{ asset('assets/asset/js/browser.min.js') }}"></script>
			<script src="{{ asset('assets/asset/js/breakpoints.min.js') }}"></script>
			<script src="{{ asset('assets/asset/js/util.js') }}"></script>
			<script src="{{ asset('assets/asset/js/main.js') }}"></script>

	</body>
</html>