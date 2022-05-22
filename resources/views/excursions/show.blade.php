@extends('layout')

@section('title', 'Excursio')

@section('css')
    <link href="{{asset('/css/excursions/excursioShow.css')}}" rel="stylesheet">
@endsection

@section('content')
<div class="container w-100 mt-5">
    <div class="container w-100" style="margin-top: 120px">
        <div class="container" style="text-align: end;">
            @auth {{-- Perque es mostri el link de crear un nou projecte nomes si l'usuari esta autenificat --}}
              @can('monitor', App\Models\Persona::class)
                <a class="btn btn-primary" href="{{ route('excursions.edit', $excursio) }}" id="editarExcursio">EDITAR</a> 
                {{-- <a class="btn btn-danger" href="{{ route('excursions.destroy', $excursio) }}">ELIMINAR</a>  --}}
                <form action="{{route('excursions.destroy', $excursio)}}" method="POST" class="d-inline formulariEliminar">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger border-2">ELIMINAR</button>
                </form>
              @endcan
            @endauth
        </div>
        <div class="row mb-3">
            
            <div class="col-md-4 themed-grid-col">
                <img class="img-fluid" src="/storage/{{$excursio->imatge}}" alt="{{$excursio->nom}}">
            </div>
            <div class="col-md-8 themed-grid-col">
              <div class="pb-1">
                <h1 style="color: #6730b0;">{{$excursio->nom}}</h1>
              </div>
              <div>
                  <h5>Grups: 
                      @forelse ($excursio->grups as $grup)
                        @if ($loop->iteration == count($excursio->grups))
                            {{$grup->nom}}
                        @else
                            {{$grup->nom . ", "}}
                        @endif
                      @empty
                          No hi han grups!
                      @endforelse
                  </h5>
              </div>
              <div>
                <h5>Lloc: {{$excursio->localitzacio}}</h5>
              </div>
              <div class="row">
                <div class="col-md-4 themed-grid-col"><h5>Sortida: {{$horaInici . ' ' . $dataInici}}</h5></div>
                <div class="col-md-8 themed-grid-col"><h5>Arribada: {{$horaFi . ' ' . $dataFi}}</h5></div>
              </div>
              <div>
                <h5>Preu: {{$excursio->preu . "€"}}</h5>
              </div>
              <div>
                  <p style="text-align: justify;">{{$excursio->descripcio}}</p>
              </div>
              <div class="row">
                <div class="col-md-6 themed-grid-col">
                  <a class="btn btn-primary" id="botoAutoritzacio" href="/storage/{{$excursio->autoritzacio}}" target="_blank">AUTORITZAZCIÓ</a>
                </div>
                @auth
                  <div class="col-md-6 themed-grid-col" style="text-align: end;">
                    @can('inscriure', auth()->user()->persona)
                      <a class="btn btn-primary" id="botoAutoritzacio" href="{{ route('inscripcions.create', $excursio)}}">INSCRIURE INFANT</a>
                    @endcan
                    @can('monitor', auth()->user()->persona)
                      <a class="btn btn-primary" id="botoAutoritzacio" href="{{ route('inscripcions.index', $excursio)}}">LLISTAT INFANTS</a>
                    @endcan
                  </div>
                    
                @endauth
                
              </div>
            </div>
          </div>
    </div>
</div>

@endsection

@section('js')
<script src="{{asset('/js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('/js/jquery-ui.min.js')}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  $('.formulariEliminar').submit(function(e) {
    e.preventDefault();

    Swal.fire({
    title: 'Estàs segur que vols eliminar aquesta excursió?',
    text: "Aquesta excursió s'eliminarà definitivament!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Sí, eliminar!',
    cancelButtonText: 'Cancel·lar',
  }).then((result) => {
    if (result.isConfirmed) {
      this.submit();
    }
  })
  });
</script>  
@endsection