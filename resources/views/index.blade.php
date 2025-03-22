<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .task-card {
            margin-bottom: 20px;
        }
        .task-table {
            margin-top: 20px;
        }
        .task-table th, .task-table td {
            vertical-align: middle;
        }
        .task-table .btn-group {
            display: flex;
            gap: 5px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">

        <h1 class="text-center mb-4">Todo App</h1>

        <a href="{{ route('tasks.recycleBin') }}" class="btn btn-secondary mb-3">Recycle Bin</a>    

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card task-card">
            <div class="card-header bg-primary text-white">
                Tambah Tugas Baru
            </div>
            <div class="card-body">
                <form action="{{ route('tasks.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="task" class="form-label">Nama Tugas</label>
                        <input type="text" class="form-control" id="task" name="title" placeholder="Masukkan nama tugas">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi Tugas</label>
                        <textarea class="form-control" id="description" name="description" rows="3" placeholder="Masukkan deskripsi tugas"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah Tugas</button>
                </form>
            </div>
        </div>

        <div class="card task-card">
            <div class="card-header bg-primary text-white">
                Daftar Tugas
            </div>
            <div class="card-body">
                <table class="table task-table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Tugas</th>
                            <th scope="col">Deskripsi</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $task->title }}</td>
                            <td>{{ $task->description }}</td>
                            <td>
                                @if ($task->status)
                                    <span class="badge bg-success">Selesai</span>
                                @else
                                    <span class="badge bg-warning">Belum Selesai</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <form action="{{ route('tasks.update', $task->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-sm {{ $task->status ? 'btn-warning' : 'btn-success' }}">
                                            {{ $task->is_completed ? 'Belum Selesai' : 'Selesai' }}
                                        </button>
                                    </form>
                                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Ingin menghapus?')">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>