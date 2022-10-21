<h1>Welcome {{ $user->name }}, Now you are a member of our website</h1>
<div>
    Click <a href='http://127.0.0.1:8000/verify-account?code={{ $user->verify_token }}'>here</a> to verify your account.
</div>
