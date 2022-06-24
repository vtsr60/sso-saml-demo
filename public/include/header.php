<?php
require_once ('../vendor/autoload.php');

class SSOUser {

	private static $authProvider;

	const SERVICE_PROVIDER = 'samltest-sp';

	public static function get_auth_provider()
	{
		if (!self::$authProvider) {
			self::$authProvider = new SimpleSAML_Auth_Simple(SSOUser::SERVICE_PROVIDER);
		}
		return self::$authProvider;
	}

	public static function is_logged_in()
	{
		return self::get_auth_provider()->isAuthenticated();
	}

	public static function claims()
	{
		if (self::is_logged_in()) {
			return self::get_auth_provider()->getAttributes();
		}
		return null;
	}
}

?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SSO SAML Demo</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>
<body>
<h1>SSO SAML Test</h1>
