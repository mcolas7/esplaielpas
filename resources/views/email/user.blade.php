<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registre usuari</title>
</head>
<body>
    <h2><strong>Bones {{ $persona['nom'] }}!</strong></h2>
    <p>Acabes de ser registrat a la pàgina web de l'esplai!</p>
    <p>Els teus fills/es són:</p>
    <ul>
        @forelse ($persona->tutor->infants as $infant)
            <li>{{$infant->persona->nom}}  {{$infant->persona->cognoms}}</li>
        @empty
            <li>No tens cap infant registrat!</li>
        @endforelse
    </ul>
    
    <p>El teu usuari i la teva contrasenya són:</p>
    <p><strong>DNI: </strong>{{ $persona['dni'] }}</p>
    <p><strong>Contrasenya: </strong>{{ $password }}</p>

    <p>Inicia sessió a la pàgina web de l'esplai!</p>
    <a>www.esplaielpas.cat</a>

    <p>Moltes gràcies!</p>
    <p>Equip de monitores de l'Esplai el Pas.</p>
</body>
</html>