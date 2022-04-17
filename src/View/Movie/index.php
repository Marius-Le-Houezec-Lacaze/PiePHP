<div class="columns">
    <div class="column"></div>
    <div class="column is-four-fifths">
        <h1 class="title is-1">All movie</h1>
        <form action="/movie" method="post">

            <label class="label" for="name">Title:</label>

            <div class="field is-grouped">
                <div class="control">
                    <input class="input" type="text" name="name" id="">
                </div>
                <div class="select">
                    <select class="select" name="id_genre" id="">
                        @foreach($genres as $genre)
                        <option value="{{ $genre->getId()}}"> {{ $genre->getName()}} </option>
                        @endforeach
                    </select>
                </div>

            </div>

            <div class="field">
                <textarea class="textarea" name="description" id="" rows="5"></textarea>
            </div>

            <div class="field">
                <button class="button is-link" type="submit">Add Movie</button>
            </div>
        </form>


        @foreach($movies as $movie)
        <div class="field is-grouped is-flex is-justify-content-space-between is-fullwidth m-2">

            <form onsubmit="return confirm('Warning this will remove the movie from all user history ?');" class="is-justify-content-space-between is-flex is-fullwidth" action="{{'/movie/delete/' . $movie->getId()}}" method="post" class="m-1">
                <div class="control"><button class="button is-light is-link is-round is-small"><i class="fa fa-times" aria-hidden="true"></i></button></div>
                <label> <strong><a href="/movie/{{ $movie->getId() }}" class="is-link">{{ $movie->getName() }}</a></strong> <span class="tag is-primary">{{ $movie->getGenre() }}</span> </label>

            </form>

            <form action="{{'/history/add/' . $movie->getId() }}" method="POST">
                <div class="control"><button class="button is-link is-small">Add to history</button></div>
            </form>
        </div>
        @endforeach
    </div>
    <div class="column"></div>
</div>