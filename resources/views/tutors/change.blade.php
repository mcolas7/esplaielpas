@extends('layout')

@section('title', 'Canviar contrasenya')

@section('css')
    <link href="{{asset('/css/excursions/excursioCreate.css')}}" rel="stylesheet">
@endsection

@section('content')

<div class="page-wrapper bg-gra-03 p-t-100 p-b-50">
    <div class="wrapper wrapper--w790">
        <div class="card card-5">
            <div class="card-heading">
                <h2 class="title">Canviar contrasenya</h2>
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

                <form method="POST" action="{{ route('tutors.changePassword') }}" class="needs-validation" novalidate>
                    @csrf

                    <div class="row g-3">
                        <div class="col-12">
                            <label for="password" class="form-label">Nova contrasenya</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Escriu la nova contrasenya" value="{{ old('password2') }}" maxlength="20" required>
                            <div class="invalid-feedback">
                              Cal afegir una contrasenya vàlida.
                            </div>
                            <div class="valid-feedback">Contrasenya vàlida!</div>
                        </div>
              
            
                        <div class="col-12">
                          <label for="password_confirmation" class="form-label">Repetir la nova contrasenya</label>
                          <div class="input-group has-validation">
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Repeteix la nova contrasenya" value="{{ old('password_confirmation') }}"  maxlength="20" required>
                            <div class="invalid-feedback">
                              Cal afegir una contrasenya vàlida.
                            </div>
                            <div class="valid-feedback">Contrasenya vàlida!</div>
                          </div>
                        </div>
            
                      <hr class="my-4">
            
                      <button class="w-100 btn btn-primary btn-lg" type="submit" id="submit">CANVIAR CONTRASENYA</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection

@section('js')
  <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function () {
        'use strict'
      
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')
      
        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
          .forEach(function (form) {
            form.addEventListener('submit', function (event) {
              if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
              }
      
              form.classList.add('was-validated')
            }, false)
          })
    })()
  </script>
@endsection  