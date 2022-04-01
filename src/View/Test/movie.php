
@empty(!$movie)
{{ $movie['title'] }} <br>
{{ $movie['director'] }} <br>
{{ $movie['duration'] }} <br>
@endempty

@empty($movie)
    <p>No movie at this id</p>
@endempty
