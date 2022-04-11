<h1>All movie</h1>

<form action="/movie" method="post">

    <label for="name">Title:</label>
    <input type="text" name="name" id="">
    <label for="id_genre">Genre:</label>
    <select name="id_genre" id="">
        @foreach($genres as $genre)
        <option value="{{ $genre->getId()}}"> {{ $genre->getName()}} </option>
        @endforeach
    </select>
    <button type="submit">Add Movie</button>
</form>


@foreach($movies as $movie)
<p style="display: inline-block;"> <strong>{{ $movie->getName() }}</strong> genre: {{ $movie->getGenre() }}
<form style=" margin-left:1em; display: inline-block;" action="{{'/movie/delete/' . $movie->getId()}}
" method="post"><button>delete</button></form>
</p>
@endforeach