<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="/css/app.css">
    <script src="/js/app.js"></script>
</head>
<body>
    <div class="container">
        <div class="py-3">
            <h1 class="text-secondary">Login to MinumanTile</h1>
        </div>

        @if ($errors->any())
        <div class="py-2 bg-danger">
            <ul>
                @foreach ($errors->all() as $e)
                <li class="text-white">{{ $e }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="login-box py-3">
            <form action="{{ route('client_login_post') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="client-email">Email</label>
                    <input name="email" id="client-email" class="form-control" type="text" placeholder="client@minuman.com">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="client-password">Password</label>
                    <input name="password" id="client-password" class="form-control" type="password">
                </div>

               <div class="mb-3">
                    <input id="client-login-submit" class="form-control btn btn-primary" type="submit" value="Login">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
