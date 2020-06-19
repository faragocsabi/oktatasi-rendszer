<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    <title>Oktatási Rendszer - @yield('title')</title>
  </head>
  <body class="bg-dark">
    <nav class="navbar navbar-expand-lg navbar-light bg-warning text-dark">
    <a class="navbar-brand font-weight-bold" href="/">Oktatási Rendszer</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          @auth
            @if(Auth::user()->is_teacher === '1')
              <a class="nav-item nav-link font-weight-bold" href="{{ route('teacher.index') }}">Tárgyaim</a>
              <a class="nav-item nav-link font-weight-bold" href="{{ route('subject.create') }}">Új tárgy meghirdetése</a>
            @else
              <a class="nav-item nav-link font-weight-bold" href="{{ route('student.index') }}">Tárgyaim</a>
              <a class="nav-item nav-link font-weight-bold" href="{{ route('available') }}">Tárgy felvétele</a>
              <a class="nav-item nav-link font-weight-bold" href="{{ route('tasks') }}">Feladatok listája</a>
            @endif
          @endauth
          <a class="nav-item nav-link font-weight-bold" href="/about">Kapcsolat</a>
        </div>
      </div>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
          <!-- Authentication Links -->
          @guest
              <li class="nav-item">
                  <a class="nav-item nav-link font-weight-bold" href="{{ route('login') }}">{{ __('Login') }}</a>
              </li>
              @if (Route::has('register'))
                  <li class="nav-item">
                      <a class="nav-item nav-link font-weight-bold" href="{{ route('register') }}">{{ __('Register') }}</a>
                  </li>
              @endif
          @else
              <li class="nav-item dropdown">
                  <a id="navbarDropdown" class="nav-item nav-link font-weight-bold dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                      {{ Auth::user()->name }}<span class="caret"></span>
                  </a>

                  <div class="dropdown-menu dropdown-menu-right bg-warning" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="{{ route('profile')}}">Profil</a>
                      <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                          {{ __('Logout') }}
                      </a>

                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>

                      
                  </div>
              </li>
          @endguest
      </ul>
    </nav>

    @yield('content')

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>