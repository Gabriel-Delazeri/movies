@foreach($movieVideos as $video)
    <iframe width="420" height="315" src="https://www.youtube.com/embed/{{$video['key']}}"></iframe>
@endforeach
