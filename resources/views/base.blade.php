<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <title>@yield('title')</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
        <div class="container-fluid">
          <a class="navbar-brand" >Blog</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a @class(['nav-link', 'active' => request()->route()->getName() === 'blog.index']) aria-current="page" href="{{ route('blog.index')}}">Blog</a>
              </li>
            </ul>
            <div class="navbar-nav ms-auto mb-2 mb-lg-0">
                @auth
                    {{ Auth::user()->name }}
                    <form class="nav-item" action="{{route('auth.logout')}}" method="post">
                        @method("delete")
                        @csrf
                        <button class="nav-link">Se déconnecter</button>
                    </form>
                @endauth
                @guest
                <div class="nav-item">
                    <a class="nav-link" href="{{route('auth.login')}}">Se connecter</a>
                </div>
                @endguest
            </div>
          </div>
        </div>
      </nav>
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @yield('content')
        </div>

</body>
</html>
