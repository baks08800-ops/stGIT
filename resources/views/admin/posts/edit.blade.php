@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Редактирование статьи</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Главная</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('posts.index') }}">Статьи</a></li>
                        <li class="breadcrumb-item active">Редактирование</li>
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
                            <h3 class="card-title">Статья: {{ $post->title }}</h3>
                        </div>
                        <!-- /.card-header -->

                        <form role="form" method="post" action="{{ route('posts.update', ['post' => $post->id]) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Название</label>
                                    <input type="text" 
                                           name="title" 
                                           class="form-control @error('title') is-invalid @enderror" 
                                           id="title" 
                                           value="{{ old('title', $post->title) }}">
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="description">Цитата</label>
                                    <textarea name="description" 
                                              class="form-control @error('description') is-invalid @enderror" 
                                              id="description" 
                                              rows="3">{{ old('description', $post->description) }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="content">Контент</label>
                                    <textarea name="content" 
                                              class="form-control @error('content') is-invalid @enderror" 
                                              id="content" 
                                              rows="10">{{ old('content', $post->content) }}</textarea>
                                    @error('content')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="category_id">Категория</label>
                                    <select class="form-control @error('category_id') is-invalid @enderror" 
                                            id="category_id" 
                                            name="category_id">
                                        <option value="">Выберите категорию</option>
                                        @foreach($categories as $k => $v)
                                            <option value="{{ $k }}" {{ old('category_id', $post->category_id) == $k ? 'selected' : '' }}>
                                                {{ $v }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="tags">Теги</label>
                                    <select name="tags[]" 
                                            id="tags" 
                                            class="select2" 
                                            multiple="multiple" 
                                            data-placeholder="Выбор тегов" 
                                            style="width: 100%;">
                                        @foreach($tags as $k => $v)
                                            <option value="{{ $k }}" {{ in_array($k, old('tags', $post->tags->pluck('id')->toArray())) ? 'selected' : '' }}>
                                                {{ $v }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="thumbnail">Изображение</label>
                                    <div class="custom-file">
                                        <input type="file" 
                                               name="thumbnail" 
                                               class="custom-file-input @error('thumbnail') is-invalid @enderror" 
                                               id="thumbnail">
                                        <label class="custom-file-label" for="thumbnail">Выберите файл</label>
                                    </div>
                                    @if($post->thumbnail)
                                        <div class="mt-2">
                                            <img src="{{ asset('storage/' . $post->thumbnail) }}" 
                                                 alt="" 
                                                 class="img-thumbnail" 
                                                 width="200">
                                        </div>
                                    @endif
                                    @error('thumbnail')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                                <a href="{{ route('posts.index') }}" class="btn btn-default float-right">Отмена</a>
                            </div>
                            <!-- /.card-footer -->
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('.select2').select2({
            theme: 'bootstrap4',
            placeholder: 'Выберите теги',
            allowClear: true
        });

        // Показываем имя файла для custom-file-input
        $('.custom-file-input').on('change', function() {
            var fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    });
</script>
@endpush