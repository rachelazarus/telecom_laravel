<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Edit Task</h1>
<form action="/edit-task/{{$task->id}}" method="POST">
    @csrf
    @method('PUT')
    
    <input type="text" name="title" value="{{ $task->title }}">
    
    <textarea name="description">{{ $task->description }}</textarea>
    
    <select name="status">
        <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
        <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
    </select>
    
    <input type="date" name="due_date" value="{{ $task->due_date }}">
    
    <button type="submit">Update Task</button>
</form>

</body>
</html>