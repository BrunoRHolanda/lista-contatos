<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-wf-page="5c93fc19fef8ecc04632209d"
      data-wf-site="5c93fc19fef8ec2d1132209c">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}}">
    <title>Super-PRÓ</title>
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta content="Webflow" name="generator">

    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" type="text/javascript"></script>
    <script type="text/javascript">WebFont.load({google: {families: ["Heebo:100,300,regular,500,700,800,900"]}});</script>
    <!-- [if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"
            type="text/javascript"></script>
    <![endif] -->
    <script type="text/javascript">
        !function (o, c) {
            let n = c.documentElement, t = " w-mod-";
            n.className += t + "js", ("ontouchstart" in o || o.DocumentTouch && c instanceof DocumentTouch) && (n.className += t + "touch")
        }(window, document);
    </script>

    <link href="{{ asset('images/Favicon32x32.png' )}}" rel="shortcut icon" type="image/x-icon">
    <link href="{{ asset('images/Favicon256x256.png') }}" rel="apple-touch-icon">
    <link href="{{ asset('css/normalize.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/webflow.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/super-pro.webflow.css') }}" rel="stylesheet" type="text/css">

</head>
<body class="body-2">
<div id="app"></div>
<script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
