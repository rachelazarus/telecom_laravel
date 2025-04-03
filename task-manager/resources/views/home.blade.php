<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    @auth
    <p>Hello, you are logged in.</p>
    <form action="/logout" method="POST">
    @csrf
    <button>Log out</button>
    </form>

    <div style="border: 3px solid black">
        <h2>Create a New Task</h2>
        <form action="/create-task" method="POST">
            @csrf
        
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" placeholder="Enter title" required>
        
            <label for="description">Description:</label>
            <textarea id="description" name="description" placeholder="Enter description..."></textarea>
        
            <label for="status">Status:</label>
            <select id="status" name="status" required>
                <option value="pending">Pending</option>
                <option value="in_progress">In Progress</option>
                <option value="completed">Completed</option>
            </select>
        
            <label for="due_date">Due Date:</label>
            <input type="date" id="due_date" name="due_date">
        
            <button type="submit">Create Task</button>
        </form>
        
    </div>

    <div style="border: 3px solid black">
        <h2>All Tasks</h2>
        @foreach ($tasks as $task )
        <div style="background-color: gray; padding: 10px; margin: 10px; ">
            <h3>{{$task['title']}}</h3>
            {{$task['description']}}
            <p><a href="/edit-task/{{$task->id}}">Edit</a></p>
            <form action="/delete-task/{{$task->id}}" method="POST">
            @csrf
            @method('DELETE')
            <button>DELETE</button>
            </form>
        </div>
        
        @endforeach
    </div>


    @else
    <div style="border: 3px solid black">
        <h2>Register</h2> 
        <form action="/register" method="POST">
         @csrf
         <input name="name" type="text" placeholder="name">
         <input name="email" type="text" placeholder="email">
         <input name="password" type="password" placeholder="password">
         <button>Register</button>
        </form>
    </div>
    <div style="border: 3px solid black">
        <h2>Login</h2> 
        <form action="/login" method="POST">
         @csrf
         <input name="loginname" type="text" placeholder="name">
         <input name="loginpassword" type="password" placeholder="password">
         <button>Login</button>
        </form>
    </div>
    @endauth
    
  
</body>
</html>