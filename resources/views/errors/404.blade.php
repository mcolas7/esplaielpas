<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Error 404</title>
    <meta name="description" content="Pagina web de l'Esplai el Pas de Palafolls">
    <meta name="keywords" content="Esplai, Pas, Catalunya, Lleure">
    <meta name="author" content="Manel Colàs Casals">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

      <!-- Favicons -->
      <link href="{{asset('/img/fliki2.png')}}" rel="icon">
      <link href="{{asset('/img/fliki2.png')}}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <style>
        #botoInici {
            background: #6730b0;
            border: none;
        }

        #botoInici:hover {
            background: #3c235e;
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh">
        <div class="row">
            <div class="col-md-6">
                <img class="img-fluid" src="{{ asset('/img/fliki2.png')}}" alt="Fliki">
            </div>
            <div class="col-md-6" style="color: #6730b0;">
                <h1>Error 404</h1>
                <p>La pàgina que busques no està disponible...</p>
                <a class="btn btn-primary" id="botoInici" href="{{ route('home')}}">TORNAR A L'INICI</a>
            </div>
        </div>
    </div>
</body>
</html>