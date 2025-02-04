<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
    <p> home page {{ $name }}</p>

    @foreach ($pets as $pet)
        <p> 
            {{ $pet }}
        </p>
    @endforeach
    <p> {{ date("Y") }}</p>

{{-- 
    The view is not responsible for making top level decisions and not responsible for querying data 
    The view is suppose to be very simple do not want to do something very complex 
--}}

</body>
</html>