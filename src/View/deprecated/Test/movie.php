<a href="/distributor/{{ $distributor->getId() }}">Distributor</a>

<h1>{{ $movie->getTitle() }}</h1>
<h3>{{ $distributor->getName() }}</h3>

@foreach($genre as $g)
    {{ $g->getName()}}
@endforeach

