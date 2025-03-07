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

          $totalNote = $student->pivot->noteKa + $student->pivot->noteKihon + $student->pivot->noteKumite;
          $verdict = $totalNote / 3;



   }

@endphp


    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bulletin-examen</title>
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
        th, .verdict{
            background-color: #e3dcd4;
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
        <img src="{{ public_path('img/logo-center.png') }}" alt="logo">
        <p style="font-family: Montserrat; font-size: 16px; color:#3d3b3a;">BULLETIN DE NOTES</p>
        <p>Document proposé par Kata</p>
    </div>
</header>


<main>
    <section class="clubinfos">
        <p style="font-weight: bold"> {{isset($student) ? 'Bulletin N° : '.$student->id.$event_id : "303"}}</p>

        {{isset($club) ?  $club->name : 'Nom du club'}}
        <br> {{isset($club) ? $club->email : 'example@gmail.com'}}
        <br> {{isset($club) ? $club->address : 'Cotonou, rue 122'}}
    </section>


    <section class="studentInfos">
        <p style="font-weight: bold">{{'Délivré à : '}}</p>
        {{isset($student) ? $student->firstName.' '.$student->lastName : ' John Doe '}}
        <br> {{date('d M. Y')}}
    </section>

    <section class="objet">
        <strong>Objet :</strong> Résultat de l’examen de
        <strong>{{isset($grade) ? ' la ceinture '. $grade->beltName : 'passage de niveau'}}</strong>
    </section>

    {{--<section class="salutation">
        @if(isset($student))
            {{($student->genre == 'Homme') ? 'Monsieur '.$student->lastName.',' : 'Madame '.$student->lastName.','}}
        @else
            Monsieur/Madame,
        @endif
    </section>
--}}
    <section class="plaintext">

        Nous avons le plaisir de vous informer que les résultats de
        l'examen  <strong>{{isset($grade) ? 'de la ceinture '. $grade->beltName : ' de passage de niveau'}}</strong>,
        qui s'est tenu le {{isset($event) ? $event->startDate->format('d M. Y') : '1 er janvier 2025'}} sont désormais
        disponibles.
        Vous trouverez ci-joint votre bulletin de résultats détaillé.

    </section>


    <section class="bindingData">
        <table>
            <tr>
                <th>Matières</th>
                <th>KATA</th>
                <th>KIHON</th>
                <th>KUMITE</th>
                <th>TOTAL</th>
            </tr>
            <tr>
                <td>Notes</td>
                <td>{{isset($student) ? $student->pivot->noteKata : '12'}}</td>
                <td>{{isset($student) ? $student->pivot->noteKihon : '12'}}</td>
                <td>{{isset($student) ? $student->pivot->noteKumite : '12'}}</td>
                <td>{{isset($student) ?
                    ($student->pivot->noteKata + $student->pivot->noteKihon + $student->pivot->noteKumite)
                    : '36'}}</td>

            </tr>

            <tr class="verdict">
                <td>Verdict</td>
                <td  colspan="5">{{isset($verdict) && $verdict >= 10 ? 'Succès' : 'Échec' }}</td>
            </tr>



        </table>

    </section>


    <section class="rules">
        Nous vous remercions pour vos efforts et votre engagement, et nous vous souhaitons beaucoup de succès
        pour la suite de votre parcours.
    </section>
    <section class="breakaleg">
        Pour toute question concernant votre bulletin ou vos résultats, n’hésitez pas à nous contacter.
    </section>

    <section class="agreement">
        <br>

        Sportivement, <br>
        L'équipe {{isset($club) ?  $club->name : 'Nom du club'}}
    </section>

    <section style="text-align:end;" class="signature">
        Signature
        <br>
        <img src="{{ public_path('img/signature.png') }}" alt="signature">


    </section>

</main>

</body>
</html>
