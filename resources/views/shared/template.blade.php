<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="google-site-verification" content="pFU9lFcidHQOZDsoAlefOEwUqon4F2PSIviv27SJslk" />
        <meta name="description" content="@yield('description')">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="canonical" href="{{ url()->current() }}"/>

        <title>{{ config('app.name') }} - @yield('title')</title>

        <link href="{{ asset('css/app.css') . '?v=' . filemtime(public_path('css/app.css')) }}" rel="stylesheet" type="text/css">
        @yield('head')

        <script data-ad-client="ca-pub-4650782712352720" defer src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <link href="https://www.google-analytics.com" rel="dns-prefetch preconnect" crossorigin>
        <script defer src="https://www.googletagmanager.com/gtag/js?id=UA-156333900-1"></script>
        <script type="text/javascript">
            (function () {
                window.dataLayer = window.dataLayer || [];

                function gtag() {
                    dataLayer.push(arguments);
                }

                gtag('js', new Date());

                gtag('config', 'UA-156333900-1');
            })();
        </script>

        <script type="text/javascript">
            (function () {
                let css = document.createElement('link');
                css.href = 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css';
                css.rel = 'stylesheet';
                css.type = 'text/css';
                document.getElementsByTagName('head')[0].appendChild(css);
            })();
        </script>

    </head>
    <body id="page-top" class="sidebar-toggled">
        <div id="overlay"></div>
        @include('shared.navbar')

        <div id="wrapper">
            @include('shared.sidenav')
            <div id="content-wrapper">
                <div class="container-fluid">
                    @include('shared.navbar.mobile-search')
                    <div class="mb-2">
                        @include('shared.message')
                    </div>
                    @yield('content')
                </div>
            </div>
        </div>

        @include('shared.footer')

        @if(env('SENTRY_LARAVEL_DSN'))
            <script src="https://browser.sentry-cdn.com/5.7.1/bundle.min.js"></script>
            <script>
                (function () {
                    Sentry.init({dsn: '{{ env('SENTRY_LARAVEL_DSN') }}'})
                })();
            </script>
        @endif
        <script type="text/javascript" defer src="{{ asset('js/app.js') . '?v=' . filemtime(public_path('js/app.js')) }}"></script>
        @yield('footer')
    </body>
</html>
