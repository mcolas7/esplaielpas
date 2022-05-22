@extends('layout')

@section('title', 'Inscripcions')


@section('css')
<link href="{{asset('/css/inscripcions/inscripcioIndex.css')}}" rel="stylesheet">
<link href="{{asset('/css/jquery-ui.min.css')}}" rel="stylesheet">

@endsection

@section('content')
<div class="container w-100">
  <div class=" mt-5 w-100 d-flex justify-content-center">
    <div class="mt-5 w-100">

      
        <div class="container">
              <div class="d-flex justify-content-center">
                <div class="mt-2">
                    <h1 class="mt-2" id="buscador" style="color: #6730b0;">{{strtoupper($excursio->nom)}}</h1>
                </div>
              </div> 
            <h1 class="mt-2" id="buscador" style="color: #6730b0;">Buscador:</h1>
            <form method="GET" action="{{ route('inscripcions.index', $excursio) }}">
              <div class="row mt-3 mb-2">
                <div class="col-md-4 themed-grid-col">
                  <div class="input-group" style="height: 40px">
                    <span class="input-group-text"><i class="bi bi-search" style="color: #6730b0;"></i></span>
                    <input type="text" class="form-control mr-sm-2" id="search" name="search" placeholder="Escriu el nom i cognoms de l'infant">
                  </div>
                </div>
                <div class="col-md-3 themed-grid-col">
                  <div class="input-group" style="height: 40px">
                    <span class="input-group-text"><i class="bi bi-bandaid" style="color: #6730b0;"></i></span>
                    <select class="form-select" id="alergies" name="alergies">
                        <option value="">Escollir al·lèrgies...</option>
                        <option value="1" {{old('alergies') == 1 ? 'selected' : '' }}>Sí</option>
                        <option value="2" {{old('alergies') == 2 ? 'selected' : '' }}>No</option>
                    </select>  
                  </div>
                </div>
                <div class="col-md-2 themed-grid-col">
                  <button class="btn btn-primary w-100 boto" style="height: 40px">BUSCAR</button>
                </div>  
              
              </div>  
            </form>
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
                <th scope="col" class="col-sm-4">AL·LÈRGIA</th>
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
                  @endif
                  
                @empty
                  <td colspan="7">No hi han resultats!</td>
                @endforelse
                </tr>
              @else

                @forelse ($inscripcions as $inscripcio)
                    <tr>
                    @if ($inscripcio->infant->grup_id == $grup->grup_id)
                        <td>{{$inscripcio->infant->persona->nom}}</td>
                        <td>{{$inscripcio->infant->persona->cognoms}}</td>
                        <td>
                            @forelse ($inscripcio->infant->tutors as $tutor)
                                @if ($loop->iteration == count($inscripcio->infant->tutors))
                                <a href="{{ route('tutors.show', $tutor->persona) }}" style="color: #6730b0;">{{$tutor->persona->nom . " " . $tutor->persona->cognoms}}</a>
                                @else
                                <a href="{{ route('tutors.show', $tutor->persona) }}" style="color: #6730b0;">{{$tutor->persona->nom . " " . $tutor->persona->cognoms ." - "}}</a>
                                @endif
                            @empty
                                <p>No tens tutors!</p>
                            @endforelse
                        </td>
                        <td>{{$inscripcio->infant->persona->telefon}}</td>
                        <td>{{$inscripcio->infant->infantSalut['alergies'] == 1 ? $inscripcio->infant->infantSalut->alergia :'No'}}</td>
                    @endif
                @empty
                    <td colspan="7">No hi ha inscripcions a l'excursió en aquest grup!</td>
                @endforelse
                    </tr>    
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
          <a class="btn btn-warning w-50 mt-3" href="{{ route('inscripcions.index', $excursio) }}" id="mostratTotsInfants">MOSTRAR TOTES LES INSCRIPCIONS</a>
        </div>
      @endforelse
      @if (isset($infants) && sizeof($grups) > 0)
        <div class="container">
          <a class="btn btn-warning w-50 mt-3" href="{{ route('inscripcions.index', $excursio) }}" id="mostratTotsInfants">MOSTRAR TOTES LES INSCRIPCIONS</a>
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
          url: '{{ route('inscripcions.search') }}',
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