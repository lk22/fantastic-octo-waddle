<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="_token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'Notifier') }} || {{ auth()->user()->name }}</title>

<!-- Styles -->
<link href="/css/app.css" rel="stylesheet">
<link rel="stylesheet" href="/css/font-awesome.min.css">

<!-- Scripts -->
<script>
    window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>

    <?php

        $default_js_variables = array(
            'csrf' => csrf_token(),
            'url' => Config::get("app.url"),
            'current_url' => request()->url(),
            'auth' => array(
                'id' => auth()->user()->id,
                'name' => auth()->user()->name,
                'email' => auth()->user()->email,
                'active' => auth()->user()->active,
            ),
            'host' => request()->getHost(),
            'environment' => app()->environment()
        );

        $js_variables = array_merge($default_js_variables, (isset($js_variables)) ? $js_variables : []);

        echo 'var Notifier = ' . json_encode($js_variables) . ';';

    ?>

    console.log(Notifier);
</script>
<!-- tinyMCE text editor -->
<script src='https://cdn.tinymce.com/4/tinymce.min.js'></script>