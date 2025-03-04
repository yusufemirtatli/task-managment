<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Managment</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Task Managment</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item me-3" style="color: white;">
                    {{\Illuminate\Support\Facades\Auth::user()->name}}
                </li>
                <li class="nav-item">
                    <a href="#" style="color: white; text-decoration: none" onclick="document.getElementById('logout-form').submit();">Çıkış Yap</a>
                    <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h4>{{ isset($task) ? 'Edit Task' : 'Add Task' }}</h4>
        </div>
        <div class="card-body">
            <form action="{{ isset($task) ? route('tasks-update', $task->id) : route('tasks-store') }}" method="POST">
                @csrf
                @if(isset($task))
                    @method('PUT')
                @endif

                <div class="form-group">
                    <label for="title">Task Title</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="Title" value="{{ old('title', $task->name ?? '') }}">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" name="description" id="description" placeholder="Description" value="{{ old('description', $task->desc ?? '') }}">
                </div>
                <button type="submit" class="btn btn-primary mt-2">{{ isset($task) ? 'Update' : 'Ekle' }}</button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
