@php

   use App\Models\Transaction;
   use App\Models\User;

   if(isset($transaction_id)){
            $transaction= Transaction::findOrFail($transaction_id);
            $reference = $transaction->reference;
            $montant = $transaction->cost;
            $motif = $transaction->payment->fee->name;
            $date_payment = $transaction->created_at->format('d M. Y');
            $student = User::findOrFail($transaction->payer_id);
            $club = $student->clubs()->first();
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

        th, .verdict {
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
        <p style="font-family: Montserrat; font-size: 16px; color:#3d3b3a;">FACTURE DE PAIEMENT</p>
        <p>Document proposé par Kata</p>
    </div>
</header>


<main>
    <section class="clubinfos">
        <p style="font-weight: bold"> {{isset($reference) ? 'Facture N° : '.$reference :'Facture N° : '. "303"}}</p>

        {{isset($club) ?  $club->name : 'Nom du club'}}
        <br> {{isset($club) ? $club->email : 'example@gmail.com'}}
        <br> {{isset($club) ? $club->address : 'Cotonou, rue 122'}}
    </section>


    <section class="studentInfos">
        <p style="font-weight: bold">{{'Délivré à : '}}</p>
        {{isset($student) ? $student->firstName.' '.$student->lastName : ' John Doe '}}
        <br> {{date('d M. Y')}}
    </section>

    {{-- <section class="objet">
         <strong>Objet :</strong> Récépissé de
         <strong>{{isset($grade) ? ' la ceinture '. $grade->beltName : 'passage de niveau'}}</strong>
     </section>--}}

    <section class="salutation">
        @if(isset($student))
            {{($student->genre == 'Homme') ? 'Monsieur '.$student->lastName.',' : 'Madame '.$student->lastName.','}}
        @else
            Monsieur/Madame,
        @endif
    </section>
    <section class="plaintext">

        Veuillez retrouver ci-dessous les détails de votre paiement.

    </section>


    <section class="bindingData">
        <table>
            <tr>
                <th colspan="2" style="text-align: center">FACTURE</th>

            </tr>
            <tr>
                <td>Référence</td>
                <td>{{isset($reference) ? strtoupper($reference) : 'No ref'}}</td>
            </tr>

            <tr>
                <td>Motif</td>
                <td>{{isset($motif) ? strtoupper($motif) : 'No motif'}}</td>
            </tr>


            <tr>
                <td>Montant</td>
                <td>{{isset($montant) ? $montant.' XOF' : '154 XOF'}}</td>
            </tr>

            <tr>
                <td>Date de paiement</td>
                <td>{{isset($date_payment) ? $date_payment: 'Never'}}</td>
            </tr>

        </table>

    </section>


    <section class="rules">

    </section>
    <section class="breakaleg">
        Pour toute question concernant votre faturation, n’hésitez pas à nous contacter.
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
