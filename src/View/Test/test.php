

@foreach ( $movies as $movie)

    {{ $movie['title'] }} <a href='{{ '/movie/' . $movie['id'] }}'>page</a><br>

@endforeach