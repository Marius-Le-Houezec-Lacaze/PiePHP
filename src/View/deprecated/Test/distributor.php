@foreach($distributors as $distributor)
<p>{{ $distributor->getName()}} <a href="{{ $distributor->getId()}}">link</a></p>
@endforeach