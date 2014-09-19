<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo Config::get('cacambas.name'); ?></title>
	@include('subtemplates.head')
</head>
<body>

	@yield('content')

	@include('subtemplates.footer')

    <script src="/javascripts/cacambas.login.js"></script>

</body>

</html>