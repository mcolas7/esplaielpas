@extends('layout')

@section('title', 'Editar infant')

@section('css')
    <link href="/css/infants/infantEdit.css" rel="stylesheet">
@endsection

@section('content')


<div class="page-wrapper bg-gra-03 p-t-100 p-b-50">
    <div class="wrapper wrapper--w790">
        <div class="card card-5">
            <div class="card-heading">
                <h2 class="title">{{$persona['nom']}} {{$persona['cognoms']}}</h2>
            </div>
            <div class="card-body">

              @if (session()->has('message'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> {{ session()->get('message')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              @endif
              
              {{-- @if ($errors->any())
                @foreach ($errors->all() as $error)
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> {{ $error }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endforeach
              @endif --}}

                <form>

                    <div class="row g-3">
                        <div class="col-sm-6">
                          <label for="nom" class="form-label">Nom</label>
                          <input type="text" class="form-control" id="nom" name="nom" placeholder="Escriu el nom" value="{{ old('nom', $persona->nom) }}" maxlength="20" readonly>
                        </div>
            
                        <div class="col-sm-6">
                          <label for="cognoms" class="form-label">Cognoms</label>
                          <input type="text" class="form-control" id="cognoms" name="cognoms" placeholder="Escriu el cognom" value="{{ old('cognoms' , $persona->cognoms) }}" maxlength="40" readonly>
                        </div>

                        <div class="col-12">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Escriu el email" value="{{ old('email', $persona->email) }}" maxlength="50" readonly>
                          </div>
              
            
                        <div class="col-12">
                          <label for="telefon" class="form-label">Telèfon</label>
                          <div class="input-group has-validation">
                            <input type="tel" class="form-control" id="telefon" name="telefon" placeholder="Escriu el telèfon" value="{{ old('telefon', $persona->telefon) }}" minlength="9" maxlength="9" pattern="[0-9]{9}" readonly>
                          </div>
                        </div>

                        <div class="col-12">
                            <label for="data_naixement" class="form-label">Data naixement</label>
                            <div class="input-group has-validation">
                              <input type="date" class="form-control" id="data_naixement" name="data_naixement" value="{{ old('data_naixement', $persona->data_naixement) }}" readonly>
                            </div>
                        </div>

                        <div class="col-md-6">
                          <label for="curs" class="form-label">Curs</label>
                          <select class="form-select" id="curs" name="curs" disabled>
                            <option value="{{ $persona->infant->curs_id }}" selected>{{ $persona->infant->curs->nom }}</option>
                          </select>
                        </div>
            
                        <div class="col-md-6">
                          <label for="grup" class="form-label">Grup</label>
                          <select class="form-select" id="grup" name="grup" disabled>
                            <option value="{{ $persona->infant->grup_id }}" selected>{{ $persona->infant->grup->nom }}</option>
                          </select>
                        </div>
            

                        <div class="col-12">
                          <label for="targeta_sanitaria" class="form-label">Targeta sanitària</label>
                          <input type="text" class="form-control" id="targeta_sanitaria" name="targeta_sanitaria" placeholder="Escriu els 14 dígits de la targeta sanitària" value="{{ old('targeta_sanitaria', $persona->targeta_sanitaria) }}" minlength="14" maxlength="14" pattern="[A-Z]{4}[0-9]{10}" readonly>
                      </div>
                        
                        <div class="col-12">
                          <label for="carrer" class="form-label">Adreça</label>
                          <input type="text" class="form-control" id="carrer" name="carrer" placeholder="Escriu l'adreça" value="{{ old('carrer', $persona->carrer) }}" maxlength="50" readonly>
                        </div>
            
                        
            
                        <div class="col-md-8">
                          <label for="poblacio_id" class="form-label">Població</label>
                          <select class="form-select" id="poblacio_id" name="poblacio_id" disabled>
                            <option value="{{ $persona->poblacio_id }}" selected>{{ $persona->poblacio->nom }}</option>
                          </select>
                        </div>
            
                        <div class="col-md-4">
                          <label for="codi_postal" class="form-label">Codi postal</label>
                          <input type="text" class="form-control" id="codi_postal" name="codi_postal" placeholder="Escriu el codi postal" value="{{ old('codi_postal', $persona->codi_postal) }}" minlength="5" maxlength="5" pattern="[0-9]{5}" readonly>
                        </div>

                        <div class="col-12">
                            <label for="dni" class="form-label">DNI <span class="text-muted">(Opcional)</span></label>
                            <input type="text" class="form-control" id="dni" name="dni" placeholder="Escriu el DNI" value="{{ old('dni', $persona->dni) }}" minlength="9" maxlength="9" pattern="[0-9]{8}[A-Z]{1}" readonly>
                        </div>
                      </div>
            
                      <hr class="my-4">
            
                      <h4 class="mb-3" id="titolAlergia">Al·lèrgia</h4>
            
                      <div class="col-md-4 my-3">
                        <select class="form-select" id="alergies" name="alergies" disabled>
                          <option value="{{$persona->infant->infantSalut->alergies}}" selected>{{old('alergies', $persona->infant->infantSalut->alergies) == 1 ? 'Sí' : 'No' }}</option>
                        </select>
                      </div>
            
                      <div class="col-12" id="divAlergia">
                        <label for="alergia" class="form-label">Explicació al·lèrgia</label>
                        <textarea type="text" class="form-control" id="alergia" name="alergia" placeholder="Explica les al·lèrgies de l'infant" rows="4" readonly>{{ old('alergia', $persona->infant->infantSalut->alergia) }}</textarea>
                      </div>

                      <hr class="my-4">
            
                        <a class="w-100 btn btn-primary btn-lg" href="{{ route('infants.index')}}" id="botoBack">TORNAR LLISTAT INFANTS</a>
                    </div> 
                </form>
            </div>
        </div>
    </div>
</div>


@endsection

@section('js')
<script src="/js/infantEdit.js"></script> 
@endsection