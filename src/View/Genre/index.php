<div class="columns">
    <div class="column"></div>
    <div class="column is-four-fifths">
        <h1 class="title is-1">All Genre</h1>
        <form action="/genre" method="post">

            <label class="label" for="name">Title:</label>

            <div class="field is-grouped">
                <div class="control">
                    <input class="input" type="text" name="name" id="">
                </div>

            </div>
            <div class="field">
                <button class="button is-link" type="submit">Add Movie</button>
            </div>
        </form>
        @empty($genres)
        {{ 'No genre have been declared yet'}}
        @else
        @foreach($genres as $genre)
        <form onsubmit="return confirm('Warning this will remove the movie related to this genre ?');" class="is-justify-content-space-between is-flex is-fullwidth" action="{{'/genre/delete/' . $genre->getId()}}" method="post" class="m-1">
            <label> <strong>{{ $genre->getName() }}</strong> </label>

            <div class="control"><button class="button is-light is-link is-round is-small"><i class="fa fa-times" aria-hidden="true"></i></button></div>
        </form>
        @endforeach
        @endempty
    </div>
    <div class="column"></div>
</div>