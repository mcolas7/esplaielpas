@extends('layout')

@section('title', 'Esplai el Pas')

@section('css')
    <link href="/css/style.css" rel="stylesheet">
@endsection
    
@section('content')
    
  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">

    <div class="container" data-aos="zoom-out" data-aos-delay="100">
      <div class="row">
        <div class="col-xl-6">
          <h1 id="titol">Esplai el Pas</h1>
          <h2>La nostra casa és el món, el nostre sostre les estrelles!</h2>
          <a href="{{ route('login') }}" class="btn-get-started scrollto">Iniciar Sessió</a>
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= Clients Section ======= -->
    <section id="clients" class="clients">
      <div class="container text-center" data-aos="zoom-in">
        <div class="embed-responsive embed-responsive-16by9 ">
          <iframe width="560" height="315" src="https://www.youtube.com/embed/6TYNCOT12-U" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>

      </div>
    </section><!-- End Clients Section -->

    <!-- ======= About Section ======= -->
    <section id="about" class="about section-bg">
      <div class="container" data-aos="fade-up">

        <div class="row no-gutters">
          <div class=" col-xl-5 d-flex align-items-stretch">
            <div class="content">
              <h3 class="queesesplai mb-5 pt-0">Què és l'esplai?</h3>
              <p>
                És una associació voluntària sense ànim de lucre que treballa per a l'educació en el lleure d'infants i joves. Està considerada una opció d'educació no formal. Entre les diferents activitats que es poden fer en un esplai, en destaquen les següents:el joc, com a element clau en el desenvolupament personal i interpersonal; el taller; l'excursió, com a descoberta de l'entorn i el medi natural; l'esport; la convivència; la implicació personal; la participació i la presa de responsabilitats en el desenvolupament de l'activitat.
              </p>
              <p>Els centres d'esplai treballen amb la intenció de ser un servei per a la comunitat més propera, amb el consentiment dels pares i mares, i amb l'objectiu de formar infants i joves per aconseguir que creixin com a persones des d'una perspectiva integral que té en compte el compromís social amb l'entorn.</p>
              <a href="vista/nosaltresView.html" class="about-btn"><span>Nosaltres</span> <i class="bx bx-chevron-right"></i></a>
            </div>
          </div>
          <div class="col-xl-7 d-flex align-content-center mt-5 pt-5">
            <img class="img-fluid" src="/img/monitors3.jpg" class="img-fluid">
          </div>
        </div>
      </div>
    </section><!-- End About Section -->

    <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts">
      <div class="container" data-aos="fade-up">

        <div class="row">

          <div class="col-lg-3 col-md-6">
            <div class="count-box">
              <i class="bi bi-emoji-smile"></i>
              <span data-purecounter-start="0" data-purecounter-end="126" data-purecounter-duration="1" class="purecounter"></span>
              <p>Infants</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 mt-5 mt-md-0">
            <div class="count-box">
              <i class="bi bi-house"></i>
              <span data-purecounter-start="0" data-purecounter-end="98" data-purecounter-duration="1" class="purecounter"></span>
              <p>Famílies</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
            <div class="count-box">
              <i class="bi bi-people"></i>
              <span data-purecounter-start="0" data-purecounter-end="23" data-purecounter-duration="1" class="purecounter"></span>
              <p>Monitors</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
            <div class="count-box">
              <i class="bi bi-calendar3"></i>
              <span data-purecounter-start="0" data-purecounter-end="27" data-purecounter-duration="1" class="purecounter"></span>
              <p>Anys</p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Counts Section -->

    <!-- ======= Tabs Section ======= -->
    <section id="tabs" class="tabs">
      <div class="container" data-aos="fade-up">

        <ul class="nav nav-tabs row d-flex">
          <li class="nav-item col-3">
            <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#tab-1">
              <i class="bi bi-sun"></i>
              <h4 class="d-none d-lg-block">Dissabtes</h4>
            </a>
          </li>
          <li class="nav-item col-3">
            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-2">
              <i class="bi bi-house-door"></i>
              <h4 class="d-none d-lg-block">Colònies</h4>
            </a>
          </li>
          <li class="nav-item col-3">
            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-3">
              <i class="bi bi-image-alt"></i>
              <h4 class="d-none d-lg-block">Acampada</h4>
            </a>
          </li>
          <li class="nav-item col-3">
            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-4">
              <i class="bi bi-signpost"></i>
              <h4 class="d-none d-lg-block">Ruta</h4>
            </a>
          </li>
        </ul>

        <div class="tab-content">
          <div class="tab-pane active show" id="tab-1">
            <div class="row">
              <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0" data-aos="fade-up" data-aos-delay="100">
                <h3>Esplai cada dissabte de 16h a 18h!</h3>
                <p>
                  Cada dissabte de 16h a 18h ens trobem totes al local de l'Esplai el Pas per realitzar diferents activitats. Ens dividim en diferents grups per edats els quals cada grup té els seus propis objectius anuals. Els diferents grups de l'Esplai el Pas són:
                </p>
                <ul>
                  <li><i class="bi bi-backspace-reverse-fill"></i> Llobatons: 1r i 2n de primària.</li>
                  <li><i class="bi bi-backspace-reverse"></i> Xiruques: 3r i 4t de primària.</li>
                  <li><i class="bi bi-backspace-reverse-fill"></i> Llampecs: 5è i 6è de primària.</li>
                  <li><i class="bi bi-backspace-reverse"></i> Xarxets: 1r i 2n de l'ESO.</li>
                  <li><i class="bi bi-backspace-reverse-fill"></i> Marmotes: 3r i 4t de l'ESO.</li>
                </ul>
              </div>
              <div class="col-lg-6 order-1 order-lg-2 text-center" data-aos="fade-up" data-aos-delay="200">
                <img src="/img/dissabtes.jpg" alt="" class="img-fluid">
              </div>
            </div>
          </div>
          <div class="tab-pane" id="tab-2">
            <div class="row">
              <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0">
                <h3>El primer i el tercer trimestre l'esplai marxa de colònies!</h3>
                <p>
                  Dos cops a l'any l'esplai marxa de ruta (el primer i el tercer trimestre). Marxem a una casa de colònies i realitzem diferents activitats durant tot el cap de setmana. Els grups de l'esplai que marxen de colònies són:
                </p>
                <ul>
                  <li><i class="bi bi-backspace-reverse-fill"></i> Llobatons: 1r i 2n de primària.</li>
                  <li><i class="bi bi-backspace-reverse"></i> Xiruques: 3r i 4t de primària.</li>
                  <li><i class="bi bi-backspace-reverse-fill"></i> Llampecs: 5è i 6è de primària.</li>
                  <li><i class="bi bi-backspace-reverse"></i> Xarxets: 1r i 2n de l'ESO.</li>
                  <li><i class="bi bi-backspace-reverse-fill"></i> Marmotes: 3r i 4t de l'ESO.</li>
                </ul>
              </div>
              <div class="col-lg-6 order-1 order-lg-2 text-center">
                <img src="/img/colonies.jpg" alt="" class="img-fluid">
              </div>
            </div>
          </div>
          <div class="tab-pane" id="tab-3">
            <div class="row">
              <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0">
                <h3>Cada setmana santa marxem d'acampada!</h3>
                <p>
                  Per setmana santa l'Esplai el Pas marxa 5 dies d'acampada a la muntanya. En aquest 5 dies desconectem del nostre dia a dia, de la tecnologia i aprofitem per realitzar excursions i coneixer millor l'entron que ens rodeja. Aprendre de la naturalesa i aprendre a respectar-la. Els grups de l'esplai que marxen d'acampada són:
                </p>
                <ul>
                  <li><i class="bi bi-backspace-reverse-fill"></i> Llampecs: 5è i 6è de primària.</li>
                  <li><i class="bi bi-backspace-reverse"></i> Xarxets: 1r i 2n de l'ESO.</li>
                  <li><i class="bi bi-backspace-reverse-fill"></i> Marmotes: 3r i 4t de l'ESO.</li>
                </ul>
              </div>
              <div class="col-lg-6 order-1 order-lg-2 text-center">
                <img src="/img/acampada2.jpg" alt="" class="img-fluid">
              </div>
            </div>
          </div>
          <div class="tab-pane" id="tab-4">
            <div class="row">
              <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0">
                <h3>A l'estiu marxem de ruta!</h3>
                <p>
                  Els grups més grans de l'esplai a l'estiu marxen de ruta. Normalment marxen una setmana a diferents llocs d'Espanya. L'Esplai el Pas ha estat de ruta al pais basc, menorca, mallorca, pirineus, delta del ebre, etc... Els grups que marxen de ruta són:
                </p>
                <ul>
                  <li><i class="bi bi-backspace-reverse"></i> Xarxets: 1r i 2n de l'ESO.</li>
                  <li><i class="bi bi-backspace-reverse-fill"></i> Marmotes: 3r i 4t de l'ESO.</li>
                </ul>
              </div>
              <div class="col-lg-6 order-1 order-lg-2 text-center">
                <img src="/img/ruta.jpg" alt="" class="img-fluid">
              </div>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End Tabs Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2 id="ideari">Ideari</h2>
          <p class="mt-5 pt-5">L’Esplai el Pas és una entitat de Palafolls que treballa mitjançant l’educació en el lleure amb infants i joves. La nostra raó de ser neix a partir de les ganes de participar conjuntament de l’acció al lleure i promoure uns valors que ens siguin d’utilitat a les nostres vides. Per fer-ho, les monitores ens regim d’un ideari que anem renovant segons les necessitats socials i de les participants. L’ideari és el conjunt de valors que sustenten la nostra tasca educativa i ens identifiquen com a esplai. A partir de les idees que s’hi desenvolupen, duem a terme les nostres activitats i projectes. D’una manera breu, és la forma de pensar de la nostra entitat. </p><br>
          <p>En primer lloc, cal indicar que som un esplai laic i progressista, que treballa respectant i defensant la Convenció dels Drets dels Infants. L’eina principal de la nostra educació és el joc, el mitjà per transmetre i aprendre els valors de l’ideari. A part de cada dissabte a la tarda, les nostres activitats extraordinàries com ara colònies, acampades, rutes i sortides, són també estratègies per a desenvolupar-nos en el lleure. </p>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
              <i class="bi bi-chat-dots"></i>
              <h4>Participació</h4>
              <p>Considerem que a l’esplai es crea un espai on infants i joves poden participar, opinar i compartir des de les múltiples modalitats.</p>
            </div>
          </div>
          <div class="col-md-6 mt-4 mt-md-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
              <i class="bi bi-lightbulb"></i>
              <h4>Esperit crític</h4>
              <p>L’esplai és un espai on aprenem a qüestionar-nos allò que ens envolta, enriquint-nos del que ens aporta per a transformar allò que no ens agrada.</p>
            </div>
          </div>
          <div class="col-md-6 mt-4 mt-md-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="300">
              <i class="bi bi-emoji-smile"></i>
              <h4>Respecte i empatia</h4>
              <p>A la fi de buscar una societat inclusiva, des de l’esplai eduquem per a la no discriminació a cap persona. Eduquem als infants i joves per rebutjar els prejudicis i mostrar respecte cap a altres cultures, opinions i persones.</p>
            </div>
          </div>
          <div class="col-md-6 mt-4 mt-md-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="400">
              <i class="bi bi-activity"></i>
              <h4>Salut</h4>
              <p>Promovem hàbits saludables en alimentació, higiene, descans i activitat física per tal de portar una vida sana. Aprofitem tots els factors que influeixen, com els aliments de temporada, el clima i l'entorn en el qual vivim.</p>
            </div>
          </div>
          <div class="col-md-6 mt-4 mt-md-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="500">
              <i class="bi bi-gender-female"></i>
              <h4>Feminisme</h4>
              <p>A l’esplai som conscient de la desigualtat de gènere existent a la nostra societat i és per això que lluitem per erradicar-la. </p>
            </div>
          </div>
          <div class="col-md-6 mt-4 mt-md-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="600">
              <i class="bi bi-tree"></i>
              <h4>Respecte per la natura</h4>
              <p>La natura és un bé preuat, ens ofereix experiències úniques i podem aprendre molt d’ella.</p>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End Services Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Contacta'ns</h2>
          <p>Si tens qualsevol dubte o vols apuntar-te a l'Esplai el Pas no dubtis en enviar-nos un missatge!</p>
        </div>

        <div class="row" data-aos="fade-up" data-aos-delay="100">

          <div class="col-lg-6">

            <div class="row">
              <div class="col-md-12">
                <div class="info-box">
                  <i class="bx bx-map"></i>
                  <h3>Adreça</h3>
                  <p>Carrer Francesc Macià, 08389 Palafolls, Barcelona</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="info-box mt-4">
                  <i class="bx bx-envelope"></i>
                  <h3>Correu electrònic</h3>
                  <p>esplaielpas@gmail.com</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="info-box mt-4">
                  <i class="bx bx-phone-call"></i>
                  <h3>Telèfon</h3>
                  <p>666 66 66 66</p>
                </div>
              </div>
            </div>

          </div>

          <div class="col-lg-6">
            @if (session('status'))

              {{ session('status' )}}
    
            @endif
            <form method="POST" action="{{ route('home.contact') }}" role="form" class="php-email-form">
              @csrf
              <div class="row">
                <div class="col form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Escriu el teu nom" value="{{ old('name') }}">
                  {!! $errors->first('name', '<small>:message</small><br>') !!}
                </div>
                <div class="col form-group">
                  <input type="text" class="form-control" name="email" id="email" placeholder="Escriu el teu email" value="{{ old('email') }}">
                  {!! $errors->first('email', '<small>:message</small><br>') !!}
                </div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Escriu un títol" value="{{ old('subject') }}">
                {!! $errors->first('subject', '<small>:message</small><br>') !!}
              </div>
              <div class="form-group">
                <textarea class="form-control" name="message" rows="8" placeholder="Escriu el teu missatge">{{ old('message') }}</textarea>
                {!! $errors->first('message', '<small>:message</small><br>') !!}
              </div>
              <div class="my-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div>
              <div class="text-center"><button type="submit">Enviar missatge</button></div>
            </form>
          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  @include('partials.footer')

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  
  <script src="/js/main.js"></script>

@endsection