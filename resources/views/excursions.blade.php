@extends('layout')

@section('title', 'Excursions')

@section('css')
    <link href="/css/excursions.css" rel="stylesheet">
@endsection

@section('content')
<div class="container w-100 border-1 mt-5">
    <div class="container mt-5 w-100 border-3">
        <section class="hero-section mt-5">
            <div class="card-grid">
              <a class="card" href="#">
                <div class="card__background" style="background-image: url(../img/infantsCreate.jpg)"></div>
                <div class="card__content">
                  <p class="card__category">Llampecs, Xarxets, Marmotes</p>
                  <h3 class="card__heading">COLÒNIES</h3>
                </div>
              </a>
              <a class="card" href="#">
                <div class="card__background" style="background-image: url(https://images.unsplash.com/photo-1537905569824-f89f14cceb68?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1902&q=80)"></div>
                <div class="card__content">
                  <p class="card__category">Category</p>
                  <h3 class="card__heading">ACAMPADA</h3>
                </div>
              </a>
              <a class="card" href="#">
                <div class="card__background" style="background-image: url(https://images.unsplash.com/photo-1627893363364-e698505bb6b4?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=435&q=80)"></div>
                <div class="card__content">
                  <p class="card__category">Category</p>
                  <h3 class="card__heading">RUTA</h3>
                </div>
              </li>
              <a class="card" href="#">
                <div class="card__background" style="background-image: url(../img/infantsCreate2.jpg)"></div>
                <div class="card__content">
                  <p class="card__category">Category</p>
                  <h3 class="card__heading">EXCURSIÓ</h3>
                </div>
              </a>
            <div>
          </section>
    </div>
</div>
@endsection

@section('js')

@endsection