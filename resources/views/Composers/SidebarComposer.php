<?php

namespace App\View\Composers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\View\View;

class SidebarComposer
{
    /**
     * Привязать данные к шаблону.
     */
    public function compose(View $view)
    {
        // 1. Популярные посты (по просмотрам, топ 5)
        $popularPosts = Post::with('category')
            ->orderBy('views', 'desc')
            ->limit(5)
            ->get();

        // 2. Популярные категории (с количеством постов)
        // Используем withCount для подсчёта постов в категории
        $popularCategories = Category::withCount('posts')
            ->having('posts_count', '>', 0)
            ->orderBy('posts_count', 'desc')
            ->limit(10)
            ->get();

        // Передаём данные в шаблон
        $view->with('popularPosts', $popularPosts)
             ->with('popularCategories', $popularCategories);
    }
}