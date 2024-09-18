@php

    use App\Models\Event;use App\Models\Exam;use App\Models\Exam_results;use App\Models\Grade;use App\Models\User;use Illuminate\Support\Facades\Log;

   if(isset($user_id) && isset($event_id)){


          $event = Event::find($event_id);

          $student = $event->examResults()->wherePivot('student_id', $user_id)->first();

          Log::info($student->id);
          $gradeId = $student->pivot->grade_id;

          $grade = $event->grades()->wherePivot('grade_id', $gradeId)->first();
          $cost = $grade->pivot->cost;

          $club = $student->clubs()->first();

   }

@endphp


    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Convocation-examen</title>
    <style>


        body {

            padding: 20px;
            margin: 0 auto;
            box-sizing: border-box;
            font-family: Arial;
            font-size: 12pt;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        header {
            font-family: Arial;
            font-size: 10pt;
            width: 100%;
            text-align: center;

        }

        img {
            max-height: 40px;
            width: 156px;
        }

        .clubinfos, .studentInfos {
            width: 100%;

        }

        .clubinfos {
            margin-top: 100px;

        }

        .studentInfos {
            margin-top: 20px;

            text-align: right;
        }

        section {
            margin-top: 10px;
        }


        .bindingData {
            margin-top: 25px;
            margin-bottom: 30px;
        }

        .signature {
            margin-top: 30px;
        }

        .objet {
            margin-top: 50px;
        }


    </style>
</head>
<body>

<header>
    <div>
        <img src="{{ public_path('img/logo.png') }}" alt="logo">
        <p>Document proposé par Kata</p>
    </div>
</header>


<main>
    <section class="clubinfos">
        {{isset($club) ?  $club->name : 'Nom du club'}} <br> {{isset($club) ? $club->address : 'Cotonou, rue 122'}}
        <br> {{isset($club) ? $club->email : 'example@gmail.com'}}
    </section>
    <section class="studentInfos">
        {{isset($student) ? $student->firstName.' '.$student->lastName : ' John Doe '}}
        <br> {{isset($student) ? $student->email : 'student@gmail.com' }} <br> {{date('d M Y')}}
    </section>

    <section class="objet">
        <strong>Objet :</strong> Convocation à l’examen de
        <strong>{{isset($grade) ? 'la ceinture '. $grade->beltName : 'passage de niveau'}}</strong>
    </section>

    <section class="salutation">
        @if(isset($student))
            {{($student->genre == 'Homme') ? 'Monsieur '.$student->lastName.',' : 'Madame '.$student->lastName.','}}
        @else
            Monsieur/Madame,
        @endif
    </section>

    <section class="plaintext">
        Nous avons le plaisir de vous informer que vous êtes convoqué(e) à l'examen
        <strong>{{isset($grade) ? 'de la ceinture '. $grade->beltName : ' de passage de niveau'}}</strong>,
        dont les détails sont contenues ci-dessous :
    </section>


    <section class="bindingData">
        <table>
            <tr>
                <th scope="row">Date</th>
                <td>{{isset($event) ? $event->startDate->format('d M Y') : '1 er janvier 2025'}}</td>
            </tr>

            <tr>
                <th scope="row">Heure de début</th>
                <td>{{isset($event) ? $event->startDate->format('H:m') : '14h 00' }}</td>
            </tr>

            <tr>
                <th scope="row">Lieu</th>
                <td>{{isset($event) ? $event->address : 'Blue zone, Cotonou' }}</td>
            </tr>

            <tr>
                <th scope="row">Montant</th>
                <td>{{isset($cost) ? $cost : '4500 ' }} Francs CFA</td>
            </tr>
        </table>

    </section>


    <section class="rules">
        Nous vous prions de vous munir d'une pièce d'identité en cours de validité, ainsi que de votre convocation.
    </section>
    <section class="breakaleg">
        Nous vous souhaitons bonne chance pour cet examen.
    </section>

    <section class="agreement">
        Veuillez agréer, Monsieur / Madame, nos salutations distinguées.
    </section>

    <section class="signature">
        Signature
    </section>

</main>

</body>
</html>
