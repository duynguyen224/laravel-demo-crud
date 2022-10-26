<h1>Welcome {{ $user->name }}, now you are a member of our website</h1>
<div>
    Click <a href="{{ route('verify_account') . '?code=' . $user->verify_token }}">here</a> to verify your account.
</div>
