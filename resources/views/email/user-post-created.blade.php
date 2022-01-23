<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Hi {{ $user->first_name }},</h1>
    <p>Post has been created Successfully</p>
    <p>{{$post->title}}</p>
    <p>{{$post->content}}</p>
    <p>Post created at {{$post->created_at}}</p>
</body>

</html>