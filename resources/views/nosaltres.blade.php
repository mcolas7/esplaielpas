@extends('layout')

@section('title', 'Nosaltres')

@section('css')
  <link href="{{asset('/css/nosaltress.css')}}" rel="stylesheet">
@endsection

@section('content')
<main id="main">

    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="{{asset('/img/nosaltres/colonies3.jpg')}}" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="{{asset('/img/nosaltres/esplai3.jpg')}}" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="{{asset('/img/nosaltres/acampada.jpg')}}" class="d-block w-100" alt="...">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Esplai el Pas</h2>
          <p>És una associació voluntària sense ànim de lucre que treballa per a l'educació en el lleure d'infants i joves. Està considerada una opció d'educació no formal. Entre les diferents activitats que es poden fer en un esplai, en destaquen les següents:el joc, com a element clau en el desenvolupament personal i interpersonal; el taller; l'excursió, com a descoberta de l'entorn i el medi natural; l'esport; la convivència; la implicació personal; la participació i la presa de responsabilitats en el desenvolupament de l'activitat.</p><br>
          <p>Els centres d'esplai treballen amb la intenció de ser un servei per a la comunitat més propera, amb el consentiment dels pares i mares, i amb l'objectiu de formar infants i joves per aconseguir que creixin com a persones des d'una perspectiva integral que té en compte el compromís social amb l'entorn.</p>
        </div>

        <div class="row">
          <div class="col-lg-4">
            <img src="{{asset('/img/nosaltres.jpg')}}" class="img-fluid" alt="">
          </div>
          <div class="col-lg-8 pt-4 pt-lg-0 content">
            <h3>Història</h3>
            <p style="text-align: justify">
              L'esplai el Pas neix a Palafolls el 1994 amb la idea de trobar un lloc en el que infants i joves es puguin retrobar per realitzar accions significatives. Apareix quan un grup de joves voluntàries decideix crear un espai fora de l'escola on educar als infants de forma didàctica, és a dir, mitjançant jocs i dinàmiques que fan que l'aprenentatge sigui visual i emocional. Es forma així una associació amb l'únic objectiu de compartir i donar un cop de mà en el desenvolupament d'infants i joves.
            </p>
            <p style="text-align: justify">
              Des de llavors fins ara han passat per l'esplai milers d'infants i molts s'han convertit en monitors que també han crescut i han après dels més petits. A dia d'avui ja hi ha vells monitors que porten els seus fills a l'esplai com ells havien anat quan eren petits. Per tant, és una entitat que mai para de renovar-se i adaptar-se als nous temps recollint, però, tot els aprenentatges que s'han adquirit en aquests anys que fa que l'esplai es va fundar.
            </p>
            <p>Encara ens queden molts anys per viure!</p>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Llobatons ======= -->
    <section id="testimonials" class="testimonials section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title-foulard">
          <h2>Llobatons</h2>
          <p>Nosaltres som els més petits de l’Esplai el Pas: fem 1r i 2n de primària! A l’Esplai aprenem mitjançant el joc i això ens permet créixer i aprendre valors d’una manera molt diferent a la que estem acostumats. Fixa’t quins monitors i monitores que tenim!</p>
        </div>

        <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
          <div class="swiper-wrapper">

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="{{asset('/img/monitores/helena.jpg')}}" class="testimonial-img" alt="">
                <h3>Helena Nualart</h3>
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  Bones! Sóc l’Helena, monitora de Llobatons/es. M’agrada llegir al solet, escriure i la música. Ah… i passar els dissabte a la tarda amb la gent bonica de l’Esplai
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="{{asset('/img/monitores/polGuerra.jpg')}}" class="testimonial-img" alt="">
                <h3>Pol Guerra</h3>
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  Sóc monitor de l'esplai perquè com a infant vaig aprendre uns valors que crec que són fonamentals i ara sóc jo el qui vol transmetre aquests valors
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="{{asset('/img/monitores/claudiaValles3.jpg')}}" class="testimonial-img" alt="">
                <h3>Clàudia Valles</h3>
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  Soc la Clàudia tinc 20 anys i soc monitora de l'esplai el pas des de fa 3 anys. Estudio educació infantil i primària i, en un futur, vull ser mestra. En el meu temps lliure m'agrada llegir, la música i la dansa
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="{{asset('/img/monitores/nora.jpg')}}" class="testimonial-img" alt="">
                <h3>Nora</h3>
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  M'agrada tant la naturalesa i els animals que estudio Biologia. M'agrada molt passar el meu temps lliure amb els meus amics, sempre anem de ruta o fem acampada, és molt divertit
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->

          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>
    </section><!-- End Testimonials Section -->

    <!-- ======= Xiruques ======= -->
    <section id="testimonials" class="testimonials">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Xiruques</h2>
          <p>Nosaltres som les xiruques: fem 3r i 4t de primària! A l’Esplai comencem a ser conscients del nostre entorn i de nosaltres mateixes. Com bé indica el nostre nom, amb les xiruques posades cada dissabte fem passes de gegants! Fixa’t quins monitors i monitores que tenim!</p>
        </div>

        <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
          <div class="swiper-wrapper">

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="{{asset('/img/monitores/ivan.jpeg')}}" class="testimonial-img" alt="">
                <h3>Ivan Martinez</h3>
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  M’agrada molt ensenyar els meus valors i del esplai d’una manera divertida. M’agrada molt la natura i els animals!
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="{{asset('/img/monitores/elisenda.jpg')}}" class="testimonial-img" alt="">
                <h3>Elisenda de la Iglesia</h3>
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid cillum eram malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet legam anim culpa.
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="{{asset('/img/monitores/marEscudero.jpg')}}" class="testimonial-img" alt="">
                <h3>Mar Escudero</h3>
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  El que mes m'agrada fer en el meu temps lliure es anar a l'esplai, ja que em fa sentir viva i m'encanta aprendre coses cada dia. M'agraden per igual el mar i la muntanya? Anem junts d'excursio?
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="{{asset('/img/monitores/nil.jpeg')}}" class="testimonial-img" alt="">
                <h3>Nil Bayarri</h3>
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim fugiat minim velit minim dolor enim duis veniam ipsum anim magna sunt elit fore quem dolore labore illum veniam.
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="{{asset('/img/monitores/sandraVela.jpg')}}" class="testimonial-img" alt="">
                <h3>Sandra Vela</h3>
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  M'agrada molt transemtre als meus infants els valors i les idees que hem van ensenyar els meus monitors quan era infant, d'aquesta manera s'anirà transmetren de generació en generació i la màgia de l'Esplai el Pas no es perdrà mai
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->

          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>
    </section><!-- End Testimonials Section -->

    <!-- ======= Llampecs ======= -->
    <section id="testimonials" class="testimonials section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title-foulard">
          <h2>Llampecs</h2>
          <p>Nosaltres som els llampecs: fem 5è i 6è de primària! Els jocs que fem a l’Esplai són més complexos i diversos. A més, comencem a fer dinàmiques que ens permeten desenvolupar l’esperit crític! Fixa’t quins monitors i monitores que tenim!</p>
        </div>

        <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
          <div class="swiper-wrapper">

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="{{asset('/img/monitores/marta.jpeg')}}" class="testimonial-img" alt="">
                <h3>Marta Fontseca</h3>
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  Estudio biologia i m'apassiona la natura. M'agrada explicar històries, llegir llibres i compartir les estones amb qui em fa riure
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="{{asset('/img/monitores/eudald.jpg')}}" class="testimonial-img" alt="">
                <h3>Eudald Nualart</h3>
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  Em dic Eudald Nualart, tinc 20 anys i actualment estic estudiant un Cicle Superior de Mecatrònica Industrial. Durant el meu temps lliure m'agrada fer esport, estar amb la família i amb els amics i escoltar música entre altres
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="{{asset('/img/monitores/juliaSoler.jpg')}}" class="testimonial-img" alt="">
                <h3>Júlia Soler</h3>
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem veniam duis minim tempor labore quem eram duis noster aute amet eram fore quis sint minim.
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="{{asset('img/monitores/pauRibes.jpg')}}" class="testimonial-img" alt="">
                <h3>Pau Ribas</h3>
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  Sóc en Pau Ribas Silva, sóc monitor de l’Esplai el Pas del grup de Llampecs i en el meu temps lliure m’encanta tocar la bateria!
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->

          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>
    </section><!-- End Testimonials Section -->

    <!-- ======= Xarxets ======= -->
    <section id="testimonials" class="testimonials">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Xarxets</h2>
          <p>Nosaltres som els xarxets: fem 1r i 2n d’ESO! L’Esplai ens ajuda a desenvolupar la nostra persona i, a més, ens mostra que un món millor és possible. Som conscients que nosaltres som el futur i que som aquí per actuar. Fixa’t quins monitors i monitores que tenim!</p>
        </div>

        <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
          <div class="swiper-wrapper">

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="{{asset('/img/monitores/victor.jpg')}}" class="testimonial-img" alt="">
                <h3>Víctor Comino</h3>
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                    Hola, sóc en Víctor, un noi de Palafolls de tota la vida a qui li apasiona la música i l'escalada
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="{{asset('/img/monitores/juliaRibes.jpg')}}" class="testimonial-img" alt="">
                <h3>Júlia Ribas</h3>
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  L’esplai ha format sempre part de la meva vida. Ara com a monitora vull educar en tots els valors que a mi m’han transmès des de l’esplai i  seguir-nos divertint com sempre ho hem fet: envoltats d’amics i amigues i de natura!
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="{{asset('/img/monitores/ines.jpg')}}" class="testimonial-img" alt="">
                <h3>Inés Mendez</h3>
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  Soc riallera i alegre. M'agrada llegir, fer esport i la música. Quan estic envoltada de bosc em sento lliure!
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->

          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>
    </section><!-- End Testimonials Section -->

    <!-- ======= Marmotes ======= -->
    <section id="testimonials" class="testimonials section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title-foulard">
          <h2>Marmotes</h2>
          <p>Nosaltres som les marmotes: fem 3r i 4t d’ESO! L’Esplai ens ensenya que la diversitat sempre és positiva i que la nostra societat és millor si tots som tal i com volem ser. A més, treballem valors i coneixements que ens ajuden a enfocar el nostre futur. Fixa’t quins monitors i monitores que tenim!</p>
        </div>

        <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
          <div class="swiper-wrapper">

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="{{asset('/img/monitores/nicole.jpg')}}" class="testimonial-img" alt="">
                <h3>Nicole Castillejo</h3>
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  Sóc monitora a l’Esplai el Pas, on poc opinar lliurament i ser jo mateixa. En el meu temps lliure m’agrada llegir i anar a la muntanya d’excursió.
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="{{asset('/img/monitores/xenia.jpg')}}" class="testimonial-img" alt="">
                <h3>Xènia Freixa</h3>
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  Em dic Xènia i sóc una persona molt tranquil·la, organitzada i riallera! M'encanta llegir, mirar fotos i fer pastissos, i sóc massa feliç quan surt el sol!
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="{{asset('/img/monitores/laia.jpg')}}" class="testimonial-img" alt="">
                <h3>Laia Roura</h3>
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem veniam duis minim tempor labore quem eram duis noster aute amet eram fore quis sint minim.
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="{{asset('/img/monitores/maria.jpg')}}" class="testimonial-img" alt="">
                <h3>Maria Carrasco</h3>
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  Em dic Maria, sóc monitora de marmotes, i entre altres coses, m'agrada jugar a jocs de taula i tastar diferents formatges!
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->

          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>
    </section><!-- End Testimonials Section -->

    <!-- ======= Espurnes ======= -->
    <section id="testimonials" class="testimonials">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Espurnes</h2>
          <p>Nosaltres som les espurnes, som les més grans de l’Esplai: fem 1r i 2n de Batxillerat! L’Esplai ens ensenya que no només ens hem de conèixer a nosaltres mateixes, sinó que formem part d’una societat que ens necessita. Som el futur! Fixa’t quins monitors i monitores que tenim!</p>
        </div>

        <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
          <div class="swiper-wrapper">

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="{{asset('/img/monitores/alvaroArador.jpg')}}" class="testimonial-img" alt="">
                <h3>Álvaro Arador</h3>
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                    M'agrada venir al esplai perquè és un espai on puc compartir amb els infants i les companyes els meus interessos i experiències. En el meu temps lliure m'agrada trastejar amb les meves abelles!
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="{{asset('/img/monitores/pauJambou.jpg')}}" class="testimonial-img" alt="">
                <h3>Pau Jambou</h3>
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                    Sóc amant de la natura i l'esport. En el meu temps lliure m'agrada passar-lo on em sento lliure, al mar o a les muntanyes. Visca l'esplai!
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="{{asset('/img/monitores/iker.jpg')}}" class="testimonial-img" alt="">
                <h3>Iker Guerrero</h3>
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  Sóc monitor desde fa 4 anys , vaig començar en el grup de marmotes i vaig descobrir que el medi natural m’agradava molt , tant la platja com la montanya, en els meus ratos lliures si no estic sobre una moto estic en algun lloc perdut , sempre el meu pla ha sigut que no tinc pla
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="{{asset('/img/monitores/dani2.jpg')}}" class="testimonial-img" alt="">
                <h3>Dani</h3>
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  Hola em dic Dani i sóc un noi amb molta energia, que li encanta la natura i el senderisme
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->

          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>
    </section><!-- End Testimonials Section -->

  </main><!-- End #main -->
  @include('partials.footer')

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  
@endsection

@section('js')
  <script src="{{asset('/js/nosaltress.js')}}"></script>  
@endsection