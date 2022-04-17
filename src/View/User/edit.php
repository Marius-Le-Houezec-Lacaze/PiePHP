<div class="columns">
    <div class="column"></div>
    <div class="column is-three-fifths ">
        <h1 class="title is-3">Edit profile</h1>
        <form action="/profile/edit" method="post">
            <div class="field">
                <label class="label" for="name">Name:</label>
                <div class="control">
                    <input class="input" type="text" name="name" value="{{ $user->getName()}}">
                </div>
            </div>
            <div class="label"><label for="bio">Bio:</label></div>
            <div>
                <textarea class="textarea" name="bio" id="" rows="5">
                {{$user->getBio()}}
                </textarea>
            </div>

            <div class="control"><button type="submit" class="is-link button is-primary">Edit profile</button></div>
        </form>
    </div>
    <div class="column"></div>
</div>