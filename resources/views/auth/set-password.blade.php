<form method="POST" action="{{ route('password.save') }}">
    @csrf
    <div>
        <label>New Password</label>
        <input type="password" name="password" required>
    </div>
    <div>
        <label>Confirm Password</label>
        <input type="password" name="password_confirmation" required>
    </div>
    <button type="submit">Set Password</button>
</form>
