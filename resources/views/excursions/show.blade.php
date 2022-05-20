@extends('layout')

@section('title', 'Excursions')

@section('css')
    <link href="{{asset('/css/excursions/excursioShow.css')}}" rel="stylesheet">
@endsection

@section('content')
<div class="container w-100 border-1 mt-5">
    <div class="container w-100 border-3" style="margin-top: 120px">
        <div class="container" style="text-align: end;">
            @auth {{-- Perque es mostri el link de crear un nou projecte nomes si l'usuari esta autenificat --}}
              <a class="btn btn-primary" href="{{ route('excursions.edit', $excursio) }}" id="editarExcursio">EDITAR</a> 
            @endauth
        </div>
        <div class="row mb-3">
            
            <div class="col-md-4 themed-grid-col" style="border: 2px solid;">
                <img class="img-fluid" src="/storage/{{$excursio->imatge}}" alt="{{$excursio->nom}}">
            </div>
            <div class="col-md-8 themed-grid-col">
              <div class="pb-1 border">
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
                <div class="col-md-6 themed-grid-col border"><a class="btn btn-primary" id="botoAutoritzacio" href="/storage/{{$excursio->autoritzacio}}" target="_blank">Autorització</a></div>
                @auth
                    <div class="col-md-6 themed-grid-col border">.col-md-6</div>
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
@endsection