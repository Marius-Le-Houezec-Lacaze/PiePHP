<div class="columns">
    <div class="column">
    </div>
    <div class="column">
        <h1 class="title is-1">Register:</h1>
        <form action="/register" , method="POST">
            <div class="field">
                <label for="name">Username:</label>
                <input class="input is-normal" type="text" name="name" id="">
            </div>
            <div class="field">
                <label for="password">Password:</label>
                <input class="input is-normal" type="password" name="password" id="">
            </div>

            <div class="field">
                <label class="bio">Bio:</label>
                <div class="control">
                    <textarea name="bio" class="textarea"></textarea>
                </div>
            </div>

            <div class="field">
                <div class="control">
                    <button class="button is-link" type="submit">Submit</button>
                </div>
            </div>
        </form>
    </div>
    <div class="column">
    </div>
</div>