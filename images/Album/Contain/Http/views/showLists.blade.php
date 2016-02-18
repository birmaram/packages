<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Images are as follows</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

</head>
<body>
<div>
<h1 class="well well-lg">All Image List</h1>
@foreach( $images as $image )
    <div class="table table-bordered bg-success"><a href="{!! '/images/'.$image->filePath !!}">{{$image->filePath}}</a></div>
@endforeach
</div>
<div>
    <button class='btn btn-danger btn-xs' onclick='image.add.user'>Un-Block</button>
</div>
</body>
</html>
