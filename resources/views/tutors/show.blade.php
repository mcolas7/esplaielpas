@extends('layout')

@section('title', 'Mostrar tutor')

@section('css')
  <link href="{{asset('/css/tutors/tutorEdit.css')}}" rel="stylesheet">
@endsection

@section('content')


<div class="page-wrapper bg-gra-03 p-t-100 p-b-50">
    <div class="wrapper wrapper--w790">
        <div class="card card-5">

            <div class="card-heading">
              <h2 class="title">{{$persona['nom'] . " " . $persona['cognoms']}}</h2>
            </div>

            

            <div class="card-body">

                <div class="row">
                  <div class="col-6" style="text-align: start">
                    <a class="w-50 btn btn-primary btn-lg" href="{{ route('tutors.edit', $persona)}}" id="botoEditar">EDITAR</a>
                  </div>
                  <div class="col-6" style="text-align: end">
                    <form action="{{route('tutors.destroy', $persona)}}" method="POST" class="d-inline formulariEliminar">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-danger btn-lg w-50 border-2">ELIMINAR</button>
                    </form>
                  </div>
                </div>


              <form>
                <div class="row g-3">
                  <div class="row g-3">
                    <div class="col-sm-6">
                      <label for="nom" class="form-label">Nom</label>
                      <input type="text" class="form-control" id="nom" name="nom" placeholder="Escriu el nom" value="{{ old('nom', $persona->nom) }}" maxlength="20" readonly>
                    </div>
              
                    <div class="col-sm-6">
                      <label for="cognoms" class="form-label">Cognoms</label>
                      <input type="text" class="form-control" id="cognoms" name="cognoms" placeholder="Escriu els cognoms" value="{{ old('cognoms' , $persona->cognoms) }}" maxlength="40" readonly>
                    </div>
  
                    <div class="col-12">
                      <label for="email" class="form-label">Email</label>
                      <input type="email" class="form-control" id="email" name="email" placeholder="Escriu el email" value="{{ old('email', $persona->email) }}" maxlength="50" readonly>
                    </div>
              
              
                    <div class="col-12">
                      <label for="telefon" class="form-label">Telèfon</label>
                      <input type="tel" class="form-control" id="telefon" name="telefon" placeholder="Escriu el telèfon" value="{{ old('telefon', $persona->telefon) }}" minlength="9" maxlength="9" pattern="[0-9]{9}" readonly>
                    </div>

                    <div class="col-12">
                      <label for="dni" class="form-label">DNI</label>
                      <input type="text" class="form-control" id="dni" name="dni" placeholder="Escriu el DNI" value="{{ old('dni', $persona->dni) }}" minlength="9" maxlength="9" pattern="[0-9]{8}[A-Z]{1}" readonly>
                    </div>
  
                    <div class="col-12">
                        <label for="data_naixement" class="form-label">Data naixement</label>
                        <input type="date" class="form-control" id="data_naixement" name="data_naixement" value="{{ old('data_naixement', $persona->data_naixement) }}" readonly>
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
                  </div>

                    <hr class="my-4">
            
                    <a class="w-100 btn btn-primary btn-lg" href="{{ route('infants.index')}}" id="botoBack">TORNAR LLISTAT INFANTS</a>
                        
                    </div>      
                  </div>
              </form>
            </div>
  </div>
</div>



@endsection

@section('js')
  <script src="{{asset('/js/tutors/tutorCreate.js')}}"></script>

  <script>
    $('.formulariEliminar').submit(function(e) {
      e.preventDefault();

      Swal.fire({
      title: 'Estàs segur que vols eliminar aquest tutor?',
      text: "Aquest tutor s'eliminarà definitivament!",
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
@endsection  