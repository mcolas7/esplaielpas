@extends('layout')

@section('title', 'Crear inscripcio')

@section('css')
    <link href="/css/excursions/excursioCreate.css" rel="stylesheet">
@endsection

@section('content')


<div class="page-wrapper bg-gra-03 p-t-100 p-b-50">
    <div class="wrapper wrapper--w790">
        <div class="card card-5">
            <div class="card-heading">
                <h2 class="title">Crear excursió</h2>
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

                @if (session()->has('errorsExcursio'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> {{ session()->get('errorsExcursio')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form method="POST" action="{{ route('excursions.store') }}" class="needs-validation mt-2" id="formulariExcursio" enctype="multipart/form-data" novalidate>
                    @csrf

                    <div class="row g-3">

                        <div class="col-md-12">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom" placeholder="Escriu el nom de l'excursió" value="{{session()->has('nom') ? session()->get('nom') : old('nom', $excursio->nom) }}" maxlength="20" required>
                            <div class="invalid-feedback">
                              Cal afegir un nom vàlid.
                            </div>
                            <div class="valid-feedback">Nom vàlid!</div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Grups que participen:</label><br>
                            @forelse ($grups as $grup)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="{{ $grup->grup_id }}" name="grups[]" value="{{ $grup->grup_id }} {{ old('$grup->grup_id') == $grup->grup_id ? 'checked' : '' }}">
                                    <label class="form-check-label" for="{{ $grup->grup_id }}">{{ $grup->nom}}</label>
                                </div>
                            @empty
                                <p>No hi han grups!</p>
                            @endforelse
                        </div>

                        <div class="col-md-6">
                            <label for="tipo_excursio_id" class="form-label">Tipus d'excursió</label>
                            <select class="form-select" id="tipo_excursio_id" name="tipo_excursio_id" required>
                                <option value="">Escollir...</option>
                                @forelse ($tiposExcursions as $tipoExcursio)
                                    <option value="{{ $tipoExcursio->tipo_excursio_id }}" {{old('tipo_excursio_id') == $tipoExcursio->tipo_excursio_id ? 'selected' : '' }}>{{ $tipoExcursio->nom }}</option>
                                @empty
                                    <option>No hi ha tipus d'excursions</option>
                                @endforelse
                            </select>
                            <div class="invalid-feedback">
                                Cal afegir un tipus d'excursió vàlid.
                            </div>
                            <div class="valid-feedback">Tipus excursió vàlid!</div>
                        </div>
              
                        <div class="col-md-8">
                            <label for="localitzacio" class="form-label">Localització</label>
                            <input type="text" class="form-control" id="localitzacio" name="localitzacio" placeholder="Escriu la localització de la sortida" value="{{session()->has('localitzacio') ? session()->get('localitzacio') : old('localitzacio' , $excursio->localitzacio) }}" maxlength="40" required>
                            <div class="invalid-feedback">
                                Cal afegir uns localització vàlids.
                            </div>
                            <div class="valid-feedback">Localització vàlid!</div>
                        </div>
                
              
                        <div class="col-md-4">
                            <label for="preu" class="form-label">Preu</label>
                            <div class="input-group has-validation">
                                <input type="number" class="form-control" id="preu" name="preu" placeholder="Escriu el preu" value="{{session()->has('preu') ? session()->get('preu') : old('preu', $excursio->preu) }}" min="1" max="300" required>
                                <div class="invalid-feedback">
                                Cal afegir un preu vàlid.
                                </div>
                                <div class="valid-feedback">Preu vàlid!</div>
                            </div>
                        </div>

                          
  
                        <div class="col-md-8">
                            <label for="data_inici" class="form-label">Data de sortida</label>
                            <div class="input-group has-validation">
                            <input type="date" class="form-control" id="data_inici" name="data_inici" value="{{ old('data_inici', $excursio->data_inici) }}" required>
                            <div class="invalid-feedback">
                                Cal afegir una data de sortida vàlida.
                            </div>
                            <div class="valid-feedback">Data de sortida vàlida!</div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="hora_inici" class="form-label">Hora de sortida</label>
                            <div class="input-group has-validation">
                            <input type="time" class="form-control" id="hora_inici" name="hora_inici" value="{{ old('hora_inici', $excursio->hora_inici) }}" required>
                            <div class="invalid-feedback">
                                Cal afegir una hora de sortida vàlida.
                            </div>
                            <div class="valid-feedback">Hora de sortida vàlida!</div>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <label for="data_fi" class="form-label">Data d'arribada</label>
                            <div class="input-group has-validation">
                            <input type="date" class="form-control" id="data_fi" name="data_fi" value="{{ old('data_fi', $excursio->data_fi) }}" required>
                            <div class="invalid-feedback">
                                Cal afegir una data d'arribada vàlida.
                            </div>
                            <div class="valid-feedback">Data d'arribada vàlida!</div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="hora_fi" class="form-label">Hora d'arribada</label>
                            <div class="input-group has-validation">
                            <input type="time" class="form-control" id="hora_fi" name="hora_fi" value="{{ old('hora_fi', $excursio->hora_fi) }}" required>
                            <div class="invalid-feedback">
                                Cal afegir una hora d'arribada vàlida.
                            </div>
                            <div class="valid-feedback">Hora d'arribada vàlida!</div>
                            </div>
                        </div>

                          
                        <div class="col-md-6">
                            <label for="lat" class="form-label">Latitud <span class="text-muted">(Opcional)</span></label>
                            <input type="text" class="form-control" id="lat" name="lat" placeholder="Escriu la latitud" value="{{session()->has('lat') ? session()->get('lat') : old('lat', $excursio->lat) }}">
                            <div class="invalid-feedback">
                                Cal afegir una latitud vàlida.
                            </div>
                            <div class="valid-feedback">Latitud vàlida!</div>
                        </div>
              
              
                        <div class="col-md-6">
                            <label for="long" class="form-label">Longitud <span class="text-muted">(Opcional)</span></label>
                            <input type="text" class="form-control" id="long" name="long" placeholder="Escriu la longitud" value="{{session()->has('long') ? session()->get('long') : old('long', $excursio->long) }}">
                            <div class="invalid-feedback">
                                Cal afegir una longitud vàlida.
                            </div>
                            <div class="valid-feedback">Longitud vàlida!</div>
                        </div>

                        <div class="col-sm-6">
                            <label for="imatge" class="form-label">Imatge <span class="text-muted">(JPG, JPEG, PNG)</span></label>
                            <input type="file" class="form-control" id="imatge" name="imatge" value="{{ old('imatge', $excursio->imatge) }}" accept=".jpg, .jpeg, .png" required>
                            <div class="invalid-feedback">
                                Cal afegir una imatge vàlida.
                            </div>
                            <div class="valid-feedback">Imatge vàlida!</div>
                        </div>

                        <div class="col-sm-6">
                            <label for="autoritzacio" class="form-label">Autorització <span class="text-muted">(PDF)</span></label>
                            <input type="file" class="form-control" id="autoritzacio" name="autoritzacio" value="{{ old('autoritzacio', $excursio->autoritzacio) }}" accept=".pdf" required>
                            <div class="invalid-feedback">
                                Cal afegir una autorització vàlida.
                            </div>
                            <div class="valid-feedback">Autorització vàlida!</div>
                        </div>

                        <div class="col-sm-12">
                            <label for="descripcio" class="form-label">Descripció</label>
                            <textarea class="form-control" id="descripcio" name="descripcio" rows="16" placeholder="Escriu la descripció de l'excursió" minlength="50" maxlength="2000" required>{{session()->has('descripcio') ? session()->get('descripcio') : old('descripcio', $excursio->descripcio) }}</textarea>
                            <div class="invalid-feedback">
                                Cal afegir una descripció vàlida.
                            </div>
                            <div class="valid-feedback">Descripció vàlida!</div>
                        </div>

                        <hr class="my-4">
            
                        <button class="w-100 btn btn-primary btn-lg" type="submit" id="submit">CREAR EXCURSIÓ</button>
                             
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection

@section('js')
  <script src="/js/excursions/excursioCreate.js"></script>
  <script src="/js/jquery-3.6.0.min.js"></script>
  <script src="/js/jquery-ui.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
@endsection  