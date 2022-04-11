@foreach($genres as $genre)
<p>{{ $genre->getName()}} <a href="/genre/{{ $genre->getId()}}"> page</a> </p>
@endforeach