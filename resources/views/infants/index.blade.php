@extends('layout')

@section('title', 'Infants')


@section('css')
    <link href="/css/infants/infantIndex.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/jquery-ui.min.css">

@endsection

@section('content')
<div class="container w-100">
  <div class=" mt-5 w-100 d-flex justify-content-center">
    <div class="mt-5 w-100">

      
      <div class="container mt-1">
        <h1 class="mt-4" id="buscador">Buscador:</h1>
        <div class="row">
          <div class="col-md-6">
            <form action="{{ route('infants.index') }}" class="form-inline" method="GET">
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-search"></i></span>
                <input type="text" class="form-control mr-sm-2" id="search" name="search" placeholder="Escriu nom i cognoms de l'infant">
                <div class="input-group-append w-50">
                  <button class="btn btn-danger my-2 my-sm-0" type="submit" style="background:#6730b0; border: 2px solid #6730b0;">BUSCAR</button>
                </div>
              </div>
            </form>
          </div>
          <div class="col-md-6" style="text-align: end;">
            @auth {{-- Perque es mostri el link de crear un nou projecte nomes si l'usuari esta autenificat --}}
              <a class="btn btn-primary" href="{{ route('infants.create') }}" id="inscriureInfant">INSCRIURE INFANT</a> 
            @endauth
          </div>
        </div>
      </div>
       

      {{-- @if (session()->has('status'))
        <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
          <strong>Perfecte!</strong> {{ session()->get('status')}}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif --}}

      <div class="container">
        @forelse ($grups as $grup)

        <div class="table-responsive mt-2">
          <table class="table table-bordered table-hover caption-top align-middle">
            <caption><h1 style="color: #6730b0;">{{$grup->nom}}</h1></caption>
            <thead style="background: #ffd81f;">
              <tr>
                <th scope="col" class="col-sm-1">NOM</th>
                <th scope="col" class="col-sm-2">COGNOMS</th>
                <th scope="col" class="col-sm-3">TUTORS</th>
                {{-- <th scope="col" class="col-sm-3">EMAIL</th> --}}
                <th scope="col" class="col-sm-2">TELÈFON</th>
                <th scope="col" class="col-sm-3">AL·LÈRGIA</th>
                <th scope="col" class="col-sm-1" style="text-align: center;">ACCIONS</th>
              </tr>
            </thead>
            <tbody>
              @if (isset($infants))

                @forelse ($infants as $infant)

                  @if ($infant->infant->grup_id == $grup->grup_id)

                    <td>{{$infant['nom']}}</td>
                    <td>{{$infant['cognoms']}}</td>
                    <td>{{$infant['email']}}</td>
                    <td>{{$infant['telefon']}}</td>
                    <td>{{$infant->infant->infantSalut['alergies'] == 1 ? $infant->infant->infantSalut->alergia :'No'}}</td>
                    <td style="text-align: center;">
                      <a href="{{ route('infants.show', $infant) }}" class="show" title="Show" data-toggle="tooltip"><i class="bi bi-eye" style="color: #6730b0;"></i></a>
                      <a href="{{ route('infants.edit', $infant) }}" class="edit" title="Edit" data-toggle="tooltip"><i class="bi bi-pencil" style="color: #6730b0;"></i></a>
                      <form action="{{route('infants.destroy', $infant)}}" method="POST" class="d-inline formulariEliminar">
                        @csrf
                        @method('DELETE')
                        <button style="border: none;"><i class="bi bi-trash" style="color: #6730b0;"></i></button>
                      </form>
                      <a class="delete" title="Delete" data-toggle="tooltip"></a>
                    </td>
                  @endif
                  
                @empty
                  <td colspan="7">No hi han resultats!</td>
                @endforelse

              @else

                @forelse ($grup->infants as $infant)
                  <tr>
                    <td>{{$infant->persona->nom}}</td>
                    <td>{{$infant->persona->cognoms}}</td>
                    <td>
                      @forelse ($infant->tutors as $tutor)
                        <a href="{{ route('tutors.show', $tutor->persona) }}">{{$tutor->persona->nom . " " . $tutor->persona->cognoms}}</a>
                      @empty
                        No te cap tutor!
                      @endforelse
                    </td>
                    
                    {{-- <td>{{$infant->persona->email}}</td> --}}
                    <td>{{$infant->persona->telefon}}</td>
                    <td>{{$infant->infantSalut['alergies'] == 1 ? $infant->infantSalut->alergia :'No'}}</td>
                    <td style="text-align: center;">
                      <a href="{{ route('infants.show', $infant->persona) }}" class="show" title="Show" data-toggle="tooltip"><i class="bi bi-eye" style="color: #6730b0;"></i></a>
                      <a href="{{ route('infants.edit', $infant->persona) }}" class="edit" title="Edit" data-toggle="tooltip"><i class="bi bi-pencil" style="color: #6730b0;"></i></a>
                      <form action="{{route('infants.destroy', $infant->persona)}}" method="POST" class="d-inline formulariEliminar">
                        @csrf
                        @method('DELETE')
                        <button style="border: none;"><i class="bi bi-trash" style="color: #6730b0;"></i></button>
                      </form>
                      {{-- <a class="delete" title="Delete" data-toggle="tooltip"><i class="bi bi-trash" style="color: #6730b0;"></i></a> --}}
                    </td>
                  </tr>
                @empty
                  <td colspan="7">No hi ha infants en aquest grup!</td>
                @endforelse

              @endif
              
            </tbody>
          </table>
        </div>
        
      @empty
        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
          <strong>Error!</strong> No hi han resultats!
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <div class="container">
          <a class="btn btn-warning w-25 mt-3" href="{{ route('infants.index') }}" id="mostratTotsInfants">MOSTRAR TOTS ELS INFANTS</a>
        </div>
      @endforelse
      @if (isset($infants) && sizeof($grups) > 0)
        <div class="container">
          <a class="btn btn-warning w-25 mt-3" href="{{ route('infants.index') }}" id="mostratTotsInfants">MOSTRAR TOTS ELS INFANTS</a>
        </div>
      @endif
      </div>
      
    </div>
    {{-- @include('partials.session-status')  Per mostrar un missatge conforme s'ha eliminat el projecte, utilizant variables de sessio --}}
    
  {{-- <ul>
    @forelse ($espurnes as $espurna)
        <li><small>{{ $espurna->infant_id }}</small><br> <small> {{ $espurna->persona_id }}</small> <br> {{ $espurna->grup_id }}</li> {{-- Tambe hi ha el metode diffForHumans()
    @empty
        <li>No hay proyectos para mostrar</li>
    @endforelse --}}

    {{-- {{ $projects->links() }}  Per mostrar els botons de paginacio 
   
      </ul> --}}

  </div>
  
  


</div>
@endsection
@section('js')
  <script src="/js/jquery-3.6.0.min.js"></script>
  <script src="/js/jquery-ui.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    $("#search").autocomplete({
      source: function(request, response) {
        $.ajax({
          url: '{{ route('infants.search') }}',
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

  @if (session()->has('statusSearch'))
    <script>
    Swal.fire(
      "Error!",
      "No hi han resultats!",
      "error")
    </script>
  @endif

  @if (session('statusTutor') == 'ok')
    <script>
    Swal.fire(
      "Perfecte!",
      "Tutor inscrit amb èxit!",
      "success")
    </script>
  @endif

  <script>
    $('.formulariEliminar').submit(function(e) {
      e.preventDefault();

      Swal.fire({
      title: 'Estàs segur que vols eliminar aquest infant?',
      text: "Aquest infant s'eliminarà definitivament!",
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

@if (session()->has('statusEliminar'))
<script>
  Swal.fire(
    "Perfecte!",
    "{{ session()->get('statusEliminar')}}",
    "success")
  </script>
@endif

@endsection