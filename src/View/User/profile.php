<div class="columns">
    <div class="column">
    </div>
    <div class="column">
        <h1 class="title is-1">Profile:</h1>
        <a href="/profile/edit" class="is-primary button">Edit profile</a>

        <form action="/profile/delete" method="post" onsubmit="return(confirm('this will erase you account permanently'))">
            <div class="control"><button type="submit" class="is-danger button">Delete Account</button></div>
        </form>

        <label for="" class="text is-size-5">Username:</label>
        <p class="text is-size-6">{{ $user->getName()}}</p>
        <label for="" class="text is-size-5">Bio:</label>
        <p>{{ $user->getBio() }}</p>

        <hr>
        <h2 class="title is-5">History:</h2>
        @foreach($movies as $movie)
        <form action="{{'/history/delete/' . $movie->getId() }}" method="POST" class="m-1">
            <div class="field is-grouped is-flex is-justify-content-space-between">
                <label> <strong>{{ $movie->getName() }}</strong> genre: {{ $movie->getGenre() }} </label>
                <div class="control"><button class="button is-link is-small">Remove</button></div>
            </div>
        </form>
        </p>
        @endforeach
    </div>
    <div class="column">
    </div>
</div>