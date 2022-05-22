@extends('layout')

@section('title', 'Excursions')

@section('css')
    <link href="{{asset('css/excursions/excursioIndex.css')}}" rel="stylesheet">
    <link href="{{asset('/css/jquery-ui.min.css')}}" rel="stylesheet">
@endsection

@section('content')
<div class="container w-100 mt-5">
  <div class="container mt-5 w-100">

    <div class="container" style="margin-top: 100px;">
      @can('monitor', App\Models\Persona::class)
        <div class="d-flex justify-content-end">
          <div class="mt-2">
            <a class="btn btn-primary" href="{{ route('excursions.create') }}" id="crearExcursio">CREAR EXCURSIÓ</a> 
          </div>
        </div>
      @endcan  
      <h1 class="mt-2" id="buscador" style="color: #6730b0;">Buscador:</h1>
      <form method="GET" action="{{ route('excursions.index') }}">
        <div class="row mt-3 mb-2">
          <div class="col-md-4 themed-grid-col">
            <div class="input-group" style="height: 40px">
              <span class="input-group-text"><i class="bi bi-search" style="color: #6730b0;"></i></span>
              <input type="text" class="form-control mr-sm-2" id="search" name="search" placeholder="Escriu el nom de l'excursió">
            </div>
          </div>
          <div class="col-md-3 themed-grid-col">
            <div class="input-group" style="height: 40px">
              <span class="input-group-text"><i class="bi bi-people-fill" style="color: #6730b0;"></i></span>
              <select class="form-select" id="grup" name="grup">
                <option value="">Grup...</option>
                @forelse ($grups as $grup)
                    <option value="{{ $grup->grup_id }}" {{old('grup') == $grup->grup_id ? 'selected' : '' }}>{{ $grup->nom }}</option>
                @empty
                    <option>No hi ha grups!</option>
                @endforelse
              </select>  
            </div>
          </div>
          <div class="col-md-3 themed-grid-col">
            <div class="input-group" style="height: 40px">
              <span class="input-group-text"><i class="bi bi-signpost-fill" style="color: #6730b0;"></i></span>
              <select class="form-select" id="tipoExcursio" name="tipoExcursio">
                <option value="">Tipus excursió...</option>
                @forelse ($tiposExcursions as $tipoExcursio)
                    <option value="{{ $tipoExcursio->tipo_excursio_id }}" {{old('tipoExcursio') == $tipoExcursio->tipo_excursio_id ? 'selected' : '' }}>{{ $tipoExcursio->nom }}</option>
                @empty
                    <option>No hi han tipus d'excursió!</option>
                @endforelse
              </select>  
            </div>
          </div>
          <div class="col-md-2 themed-grid-col">
            <button class="btn btn-primary w-100 boto" style="height: 40px">BUSCAR</button>
          </div>  
        
        </div>  
      </form>
    </div>
    

    <section class="hero-section">
        <div class="card-grid">

          @forelse ($excursions as $excursio)
            <a class="card" href="{{ route('excursions.show', $excursio) }}">
              <div class="card__background" style="background-image: url(/storage/{{$excursio->imatge}}"></div>
              <div class="card__content">
                {{-- <p class="card__category">{{$excursio->preu . "€"}}</p> --}}
                <h3 class="card__heading">{{$excursio->nom}}</h3>
              </div>
            </a>
          @empty
            <h3 style="color: #6730b0;">No hi han excursions!</h3>
            <a class="btn btn-primary boto" href="{{route('excursions.index')}}">MOSTRAR LLISTAT EXCURSIONS</a>
          @endforelse

        <div>
    </section>
  </div>
</div>

@include('partials.footer')
@endsection

@section('js')
<script src="{{asset('/js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('/js/jquery-ui.min.js')}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  $("#search").autocomplete({
    source: function(request, response) {
      $.ajax({
        url: '{{ route('excursions.search') }}',
        dataType: 'json',
        data: {
          term: request.term
        },
        success: function (data) {
          response(data);
        },
        error: function () {
          alert('Error!')
        }
      });
    }
  });
</script>

@if (session()->has('status'))
<script>
  Swal.fire(
    "Perfecte!",
    "{{ session()->get('status')}}",
    "success")
  </script>
@endif

@if (session()->has('inscripcio'))
<script>
  Swal.fire(
    "Perfecte!",
    "{{ session()->get('inscripcio')}}",
    "success")
  </script>
@endif

@endsection