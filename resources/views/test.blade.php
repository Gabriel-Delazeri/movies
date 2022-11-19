<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Movies</title>
</head>
<style>
    img {
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 5px;
        width: 150px;
        text-align: center;
    }
</style>
<body>
<div class="container">
    <div class="row">
        @foreach($movies as $movie)
            <div class="col-md-4 mt-4">
                <div class="card h-100">
                    @if(Storage::disk('s3')->get($movie['poster_path']))
                    <img src="{{ \App\Utility\Base64Encoder::encodeImage(Storage::disk('s3')->get($movie['poster_path']))}}"
                         class="card-img-top"
                         alt="{{ $movie['poster_path'] }}">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{$movie['title']}} ({{ substr($movie['release_date'], 0, 4) }})</h5>
                        <p class="card-text">{{$movie['overview']}}</p>
                    </div>
                    <div class="card-footer">
                        {!!  isset($movie['runtime']) ? "<small class='text-muted'>{$movie['runtime']} minutes</small>" : "" !!}
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</div>

</body>
</html>
