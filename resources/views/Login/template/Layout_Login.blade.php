<!DOCTYPE html>
<html lang="en">
<head>
	@yield('title')
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
    <!-- Tailwind
    <script src="https://cdn.tailwindcss.com"></script> -->
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('assets/styles_1/style.css') }} " />
    <meta name="csrf-token" content="{{ csrf_token() }}">

	@yield('page-css')
    <!--===============================================================================================-->
</head>
<body>
    @yield('login_content')


    <script src="{{ asset('assets/js_1/main.js') }}"></script>
</body>
</html>