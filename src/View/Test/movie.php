@empty(!$movie[0])
{{ $movie[0]['title'] }} <br>
{{ $movie[0]['director'] }} <br>
{{ $movie[0]['duration'] }} <br>
@endempty

@empty($movie)
<p>No movie at this id</p>
@endempty