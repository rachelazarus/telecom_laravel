<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div style="border: 3px solid black;">
        <h2>Create task</h2>
        <form action="/create" method="POST">
            @csrf
            <div>
                <input name="title" type="text" placeholder="Title" required>
            </div>
            <div>
                <textarea name="description" type="text" placeholder="Description..." required></textarea>
            </div>
            <div>
                <select name="status" required>
                    <option value="pending">Pending</option>
                    <option value="in_progress">In Progress</option>
                    <option value="completed">Completed</option>
                </select>
            </div>
            <div>
                <input name="due_date" type="date" placeholder="Due Date" required>
                <button type="submit">Create task</button>
            </div>
           
        </form>
        
    </div>
    <div style="border: 3px solid black">
        <h2>All tasks</h2>
        @foreach ($tasks as $task)
            <div style="background-color: gray; padding: 10px; margin:10px">
                <h3>{{ $task->title }}</h3>
                <p>{{ $task->description }}</p> 
            </div>
            <p><a href="/edit/{{$task->id}}">Edit</a></p>
            <form action="/delete/{{$task->id}}" method="POST">
            @csrf
            @method('DELETE')
            <button>Delete</button>
            </form>
        @endforeach
    </div>
    
</body>
</html>