<div>
    <form method="post" action="{{ route('password.update') }}">
        <label for="password">Password:</label>
        <input type="password" name="password" id="password">
        <input type="hidden" name="email" id="email" value="{{ $email }}">
        <input type="hidden" name="token" id="token" value="{{ $token }}">
        <button type="submit">Submit</button>
    </form>
</div>
