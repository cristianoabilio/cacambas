<!doctype html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title><?php echo Config::get('cacambas.name'); ?></title>
	@include('subtemplates.head')
</head>

<body>

	@include('subtemplates.sidebar')

	@include('subtemplates.header-geral')

	@yield('content')

	@include('subtemplates.footer')
    <script src="/javascripts/cacambas.caminhoes.js"></script>

</body>

</html>