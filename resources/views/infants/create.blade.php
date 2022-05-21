@extends('layout')

@section('title', 'Inscriure infant')

@section('css')
  <link href="{{asset('/css/infants/infantCreate.css')}}" rel="stylesheet">
@endsection

@section('content')


<div class="page-wrapper bg-gra-03 p-t-100 p-b-50">
    <div class="wrapper wrapper--w790">
        <div class="card card-5">
            <div class="card-heading">
                <h2 class="title">Inscriure un infant</h2>
            </div>
            <div class="card-body">

              {{-- @if (session()->has('message'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> {{ session()->get('message')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              @endif --}}
              
              @if ($errors->any())
                @foreach ($errors->all() as $error)
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> {{ $error }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endforeach
              @endif

                <form method="POST" action="{{ route('infants.store') }}" class="needs-validation" novalidate>
                    @csrf

                    <div class="row g-3">
                        <div class="col-sm-6">
                          <label for="nom" class="form-label">Nom</label>
                          <input type="text" class="form-control" id="nom" name="nom" placeholder="Escriu el nom" value="{{ old('nom', $persona->nom) }}" maxlength="20" required>
                          <div class="invalid-feedback">
                            Cal afegir un nom vàlid.
                          </div>
                          <div class="valid-feedback">Nom vàlid!</div>
                        </div>
            
                        <div class="col-sm-6">
                          <label for="cognoms" class="form-label">Cognoms</label>
                          <input type="text" class="form-control" id="cognoms" name="cognoms" placeholder="Escriu els cognoms" value="{{ old('cognoms' , $persona->cognoms) }}" maxlength="40" required>
                          <div class="invalid-feedback">
                            Cal afegir uns cognoms vàlids.
                          </div>
                          <div class="valid-feedback">Cognoms vàlid!</div>
                        </div>

                        <div class="col-12">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Escriu el email" value="{{ old('email', $persona->email) }}" maxlength="50" required>
                            <div class="invalid-feedback">
                              Cal afegir un email vàlid.
                            </div>
                            <div class="valid-feedback">Email vàlid!</div>
                        </div>
              
            
                        <div class="col-12">
                          <label for="telefon" class="form-label">Telèfon</label>
                          <div class="input-group has-validation">
                            <input type="tel" class="form-control" id="telefon" name="telefon" placeholder="Escriu el telèfon" value="{{ old('telefon', $persona->telefon) }}" minlength="9" maxlength="9" pattern="[0-9]{9}" required>
                            <div class="invalid-feedback">
                              Cal afegir un telèfon vàlid.
                            </div>
                            <div class="valid-feedback">Telèfon vàlid!</div>
                          </div>
                        </div>

                        <div class="col-12">
                            <label for="data_naixement" class="form-label">Data naixement</label>
                            <div class="input-group has-validation">
                              <input type="date" class="form-control" id="data_naixement" name="data_naixement" value="{{ old('data_naixement', $persona->data_naixement) }}" required>
                              <div class="invalid-feedback">
                                Cal afegir una data de naixement vàlida.
                              </div>
                              <div class="valid-feedback">Data de naixement vàlida!</div>
                            </div>
                        </div>

                        <div class="col-md-6">
                          <label for="curs" class="form-label">Curs</label>
                          <select class="form-select" id="curs" name="curs" required>
                            <option value="">Escollir...</option>
                            @forelse ($cursos as $curs)
                                <option value="{{ $curs->curs_id }}" {{old('curs') == $curs->curs_id ? 'selected' : '' }}>{{ $curs->nom }}</option>
                            @empty
                                <option>No hi ha grups</option>
                            @endforelse
                          </select>
                          <div class="invalid-feedback">
                            Cal afegir un curs vàlid.
                          </div>
                          <div class="valid-feedback">Curs vàlid!</div>
                        </div>
            
                        <div class="col-md-6">
                          <label for="grup" class="form-label">Grup</label>
                          <select class="form-select" id="grup" name="grup" required>
                            <option value="">Escollir...</option>
                            @forelse ($grups as $grup)
                                <option value="{{ $grup->grup_id }}" {{old('grup') == $grup->grup_id ? 'selected' : '' }}>{{ $grup->nom }}</option>
                            @empty
                                <option>No hi ha grups!</option>
                            @endforelse
                          </select>
                          <div class="invalid-feedback">
                            Cal afegir un grup vàlid.
                          </div>
                          <div class="valid-feedback">Grup vàlid!</div>
                        </div>
            

                        <div class="col-12">
                          <label for="targeta_sanitaria" class="form-label">Targeta sanitària</label>
                          <input type="text" class="form-control" id="targeta_sanitaria" name="targeta_sanitaria" placeholder="Escriu els 14 dígits de la targeta sanitària" value="{{ old('targeta_sanitaria', $persona->targeta_sanitaria) }}" minlength="14" maxlength="14" pattern="[A-Z]{4}[0-9]{10}" required>
                          <div class="invalid-feedback">
                            Cal afegir una targeta sanitària vàlida.
                          </div>
                          <div class="valid-feedback">Targeta sanitària vàlida!</div>
                      </div>
                        
                        <div class="col-12">
                          <label for="carrer" class="form-label">Adreça</label>
                          <input type="text" class="form-control" id="carrer" name="carrer" placeholder="Escriu l'adreça" value="{{ old('carrer', $persona->carrer) }}" maxlength="50" required>
                          <div class="invalid-feedback">
                            Cal afegir una adreça vàlida.
                          </div>
                          <div class="valid-feedback">Adreça vàlida!</div>
                        </div>
            
                        
            
                        <div class="col-md-8">
                          <label for="poblacio_id" class="form-label">Població</label>
                          <select class="form-select" id="poblacio_id" name="poblacio_id" required>
                            <option value="">Escollir...</option>
                            @forelse ($poblacions as $poblacio)
                                <option value="{{ $poblacio->poblacio_id }}" {{old('poblacio') == $poblacio->poblacio_id ? 'selected' : '' }}>{{ $poblacio->nom }}</option>
                            @empty
                                <option>No hi ha poblacions</option>
                            @endforelse
                          </select>
                          <div class="invalid-feedback">
                            Cal afegir una població vàlida.
                          </div>
                          <div class="valid-feedback">Població vàlida!</div>
                        </div>
            
                        <div class="col-md-4">
                          <label for="codi_postal" class="form-label">Codi postal</label>
                          <input type="text" class="form-control" id="codi_postal" name="codi_postal" placeholder="Escriu el codi postal" value="{{ old('codi_postal', $persona->codi_postal) }}" minlength="5" maxlength="5" pattern="[0-9]{5}" required>
                          <div class="invalid-feedback">
                            Cal afegir un codi postal vàlid.
                          </div>
                          <div class="valid-feedback">Codi postal vàlid!</div>
                        </div>

                        <div class="col-12">
                            <label for="dni" class="form-label">DNI <span class="text-muted">(Opcional)</span></label>
                            <input type="text" class="form-control" id="dni" name="dni" placeholder="Escriu el DNI" value="{{ old('dni', $persona->dni) }}" minlength="9" maxlength="9" pattern="[0-9]{8}[A-Z]{1}">
                        </div>
                      </div>
            
                      <hr class="my-4">
            
                      <h4 class="mb-3" id="titolAlergia">Al·lèrgia</h4>
            
                      <div class="col-md-4 my-3">
                        <select class="form-select" id="alergies" name="alergies" required>
                          <option value="1" {{old('alergies') == 1 ? 'selected' : '' }}>Sí</option>
                          <option value="0" {{old('alergies') == 0 ? 'selected' : '' }}>No</option>
                        </select>
                        <div class="invalid-feedback">
                          Cal especificar sí o no.
                        </div>
                        <div class="valid-feedback">Vàlid!</div>
                      </div>
            
                      <div class="col-12" id="divAlergia">
                        <label for="alergia" class="form-label">Explicació al·lèrgia</label>
                        <textarea type="text" class="form-control" id="alergia" name="alergia" placeholder="Explica les al·lèrgies de l'infant" rows="4">{{ old('alergia', '') }}</textarea>
                        <div class="invalid-feedback">
                          Cal especificar les al·lèrgies de l'infant.
                        </div>
                        <div class="valid-feedback">Vàlid!</div>
                      </div>
                      
            
                      <hr class="my-4">
                    
                     
            

                      {{-- @if ($errors->any())
                        <ul>
                            @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                      @endif --}}
            
                      <button class="w-100 btn btn-primary btn-lg" type="submit" id="submit">INSCRIURE INFANT</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection

@section('js')
  <script src="{{asset('/js/infants/infantCreate.js')}}"></script>
@endsection