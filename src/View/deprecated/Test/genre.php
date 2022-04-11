<h1>{{ $genre->getName() }}</h1>

@foreach( $movies as $movie)
{{ $movie->getTitle()}} </br>
@endforeach