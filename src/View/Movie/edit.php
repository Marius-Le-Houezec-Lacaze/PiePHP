<div class="columns">
    <div class="column"></div>
    <div class="column is-four-fifths">
        <h1 class="title is-1">All movie</h1>
        <form action="" method="post">

            <label class="label" for="name">Title:</label>

            <div class="field is-grouped">
                <div class="control">
                    <input class="input" type="text" name="name" value="{{ $movie->getName() }}" id="">
                </div>
                <div class="select">
                    <select class="select" name="id_genre" id="" autocomplete="off">
                        @foreach($genres as $genre)
                        <option value="{{ $genre->getId()}}" {{ $movie->getGenreId() == $genre->getId() ? 'selected="true"':'' }}> {{ $genre->getName()}} </option>
                        @endforeach
                    </select>
                </div>

            </div>

            <div class="field">
                <textarea class="textarea" name="description" id="" rows="5">{{ $movie->getDescription()}}</textarea>
            </div>

            <div class="field">
                <button class="button is-link" type="submit">Edit Movie</button>
            </div>
        </form>
    </div>
</div>