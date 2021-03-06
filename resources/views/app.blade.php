<!DOCTYPE Html>
<Html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="description" content="">
    <meta name="author" content="">
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    <title>EMPLUS</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- icon-->
    <link rel="icon" href="{{asset('images/favicon.png')}}" sizes="16x16">
    <link rel="icon" href="{{asset('images/favicon.png')}}" sizes="32x32">
    <link rel="apple-touch-icon" href="{{asset('images/favicon.png')}}"/>
    <link rel="apple-touch-icon" href="{{asset('images/favicon.png')}}" sizes="76x76" />
    <link rel="apple-touch-icon" href="{{asset('images/favicon.png')}}" sizes="120x120" />
    <link rel="apple-touch-icon" href="{{asset('images/favicon.png')}}" sizes="152x152" />
    <link rel="apple-touch-icon" href="{{asset('images/favicon.png')}}" sizes="180x180" />

    <!-- Global stylesheets -->
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
    <!-- /global stylesheets -->

    <!-- Core JS files -->

    <!-- /core JS files -->

    <!-- Theme JS files -->

    <!-- /Theme JS files -->

    <!-- Html5 Shim and Respond.js IE8 support of Html5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/Html5shiv/3.7.0/Html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

    <div id="app"></div>

    <!-- load vue -->
    <script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>
    
</body>
</Html>
