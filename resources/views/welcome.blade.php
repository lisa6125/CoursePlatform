<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>首頁</title>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- Styles -->
  <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
  <div id="app">
    <Layout>
      <Layout>
  </div>
</body>
<script src="{{ mix('js/vue-datepicker-local.js') }}"></script>
<link rel="stylesheet" href="{{mix('css/vue-datepicker-local.css') }}">
<script src="{{mix('js/app.js')}}">
</script>

</html>