@extends('admin.layouts.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Создание тега</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Главная</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('tags.index') }}">Теги</a></li>
                            <li class="breadcrumb-item active">Создание</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Создание тега</h3>
                            </div>
                            <!-- Card body -->
                            <div class="card-body">
                                <form role="form" method="post" action="{{ route('tags.store') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="title">Название</label>
                                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" 
                                               value="{{ old('title') }}" required>
                                        @error('title')
                                            <div class="text-danger">{{ $message }}</div>
                                        @else
                                            <small class="form-text text-muted">Введите название тега</small>
                                        @enderror
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Сохранить</button>
                                        <a href="{{ route('tags.index') }}" class="btn btn-default">Отмена</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection