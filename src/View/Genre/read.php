<div class="columns">
    <div class="column"></div>
    <div class="column is-three-fifths">
        <h1 class="title is-3">{{ $genre->getName() }}</h1>
        <br>
        <form action="/genre/delete/{{$genre->getId()}}" method="POST" onsubmit='return(confirm("Warning this will remove all movie with this gner"))'>
            <a href="/genre/edit/{{$genre->getId()}}" class="is-link is-primary button">Edit this genre</a>
            <button class="is-link is-warning button" type="submit">Delete this genre</button>
        </form>
        <br>

        @empty($empty)
        <p>No movie in this genre yet</p>

        @else
        @foreach($movies as $movie)
        <a href="/movie/{{ $movie->getId() }}" class="is-link is-5">{{ $movie->getName()}}</a>
        @endforeach
        @endempty


    </div>
    <div class="column"></div>
</div>