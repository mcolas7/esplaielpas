@extends('layout')

@section('title', 'Infants')


@section('css')
<link href="{{asset('/css/infants/infantIndex.css')}}" rel="stylesheet">
<link href="{{asset('/css/jquery-ui.min.css')}}" rel="stylesheet">

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
                <span class="input-group-text"><i class="bi bi-search" style="color: #6730b0;"></i></span>
                <input type="text" class="form-control mr-sm-2" id="search" name="search" placeholder="Escriu nom i cognoms de l'infant" maxlength="40">
                <div class="input-group-append w-50">
                  <button class="btn btn-danger my-2 my-sm-0 ms-1" type="submit" style="background:#6730b0; border: 2px solid #6730b0;">BUSCAR</button>
                </div>
              </div>
            </form>
          </div>
          <div class="col-md-6" style="text-align: end;">
            @auth 
              <a class="btn btn-primary" href="{{ route('infants.create') }}" id="inscriureInfant">INSCRIURE INFANT</a> 
            @endauth
          </div>
        </div>
      </div>
       

      <div class="container">
        @forelse ($grups as $grup)

        <div class="table-responsive mt-2">
          <table class="table table-bordered table-hover caption-top align-middle">
            <caption><h1 style="color: #6730b0;">{{$grup->nom}}</h1></caption>
            <thead style="background: #ffd81f;">
              <tr>
                <th scope="col" class="col-sm-1">NOM</th>
                <th scope="col" class="col-sm-2">COGNOMS</th>
                <th scope="col" class="col-sm-4">TUTORS</th>
                <th scope="col" class="col-sm-1">TELÈFON</th>
                <th scope="col" class="col-sm-3">AL·LÈRGIA</th>
                <th scope="col" class="col-sm-1" style="text-align: center;">ACCIONS</th>
              </tr>
            </thead>
            <tbody>
              @if (isset($infants))

                @forelse ($infants as $infant)

                  @if ($infant->infant->grup_id == $grup->grup_id)
                    <tr>
                    <td>{{$infant['nom']}}</td>
                    <td>{{$infant['cognoms']}}</td>
                    <td>
                      @forelse ($infant->infant->tutors as $tutor)
                        @if ($loop->iteration == count($infant->infant->tutors))
                          <a href="{{ route('tutors.show', $tutor->persona) }}" style="color: #6730b0;">{{$tutor->persona->nom . " " . $tutor->persona->cognoms}}</a>
                        @else
                          <a href="{{ route('tutors.show', $tutor->persona) }}" style="color: #6730b0;">{{$tutor->persona->nom . " " . $tutor->persona->cognoms ." - "}}</a>
                        @endif
                      @empty
                        <a href="{{ route('tutors.create', $infant)}}" style="color: #6730b0;"><i class="bi bi-person-plus"></i> Afegir Tutor</a>
                      @endforelse
                      @if (count($infant->infant->tutors) < 2 && count($infant->infant->tutors) > 0) {
                        <a href="{{ route('tutors.create', $infant)}}" style="color: #6730b0;"><i class="bi bi-person-plus"></i> Afegir Tutor</a>
                      }
                      @endif
                    </td>
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
                    </td>
                  @endif
                  
                @empty
                  <td colspan="7">No hi han resultats!</td>
                @endforelse
              </tr>
              @else

                @forelse ($grup->infants as $infant)
                  <tr>
                    <td>{{$infant->persona->nom}}</td>
                    <td>{{$infant->persona->cognoms}}</td>
                    <td>
                      @forelse ($infant->tutors as $tutor)
                        @if ($loop->iteration == count($infant->tutors))
                          <a href="{{ route('tutors.show', $tutor->persona) }}" style="color: #6730b0;">{{$tutor->persona->nom . " " . $tutor->persona->cognoms}}</a>
                        @else
                          <a href="{{ route('tutors.show', $tutor->persona) }}" style="color: #6730b0;">{{$tutor->persona->nom . " " . $tutor->persona->cognoms ." - "}}</a>
                        @endif
                      @empty
                        <a href="{{ route('tutors.create', $infant->persona)}}" style="color: #6730b0;"><i class="bi bi-person-plus"></i> Afegir Tutor</a>
                      @endforelse
                      @if (count($infant->tutors) < 2 && count($infant->tutors) > 0) {
                        <a href="{{ route('tutors.create', $infant->persona)}}" style="color: #6730b0;"><i class="bi bi-person-plus"></i> Afegir Tutor</a>
                      }
                      @endif
                    </td>
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
  </div>
</div>
@endsection
@section('js')
  <script src="{{asset('/js/jquery-3.6.0.min.js')}}"></script>
  <script src="{{asset('/js/jquery-ui.min.js')}}"></script>
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

  @if (session()->has('editatTutor'))
    <script>
    Swal.fire(
      "Perfecte!",
      "{{ session()->get('editatTutor')}}",
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

@if (session()->has('statusEliminarTutor'))
<script>
  Swal.fire(
    "Perfecte!",
    "{{ session()->get('statusEliminarTutor')}}",
    "success")
  </script>
@endif

@endsection