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
          <div class="col-md-6 justify-content-end align-content-end">
            @auth {{-- Perque es mostri el link de crear un nou projecte nomes si l'usuari esta autenificat --}}
              <a class="btn btn-primary" href="{{ route('infants.create') }}">Inscriure infant</a> 
            @endauth
          </div>
        </div>
      </div>
       

      @if (session()->has('message'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Perfecte!</strong> {{ session()->get('message')}}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
      <div class="container">
        @forelse ($grups as $grup)

        <div class="table-responsive mt-2">
          <table class="table table-bordered table-hover caption-top align-middle">
            <caption><h1 style="color: #6730b0;">{{$grup->nom}}</h1></caption>
            <thead style="background: #ffd81f;">
              <tr>
                <th scope="col" class="col-sm-1">NOM</th>
                <th scope="col" class="col-sm-2">COGNOMS</th>
                <th scope="col" class="col-sm-3">EMAIL</th>
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
                    <td>
                      <a href="{{ route('infants.show', $infant) }}" class="show" title="Show" data-toggle="tooltip"><i class="bi bi-eye" style="color: #6730b0;"></i></a>
                      <a href="{{ route('infants.edit', $infant) }}" class="edit" title="Edit" data-toggle="tooltip"><i class="bi bi-pencil" style="color: #6730b0;"></i></a>
                      <a class="delete" title="Delete" data-toggle="tooltip"><i class="bi bi-trash" style="color: #6730b0;"></i></a>
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
                    <td>{{$infant->persona->email}}</td>
                    <td>{{$infant->persona->telefon}}</td>
                    <td>{{$infant->infantSalut['alergies'] == 1 ? $infant->infantSalut->alergia :'No'}}</td>
                    <td style="text-align: center;">
                      <a href="{{ route('infants.show', $infant->persona) }}" class="show" title="Show" data-toggle="tooltip"><i class="bi bi-eye" style="color: #6730b0;"></i></a>
                      <a href="{{ route('infants.edit', $infant->persona) }}" class="edit" title="Edit" data-toggle="tooltip"><i class="bi bi-pencil" style="color: #6730b0;"></i></a>
                      <a class="delete" title="Delete" data-toggle="tooltip"><i class="bi bi-trash" style="color: #6730b0;"></i></a>
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
          <a class="btn btn-warning w-25 mt-3" href="{{ route('infants.index') }}" style="color: white; background:#6730b0; ">MOSTRAR TOTS ELS INFANTS</a>
        </div>
      @endforelse
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
            console.log(data);
          },
          error: function () {
            alert('Error!')
          }
        });
      }
    });
  </script>

  @if (session('statusSearch') == 'ko')
    <script>
    console.log('hola');
    Swal.fire(
      "Error!",
      "No hi han resultats!",
      "error")
    </script>
  @endif

@endsection