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
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="{{ mix('js/common/app.js') }}"></script>
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
                @guest
                @else
                    <a class="navbar-brand user-icon" href="{{ url('/') }}"><i class="user-icon"><img src="{{\Auth::user()->twitter_profile_image_url_https}}"></i></a>
                @endguest
            <!-- <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a> -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item {{str_replace(url('/'),'',url()->current()) === '/'     ? 'active' : ''}}"><a class="nav-link" href="{{ url('/') }}">トップ</span></a></li>
                    <li class="nav-item {{str_replace(url('/'),'',url()->current()) === '/home' ? 'active' : ''}}"><a class="nav-link" href="{{ url('/home') }}">マイページ</span></a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        サイト情報
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/agreement">利用規約</a>
                            <a class="dropdown-item" href="/privacy-policy">プライバシーポリシー</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="https://github.com/hibohiboo/whitemap">github</a>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="my-2 my-lg-0">
                @guest
                    <ul class="nav navbar-nav navbar-right">
                        <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">ログイン</a></li>
                    </ul>
                @else
                @endguest
            </div>
        </nav>
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.15/lodash.min.js" integrity="sha256-VeNaFBVDhoX3H+gJ37DpT/nTuZTdjYro9yBruHjVmoQ=" crossorigin="anonymous"></script>
    @yield('scripts')
  </body>
</html>
