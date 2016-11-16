<!DOCTYPE html>
<html>
	<head>
		<title>Laravel Components</title>

		<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">

		<style type="text/css">
			@stack('css')
		</style>
	</head>
	<body>
		@yield('content')

		<script type="text/javascript" src="{{ asset('assets/plugins/jquery/jquery-3.1.1.min.js') }}"></script>

		<script type="text/javascript">
			@stack('javascript')
		</script>
	</body>
</html>