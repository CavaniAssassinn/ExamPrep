<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    @auth
        <h1>whoop whoop</h1>
        <form action="/logout" method="POST">
            @csrf
            <button>
                logout
            </button>
        </form>
        <div style="border: 3px solid black;">
            <h2>Create a new post</h2>
            <form action="/create-post" method="POST">
                @csrf
                <input type="text" name="title" placeholder="title">
                <textarea name="body" placeholder="Body Content....."></textarea>
                <button>Save Post</button>
            </form>
        </div>
        <div style="border: 3px solid black;">
            <h2>All Posts</h2>
            @foreach ($posts as $post)
                <div style="background-color: gray; padding: 10px; margin:10px">
                    <h3>{{ $post['title'] }} by {{ $post->user->name }} </h3>
                    {{ $post['body'] }}
                    <p><a href="/edit-post/{{ $post->id }}">Edit</a></p>
                    <form action="/delete-post/{{ $post->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button>Delete</button>
                    </form>
                </div>
            @endforeach
        </div>
    @else
        <div style="border: 3px solid black;">

            <h2>Register</h2>

            @if ($errors->any())
                <div style="color: red; margin-bottom: 1em;">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="/register" method="POST">
                @csrf
                <input name="name" type="text" placeholder="Name">
                <input name="email" type="text" placeholder="email">
                <input name="password" type="password" placeholder="Password">
                <button>Register</button>
            </form>
        </div>
        <div style="border: 3px solid black;">

            <h2>Login</h2>

            @if ($errors->any())
                <div style="color: red; margin-bottom: 1em;">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="/login" method="POST">
                @csrf
                <input name="loginname" type="text" placeholder="Name">
                <input name="loginpassword" type="password" placeholder="Password">
                <button>Login</button>
            </form>
        </div>

    @endauth

</body>

</html>
