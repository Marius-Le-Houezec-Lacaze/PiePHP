<div class="columns">
    <div class="column"></div>
    <div class="column is-four-fifths">
        <h1 class="title is-1">All Genre</h1>
        <form action="/genre/edit/{{ $genre->getId() }}" method="post">

            <label class="label" for="name">Title:</label>

            <div class="field is-grouped">
                <div class="control">
                    <input value='{{$genre->getName()}}' class="input" type="text" name="name" id="">
                </div>

            </div>
            <div class="field">
                <button class="button is-link" type="submit">Edit Genre</button>
            </div>
        </form>
    </div>
    <div class="column"></div>
</div>