@extends('layout')

@section('title', 'Inscriure tutor')

@section('css')
    <link href="{{asset('/css/tutors/tutorCreate.css')}}" rel="stylesheet">
@endsection

@section('content')


<div class="page-wrapper bg-gra-03 p-t-100 p-b-50">
    <div class="wrapper wrapper--w790">
        <div class="card card-5">
            <div class="card-heading">
                <h2 class="title">Inscriure tutor de {{$infant['nom'] . " " . $infant['cognoms']}}</h2>
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

                <form method="POST" action="{{ route('tutors.store', $infant) }}" class="needs-validation mt-2" id="formulariTutor" novalidate>
                    @csrf

                    <div class="row g-3">

                      <div class="col-12">
                        <label for="dni" class="form-label">DNI</label>
                        <input type="text" class="form-control" id="dni" name="dni" placeholder="Escriu el DNI" value="{{ old('dni', $persona->dni) }}" minlength="9" maxlength="9" pattern="[0-9]{8}[A-Z]{1}" required>
                        <div class="invalid-feedback">
                            Cal afegir una DNI vàlid.
                          </div>
                          <div class="valid-feedback">DNI vàlid!</div>
                      </div>

                      <div class="container" id="inputsCrearTutor">
                        
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
                        </div>

                        <hr class="my-4">
            
                        <button class="w-100 btn btn-primary btn-lg" type="submit" id="submit">INSCRIURE TUTOR</button>
                        
                      </div>   
                      @if (session('statusTutor') == 'ok')
                      <div class="container">
                        <hr class="my-4">
                        <a class="btn btn-primary w-100" href="{{ route('infants.index') }}" style="background: #6730b0; border: 2px solid #6730b0;">TORNAR A INFANTS</a>
                      </div>
                      @endif        
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection

@section('js')
  <script src="{{asset('/js/tutors/tutorCreate.js')}}"></script>
  <script src="{{asset('/js/jquery-3.6.0.min.js')}}"></script>
  <script src="{{asset('/js/jquery-ui.min.js')}}"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> 

  @if (session('statusInfant') == 'ok')
    <script>
    Swal.fire(
      "Perfecte!",
      "Infant inscrit amb èxit!",
      "success")
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
    $(document).ready(function(){
      $('input[name="dni"]').keyup(function () {
        if($('input[name="dni"]').val().length === 9) {
          $.ajax({
          url: '{{ route("tutors.existeix") }}',
          method: 'POST',
          dataType: 'json',
          data: {
            _token: $('input[name="_token"]').val(),
            dni: $('input[name="dni"]').val()
          }
          }).done(function (res) {

            if (res.length > 0) {

              $('#inputsCrearTutor').removeAttr('hidden');
              $('input[name="nom"]').val(res[0].nom).attr('readonly', '');
              $('input[name="cognoms"]').val(res[0].cognoms).attr('readonly', '');
              $('input[name="email"]').val(res[0].email).attr('readonly', '');
              $('input[name="telefon"]').val(res[0].telefon).attr('readonly', '');
              $('input[name="data_naixement"]').val(res[0].data_naixement).attr('readonly', '');
              $('input[name="carrer"]').val(res[0].carrer).attr('readonly', '');
              $("#poblacio_id option[value="+ res[0].poblacio_id +"]").attr("selected",true);
              $("#poblacio_id").attr('disabled','');
              $('input[name="codi_postal"]').val(res[0].codi_postal).attr('readonly', '');

            } else {

              $('#inputsCrearTutor').removeAttr('hidden');
            }
          });

        } else {

          $('#inputsCrearTutor').attr('hidden', '');
          $('input[name="nom"]').val('').removeAttr('readonly');
          $('input[name="cognoms"]').val('').removeAttr('readonly');
          $('input[name="email"]').val('').removeAttr('readonly');
          $('input[name="telefon"]').val('').removeAttr('readonly');
          $('input[name="data_naixement"]').val('').removeAttr('readonly');
          $('input[name="carrer"]').val('').removeAttr('readonly');
          $("#poblacio_id").removeAttr('disabled');
          $("#poblacio_id option:selected").removeAttr("selected");
          $('input[name="codi_postal"]').val('').removeAttr('readonly');
        }
      });
    });
  </script>
@endsection  