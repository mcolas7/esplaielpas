@extends('layout')

@section('title', 'Crear inscripcio')

@section('css')
    <link href="{{asset('/css/excursions/excursioCreate.css')}}" rel="stylesheet">
@endsection

@section('content')


<div class="page-wrapper bg-gra-03 p-t-100 p-b-50">
    <div class="wrapper wrapper--w790">
        <div class="card card-5">
            <div class="card-heading">
                <h2 class="title">{{$excursio->nom}}</h2>
            </div>
            <div class="card-body">
              
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error!</strong> {{ $error }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endforeach
                @endif

                <form method="POST" action="{{ route('inscripcions.store', $excursio) }}" class="needs-validation mt-2" id="formulariExcursio" enctype="multipart/form-data" novalidate>
                    @csrf

                    <div class="row g-3">


                        <div class="col-md-12">
                            <label for="infant_id" class="form-label">Infant:</label>
                            <select class="form-select" id="infant_id" name="infant_id" required>
                              @forelse ($infants as $infant)
                                @if ($loop->iteration == 1)
                                    <option value="">Escollir...</option>
                                @endif
                                <option value="{{ $infant->infant_id }}" {{old('infant_id') == $infant->infant_id ? 'selected' : '' }}>{{ $infant->persona->nom . " " .  $infant->persona->cognoms }}</option>
                              @empty
                                  <option value="">No tens infants que puguin anar d'excursió!</option>
                              @endforelse
                            </select>
                            <div class="invalid-feedback">
                                Cal escollir un infant.
                              </div>
                            <div class="valid-feedback">Infant escollit!</div>
                        </div>
              
                        <div class="col-md-4">
                            <label for="preu" class="form-label">Preu</label>
                            <div class="input-group has-validation">
                                <input type="number" class="form-control" id="preu" name="preu" placeholder="Escriu el preu" value="{{session()->has('preu') ? session()->get('preu') : old('preu', $excursio->preu) }}" required readonly>
                            </div>
                        </div>

                        <hr class="my-4">
            
                        <button class="w-100 btn btn-primary btn-lg" type="submit" id="submit">INSCRIURE INFANT</button>
                             
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection

@section('js')
  <script src="{{asset('/js/inscripcions/inscripcioCreate.js')}}"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> 



  @if ($infantsInscritsBoolean == true)
    <script>
    Swal.fire(
        "Avís!",
        "Els infants ja estan inscrits a l'excursió",
        "warning")
    </script>
    @endif
@endsection  