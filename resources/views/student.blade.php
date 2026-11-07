<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    {{-- <h1>Student List</h1>
    <ul>
        @foreach ($students as $student )
            <li>{{$student}}</li>
        @endforeach
    </ul> --}}
    <h1>Student Profile</h1>
    <p><strong>Name : </strong>{{$student['name']}}</p>
    <p><strong>Age : </strong>{{$student['age']}}</p>
    <p><strong>City : </strong>{{$student['city']}}</p>


</body>
</html>
