<!-- Sidebar -->
<div id="sidebar">
    
    <section class="box">
        <header>
            <h2>Популярные статьи</h2>
        </header>
        
        @if(isset($popularPosts) && $popularPosts->count())
            <ul class="style2">
                @foreach($popularPosts as $post)
                <li>
                    <article class="box post-excerpt">
                        @if($post->thumbnail)
                            <a href="{{ route('posts.show', $post->slug) }}" class="image left">
                                <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }}" style="width: 60px; height: 60px; object-fit: cover;">
                            </a>
                        @endif
                        <h3><a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a></h3>
                        <p>{{ Str::limit($post->description, 80) }}</p>
                        <small><i class="fa fa-eye"></i> {{ $post->views }} просмотров</small>
                    </article>
                </li>
                @endforeach
            </ul>
        @else
            <p>Нет популярных статей</p>
        @endif
    </section>

    <section class="box">
        <header>
            <h2>Категории</h2>
        </header>
        
        @if(isset($popularCategories) && $popularCategories->count())
            <ul class="style3">
                @foreach($popularCategories as $category)
                <li>
                    <a href="{{ route('categories.single', $category->slug) }}">
                        {{ $category->title }}
                        <span class="badge" style="float: right; background: #f1c40f; padding: 2px 8px; border-radius: 20px;">
                            {{ $category->posts_count }}
                        </span>
                    </a>
                </li>
                @endforeach
            </ul>
        @else
            <p>Нет категорий</p>
        @endif
    </section>

    <section class="box">
        <header>
            <h2>Подпишитесь</h2>
        </header>
        <p>Будьте в курсе новых статей. Подпишитесь на обновления!</p>
        <a href="#" class="button style1">Подписаться</a>
    </section>

</div>