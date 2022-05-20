@extends('layout')

@section('title', 'Excursions')

@section('css')
    <link href="{{asset('/css/excursions.css')}}" rel="stylesheet">
@endsection

@section('content')
<div class="container w-100 border-1 mt-5">
    <div class="container mt-5 w-100 border-3">
        <section class="hero-section mt-5">
            <div class="card-grid">

              @forelse ($excursions as $excursio)
                <a class="card" href="{{ route('excursions.show', $excursio) }}">
                  <div class="card__background" style="background-image: url(/storage/{{$excursio->imatge}}"></div>
                  <div class="card__content">
                    {{-- <p class="card__category">{{$excursio->preu . "€"}}</p> --}}
                    <h3 class="card__heading">{{$excursio->nom}}</h3>
                  </div>
                </a>
              @empty
                <h2>No hi han excursions</h2>
              @endforelse

            <div>
          </section>
    </div>
</div>

@include('partials.footer')
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