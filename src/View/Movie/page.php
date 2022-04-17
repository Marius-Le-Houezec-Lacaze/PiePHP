<div class="columns">
    <div class="column"></div>
    <div class="column is-three-fifths">
        <div class="field">
            <a href="/movie/edit/{{ $movie->getId() }}" class="button is-link is-primary"><strong>Edit</strong><i class="fa fa-pencil" aria-hidden="true"></i></a>
        </div>
        <h2 class="title is-1">{{ $movie->getName()}} <span class="tag is-primary">{{ $movie->getGenre() }}</span> </h2>
        <p class="is-3"> {{ $movie->getDescription() }}</p>


        <h3 class="title is-3">User:</h3>
        @empty($users)
        <p>{{ 'No user watched this yet'}}</p>
        @else
            @foreach($users as $user)
            <p class="is-5">{{ $user->getName()}}</p>
            @endforeach
        @endempty
    </div>
    <div class="column"></div>
</div>