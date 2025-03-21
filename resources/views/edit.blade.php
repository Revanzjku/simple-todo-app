<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tugas</title>
</head>
<body>
    <h1>Edit Tugas</h1>

    {{-- Tampilkan error validasi --}}
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tasks.update', $task) }}" method="post">
        @csrf 
        @method('PUT')

        <label>Judul:</label>
        <input type="text" name="title" value="{{ old('title', $task->title) }}" required>

        <label>Deskripsi:</label>
        <textarea name="description">{{ old('description', $task->description) }}</textarea>

        <label>
            <input type="hidden" name="status" value="0">
            <input type="checkbox" name="status" value="1" {{ $task->status ? 'checked' : '' }}> {{ $task->status_text }}
        </label>

        <button type="submit">Update</button>
    </form>
</body>
</html>
