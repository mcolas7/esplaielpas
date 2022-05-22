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
          {{-- <li class="nav-item"><a href="{{ route('blog') }}" class="nav-link {{ request()->routeIs('blog') ? 'active' : ''}}">BLOG</a></li> --}}
          @auth
            <li class="nav-item"><a href="{{ route('excursions.index') }}" class="nav-link {{ request()->routeIs('excursions.index') ? 'active' : ''}}">EXCURSIONS</a></li>
            @can('monitor', App\Models\Persona::class)
              <li class="nav-item"><a href="{{ route('infants.index') }}" class="nav-link {{ request()->routeIs('infants.index') ? 'active' : ''}}">INFANTS</a></li>
            @endcan
            
          @endauth
        </ul>
      </div>
        <div class="col-md-3 text-end pe-4 align-content-end p-2">
            
            @guest
              <a href="{{ route('login') }}"><button type="button" class="boto-inici">INICIAR SESSIÓ</button></a>
            @else
              <div class="d-flex justify-content-end">
                <div class="dropdown text-end me-3 mt-2" >
                  <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                      <path style="color: #6730b0;" d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                      <path style="color: #6730b0;" fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                    </svg>
                  </a>
                  <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
                    <li><a class="dropdown-item" href="{{ route('tutors.show', auth()->user()->persona) }}">Perfil</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="{{ route('tutors.change') }}">Canviar contrasenya</a></li>
                  </ul>
                </div>

                <div>
                  <button type="button" class="boto-inici" href="#" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"
                    >TANCAR SESSIÓ</button>
                </div>
              </div>
                
            @endguest
        </div>
      
    </nav>

</header><!-- End Header -->
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>