<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Details</title>
</head>
<body>
    <div style="border: 3px solid black; padding: 20px;">
        <h2>Task Details</h2>
        
        <div style="background-color: gray; padding: 15px; margin: 10px;">
            <h3>{{ $task->title }} by {{ $task->user->name }}</h3>
            <p><strong>Description:</strong> {{ $task->description ?? 'No description provided' }}</p>
            <p><strong>Status:</strong> {{ ucfirst(str_replace('_', ' ', $task->status)) }}</p>
            <p><strong>Due Date:</strong> {{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('F d, Y') : 'No due date' }}</p>
            <p><strong>Created At:</strong> {{ $task->created_at->format('F d, Y H:i A') }}</p>
            <p><strong>Last Updated:</strong> {{ $task->updated_at->format('F d, Y H:i A') }}</p>

            <p><a href="/edit-task/{{ $task->id }}">Edit</a></p>
            <form action="/delete-task/{{ $task->id }}" method="POST">
                @csrf
                @method('DELETE')
                <button>DELETE</button>
            </form>
        </div>
    </div>
</body>
</html>
