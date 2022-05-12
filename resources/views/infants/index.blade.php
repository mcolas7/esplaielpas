@extends('layout')

@section('title', 'Infants')


@section('css')
    <link href="/css/infants/infantIndex.css" rel="stylesheet">
@endsection

@section('content')
<div class="container w-100">
  <div class=" mt-5 w-100 d-flex justify-content-center">
    <div class=" mt-5 w-100">

      @if (session()->has('message'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Perfecte!</strong> {{ session()->get('message')}}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      @forelse ($grups as $grup)
        <div class="table-responsive">
          <table class="table table-bordered table-hover caption-top align-middle">
            <caption><h1 style="color: #6730b0;">{{$grup->nom}}</h1></caption>
            <thead style="background: #ffd81f;">
              <tr>
                <th scope="col" class="col-sm-1">NOM</th>
                <th scope="col" class="col-sm-2">COGNOMS</th>
                <th scope="col" class="col-sm-3">EMAIL</th>
                <th scope="col" class="col-sm-2">TELÈFON</th>
                <th scope="col" class="col-sm-3">AL·LÈRGIA</th>
                <th scope="col" class="col-sm-1" style="text-align: center;">ACCIONS</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($grup->infants as $infant)
              <tr>
                <td>{{$infant->persona->nom}}</td>
                <td>{{$infant->persona->cognoms}}</td>
                <td>{{$infant->persona->email}}</td>
                <td>{{$infant->persona->telefon}}</td>
                <td>{{$infant->infantSalut['alergies'] == 1 ? $infant->infantSalut->alergia :'No'}}</td>
                <td style="text-align: center;">
                  <a href="{{ route('infants.show', $infant->persona) }}" class="show" title="Show" data-toggle="tooltip"><i class="bi bi-eye" style="color: #6730b0;"></i></a>
                  <a href="{{ route('infants.edit', $infant->persona) }}" class="edit" title="Edit" data-toggle="tooltip"><i class="bi bi-pencil" style="color: #6730b0;"></i></a>
                  <a class="delete" title="Delete" data-toggle="tooltip"><i class="bi bi-trash" style="color: #6730b0;"></i></a>
                </td>
              </tr>
              @empty
                <td colspan="7">No hi ha infants en aquest grup!</td>
              @endforelse
            </tbody>
          </table>
        </div>
      @empty
        <p>No hi han grups!</p>
      @endforelse
    </div>
    {{-- @include('partials.session-status')  Per mostrar un missatge conforme s'ha eliminat el projecte, utilizant variables de sessio --}}
    
  {{-- <ul>
    @forelse ($espurnes as $espurna)
        <li><small>{{ $espurna->infant_id }}</small><br> <small> {{ $espurna->persona_id }}</small> <br> {{ $espurna->grup_id }}</li> {{-- Tambe hi ha el metode diffForHumans()
    @empty
        <li>No hay proyectos para mostrar</li>
    @endforelse --}}

    {{-- {{ $projects->links() }}  Per mostrar els botons de paginacio 
   
      </ul> --}}
  </div>
  
  

@auth {{-- Perque es mostri el link de crear un nou projecte nomes si l'usuari esta autenificat --}}
    <a href="{{ route('infants.create') }}">Inscriure infant</a>
@endauth
</div>

    

    
    
@endsection