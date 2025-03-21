<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi To-Do List</title>
</head>
<body>
    <h1>To-Do List</h1>
    <a href="{{route('tasks.trashed')}}">Tempat Sampah</a>

    @if(session('success'))
        <p style="color: green;">{{session('success')}}</p>
    @endif

    <form action="{{route('tasks.store')}}" method="post">
        @csrf
        <input type="text" name="title" placeholder="Nama tugas" required>
        <textarea name="description" placeholder="Deskripsi"></textarea>
        <button type="submit">Tambah</button>
    </form>

    <ul>
        @foreach ($tasks as $task)
            <li>
                <strong>{{ $task->title }}</strong> - {{ $task->status_text }} <br>
                {{ $task->description }} <br>
                <a href="{{ route('tasks.edit', $task->id) }}">Edit</a>
                <form action="{{ route('tasks.delete', $task->id) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button type="submit" onclick="return confirm('Hapus tugas ini?')">Hapus</button>
                </form>
            </li>
        @endforeach
    </ul>
</body>
</html>
