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
    <div class="text-end items-end mb-2">
        <button type="button" class="btn btn-primary">
            <a href="{{route('tasks-add')}}" style="text-decoration: none;color: white">
                Add Task
            </a>
        </button>
    </div>
    <div class="card">
        <div class="card-header">
            <h4>Tasks</h4>
        </div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Desc</th>
                <th scope="col">Status</th>
                <th scope="col">User</th>
                <th scope="col">Complate</th>
                <th scope="col">Düzenle</th>
                <th scope="col">Sil</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tasks as $task)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$task->name}}</td>
                    <td>{{$task->desc}}</td>
                    @if($task->status == 0)
                        <td class="text-warning">Devam ediyor..</td>
                    @elseif($task->status == 1)
                        <td class="text-success">Tamamlandı</td>
                    @endif
                    <td>
                        @php($user = \App\Models\User::find($task->user_id))
                        {{$user->name}}
                    </td>
                    <td>
                        <form action="{{ route('tasks-complete', $task->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success">Complate</button>
                        </form>
                    </td>
                    <td>
                        <button class="btn btn-warning">
                            <a style="text-decoration: none;color: white" href="{{route('tasks-edit',$task->id)}}">Düzenle</a>
                        </button>
                    </td>
                    <td>
                        <form action="{{ route('tasks-delete', $task->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
