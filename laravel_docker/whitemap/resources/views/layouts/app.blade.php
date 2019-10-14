<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="異世界漂流TRPG ドリフトサヴァイブはサバイバルをして文明を築き上げるTRPGです。" />
    <meta name="keywords" content="Laravel,laradock,gcp" />
    <meta name="robots" content="index" />
    @yield('meta')
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>
    @yield('css')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('head-scripts')
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-PBSJTDV');</script>
    <!-- End Google Tag Manager -->
  </head>
  <body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PBSJTDV" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <div class="navbar-header">
                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <!-- Navbar Left -->
                <div class="collapse navbar-collapse justify-content-start" id="navbarSupportedContentLeft">
                </div>
                <!-- Navbar Right -->
                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContentRight">
                    @guest
                        <ul class="nav navbar-nav navbar-right">
                            <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">ログイン</a></li>
                        </ul>
                    @else
                        <div class="user-icon"><img src="{{\Auth::user()->twitter_profile_image_url_https}}"></div>
                    @endguest
                </div>
            </div>
        </nav>
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ mix('js/common/app.js') }}"></script>
    @yield('scripts')
  </body>
</html>
