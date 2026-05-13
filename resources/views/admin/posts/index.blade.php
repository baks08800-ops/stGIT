@extends('admin.layouts.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Статьи</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Главная</a></li>
                            <li class="breadcrumb-item active">Статьи</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Список статей</h3>
                            </div>
                            <div class="card-body">
                                <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">
                                    <i class="fas fa-plus"></i> Добавить статью
                                </a>

                                @if($posts->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th style="width: 50px">ID</th>
                                                    <th>Наименование</th>
                                                    <th>Категория</th>
                                                    <th>Теги</th>
                                                    <th>Дата</th>
                                                    <th style="width: 100px">Действия</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($posts as $post)
                                                    <tr>
                                                        <td>{{ $post->id }}</td>
                                                        <td>{{ $post->title }}</td>
                                                        <td>{{ $post->category->title }}</td>
                                                        <td>{{ $post->tags->pluck('title')->join(', ') }}</td>
                                                        <td>{{ $post->created_at }}</td>
                                                        <td>
                                                            
                                                            <a href="{{ route('posts.edit', $post->id) }}"
                                                                class="btn btn-info btn-sm float-left mr-1">
                                                                <i class="fas fa-pencil-alt"></i>
                                                            </a>
                                                            <form action="{{ route('posts.destroy', [ 'post'=>$post->id]) }}"
                                                                    method="post"
                                                                    class="float-left">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Подтвердите удаление.')">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </button>
                                                            </form>
                                                            
                                                         </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="alert alert-info">
                                        <i class="fas fa-info-circle"></i> Статей пока нет...
                                    </div>
                                @endif
                            </div>
                            @if($posts->hasPages())
                                <div class="card-footer clearfix">
                                    {{ $posts->links() }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection