<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recycle Bin</title>
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

        <h1 class="text-center mb-4">Recycle Bin</h1>
        <a href="{{ route('tasks.index') }}" class="btn btn-primary mb-3">Kembali ke Daftar Tugas</a>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card task-card">
            <div class="card-header bg-primary text-white">
                Daftar Tugas yang Dihapus
            </div>
            <div class="card-body">
                <table class="table task-table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Tugas</th>
                            <th scope="col">Deskripsi</th>
                            <th scope="col">Dihapus Pada</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $task->title }}</td>
                            <td>{{ $task->description }}</td>
                            <td>{{ $task->deleted_at->timezone('Asia/Jakarta')->format('d M Y H:i:s') }}</td>
                            <td>
                                <div class="btn-group">
                                    <form action="{{ route('tasks.restore', $task->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">Pulihkan</button>
                                    </form>
                                    <form action="{{ route('tasks.forceDelete', $task->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus permanen?')">Hapus Permanen</button>
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