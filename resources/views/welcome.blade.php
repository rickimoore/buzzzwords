<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" href="/image/logo/favicon-buzz.ico">
        <title>Buzzword</title>

        <!-- Fonts -->
        <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ secure_asset('css/vue-material.min.css') }}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-126398826-1"></script>
        <script>
          window.data = <?php echo json_encode([
                'offers' => $offers,
            ]); ?>

            window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'UA-126398826-1');
        </script>

    </head>
    <body>
        <div id="app" class="flex-center position-ref full-height">
            <crawler-nav></crawler-nav>
            <crawler-sidepanel :state="$store.state.isSidePanelActive" :history="$store.state.history"></crawler-sidepanel>
            <crawler-input :tut-priority="$store.state.isActiveModal"></crawler-input>
            <div v-if="$store.state.classifications.length > 0 || $store.state.offers && $store.state.offers.length > 0" class="buzz--container">
                <crawler-analytics v-if="$store.state.classifications.length > 0"  :data="$store.state.classifications"></crawler-analytics>
                <job-offer-preview v-if="$store.state.offers.length > 0" :offers="$store.state.offers"></job-offer-preview>
            </div>
            <job-offer-modal :state="$store.state.isActiveModal" :data="$store.state.modal"></job-offer-modal>
        </div>
    </body>
    <script src="{{ secure_asset('js/app.js') }}"></script>
</html>
