<h2>Verify Your Email Address</h2>
<p>A verification link has been sent to your email address.</p>
<form method="POST" action="{{ route('verification.send') }}">
    @csrf
    <button type="submit">Resend Verification Email</button>
</form>
