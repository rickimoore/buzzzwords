<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Buzzword</title>

    <!-- Fonts -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/vue-material.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <script>
      window.data = <?php echo json_encode([
            'offers' => $offers,
        ]); ?>
    </script>
</head>
<body>
<div id="app" class="flex-center position-ref full-height">
    <job-offer-modal :state="$store.state.isActiveModal" :data="$store.state.modal"></job-offer-modal>
    <job-offer-log :offers="$store.state.offers"></job-offer-log>
</div>
</body>
<script src="{{ asset('js/app.js') }}"></script>
</html>
