<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
        <link rel="icon" type="image/png" href="../assets/img/favicon.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>
            Paper Dashboard 2 by Creative Tim
        </title>
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/dashboard/style.css') }}" rel="stylesheet" type="text/css">
    </head>

    <body>
        <div class="wrapper">
            @include('dashboard.shared.sidenav')
            <div class="main-panel">
                @yield('content')
            </div>
        </div>
        <script src="https://browser.sentry-cdn.com/5.7.1/bundle.min.js" integrity="sha384-KMv6bBTABABhv0NI+rVWly6PIRvdippFEgjpKyxUcpEmDWZTkDOiueL5xW+cztZZ" crossorigin="anonymous"></script>
        <script> Sentry.init({ dsn:  '{{ env('SENTRY_LARAVEL_DSN') }}' });</script>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js" defer></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
        <script type="text/javascript" src="{{ asset('js/dashboard/script.js') }}" defer></script>

    </body>

</html>
