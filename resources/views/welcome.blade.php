<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Buzzword</title>

        <!-- Fonts -->
        <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ secure_asset('css/vue-material.min.css') }}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <script>
          window.data = <?php echo json_encode([
                'offers' => $offers,
            ]); ?>
        </script>
    </head>
    <body>
        <div id="app" class="flex-center position-ref full-height">
            <crawler-nav></crawler-nav>
            <crawler-sidepanel :history="$store.state.history"></crawler-sidepanel>
            <crawler-input></crawler-input>
            <div class="analytics--container">
                <crawler-analytics v-if="$store.state.classifications.length > 0" :data="$store.state.classifications"></crawler-analytics>
                <job-offer-preview :offers="$store.state.offers"></job-offer-preview>
            </div>
        </div>
    </body>
    <script src="{{ secure_asset('js/app.js') }}"></script>
</html>
