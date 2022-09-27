<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- dynamic meta - Nir - Apex Division -->
    <title>{{ \App\Http\Controllers\SeoManagementController::getMetaTitle(Request::path(), 'meta_title') ?: "Flipkart's Fleet of Gamers" }}</title>
    <meta name="keywords" content="{{ \App\Http\Controllers\SeoManagementController::getMetaTitle(Request::path(), 'meta_keywords') ?: "Flipkart's Fleet of Gamers" }}">
    <meta name="description" content="{{ \App\Http\Controllers\SeoManagementController::getMetaTitle(Request::path(), 'meta_description') ?: "Flipkart's Fleet of Gamers" }}">


    <!-- Bootstrap CSS Bla -->
    <link rel="stylesheet" type="text/css"
          href="{!! asset('letsgamenow/css/bootstrap.min.css')!!}?ver={{ filemtime(public_path('letsgamenow/css/bootstrap.min.css')) }}">
    <link rel="stylesheet" type="text/css"
          href="{!! asset('letsgamenow/css/carouselTicker.css')!!}?ver={{ filemtime(public_path('letsgamenow/css/carouselTicker.css')) }}">
    <link rel="stylesheet" type="text/css"
          href="{!! asset('letsgamenow/css/slick.css')!!}?ver={{ filemtime(public_path('letsgamenow/css/slick.css')) }}">
    <link rel="stylesheet" type="text/css"
          href="{!! asset('letsgamenow/css/fixture.css')!!}?ver={{ filemtime(public_path('letsgamenow/css/fixture.css')) }}">
    <link rel="stylesheet" type="text/css"
          href="{!! asset('letsgamenow/css/slick-theme.css')!!}?ver={{ filemtime(public_path('letsgamenow/css/slick-theme.css')) }}">
    <link rel="stylesheet" type="text/css"
          href="{!! asset('letsgamenow/css/style.css')!!}?ver={{ filemtime(public_path('letsgamenow/css/style.css')) }}">
    <link rel="stylesheet" type="text/css"
          href="{!! asset('letsgamenow/css/responsive.css')!!}?ver={{ filemtime(public_path('letsgamenow/css/responsive.css')) }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css?">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">

    <link rel="stylesheet" type="text/css"
          href="{!! asset('flipkart/css/flipkart.css')!!}?ver={{ filemtime(public_path('flipkart/css/flipkart.css')) }}">


    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-166913419-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'UA-166913419-1');
        gtag('config', 'G-J8D9W5HTWK');

        // for FK
        gtag('config', 'G-SV068W5Z0D');
    </script>


    <!-- Google Tag Manager -->
    <script>(function (w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start':
                    new Date().getTime(), event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-NLTDLR9');</script>
    <!-- End Google Tag Manager -->
</head>