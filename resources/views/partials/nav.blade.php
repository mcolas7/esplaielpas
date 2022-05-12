<header id="header" class="fixed-top border-bottom border-warning">

    <nav class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 navbar-expand-md navbar-light"> <!-- border-bottom -->
      
      <a href="{{ route('home') }}" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
        <img class="bi me-2 ps-3" src="/img/logoHeader.png">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-center" id="navbarCollapse">
        <ul class="nav nav-pills">
          <li class="nav-item"><a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : ''}}" aria-current="page">INICI</a></li>
          <li class="nav-item"><a href="{{ route('nosaltres') }}" class="nav-link {{ request()->routeIs('nosaltres') ? 'active' : '' }}">NOSALTRES</a></li>
          <li class="nav-item"><a href="{{ route('blog') }}" class="nav-link {{ request()->routeIs('blog') ? 'active' : ''}}">BLOG</a></li>
          @auth
            <li class="nav-item"><a href="{{ route('excursions') }}" class="nav-link {{ request()->routeIs('excursions') ? 'active' : ''}}">EXCURSIONS</a></li>
          @endauth
        </ul>
      </div>
        <div class="col-md-3 text-end pe-4 align-content-end p-2">
            @guest
            <a href="{{ route('login') }}"><button type="button" class="boto-inici">INICIAR SESSIÓ</button></a>
            @else
                <button type="button" class="boto-inici" href="#" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"
                >TANCAR SESSIÓ</button>
            @endguest
           <!-- btn btn-outline-warning me-2 -->
          <!-- <button type="button" class="btn btn-warning ">Registrar-se</button> -->
        </div>
      
    </nav>

</header><!-- End Header -->
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none"> {{-- MOLT IMPORTANT QUE ELS LOG OUT SIGUI UTILIZANT EL METODE POST I NO GET --}}
    @csrf
</form>