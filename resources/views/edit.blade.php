<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tugas</title>
</head>
<body>
    <h1>Edit Tugas</h1>

    <form action="{{route('tasks.update', $task)}}" method="post">
        @csrf 
        @method('PUT')
        <input type="text" name="title" value="{{$task->title}}" required>
        <textarea name="description">{{ $task->description }}</textarea>
        <label>
            <input type="checkbox" name="status" {{ $task->status ? 'checked' : '' }}> Selesai
        </label>
        <button type="submit">Update</button>
    </form>
</body>
</html>
