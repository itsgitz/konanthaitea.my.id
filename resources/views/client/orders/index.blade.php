<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <link href="/css/app.css" rel="stylesheet">
    <script src="/js/app.js"></script>
</head>
<body>
    <div class="container">
        <div class="py-3">
            <h1 class="text-secondary">MinumanTile</h1>
        </div>
        <div class="py-3">
            <div class="bg-secondary rounded p-2">
                <p class="text-light">Hei <i>{{ $user->name }}</i>! Order your favorite drinks!</p>
            </div>
            <div class="py-2">
                <form method="post" action="{{ route('client_logout_post') }}">
                    @csrf
                    <a href="{{ route('client_logout_post') }}" onclick="event.preventDefault();this.closest('form').submit()">Logout</a>
                </form>
                <nav>
                    <a href="{{ route('client_home') }}">Home</a>
                </nav>
            </div>
        </div>
        <div class="py-3">
            My Orders
        </div>
    </div> 
</body>
</html>
