<h1>Genre</h1>

@foreach( $genres as $genre)
<p>{{ $genre->getName()}}</p>
@endforeach