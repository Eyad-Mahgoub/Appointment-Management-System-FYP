<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <style>
            body {
                height: 5in;
                width: 7in;
            }
            .pdf-mid {
                width: 80%;
                padding: 4rem;
                margin: auto;
                background-color: rgba(241, 241, 241, 0.8);
                border-radius: 18px;
                color: #003059;
                height: 8in;
            }
            .line-dark-50 {
                width: 50%;
                border: 2px solid #003059;
                border-radius: 6px;
            }

            .line-dark-25 {
                width: 25%;
                border: 2px solid #003059;
                border-radius: 6px;
            }
            .bg-blue {
                background-color: #003059;
            }
        </style>

        {{-- BootStrap CSS CDN --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

        <title></title>
    </head>
    <body class="bg-blue">
        <main>
            <div class="pdf-mid mt-5 justif-content-start">
                <h1 class="">Perscription</h1>
                <div class="line-dark-25 mb-5"></div>

                <h5><b>Appointment No:</b> {{ $app->id }}</h5>
                <h5><b>DateTime:</b> {{ $app->date }}, {{ $app->time }}</h5>
                <h5 class="mb-5"><b>Doctor:</b> {{ $app->doctor->name }}</h5>

                <h2 class="mt-5">Perscription</h2>
                <?php $i = 1 ?>
                @foreach ($app->perscriptions as $pers)
                <p> {{ $i }} - {{ $pers->medicine->name }}: {{ $pers->dosage }}</p>
                <?php $i+=1 ?>
                @endforeach

            </div>
        </main>
    </body>
</html>
