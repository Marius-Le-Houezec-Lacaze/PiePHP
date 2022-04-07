<p>
    <a href='{{ ($id - 1) }}'>Previous</a>
    <a href='{{ ($id + 1) }}'>Next</a>
</p>
@foreach ( $movies as $movie)

    {{ $movie->getTitle() }} <a href='{{ '/movie/' . $movie->getId() }}'>page</a><br>

@endforeach

