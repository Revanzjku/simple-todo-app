<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recycle Bin</title>
</head>
<body>
    <h1>Recycle Bin</h1>
    <a href="{{ route('tasks.index') }}">Kembali</a>
    <table border="1">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
            <tr>
                <td>{{ $task->title }}</td>
                <td>{{ $task->description }}</td>
                <td>
                    <form action="{{ route('tasks.restore', $task->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit">Restore</button>
                    </form>
                    <form action="{{ route('tasks.forceDelete', $task->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Hapus permanen?')">Hapus Permanen</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
