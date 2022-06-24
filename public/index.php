<?php
include_once "include/header.php";
?>

<?php if (SSOUser::is_logged_in()) {
	echo '<p>User is successful authenticated to IDP, to logout click on logout button</p>'
		. '<a class="btn btn-danger" href="logout.php">SSO Logout</a>';
	echo '<pre>'.json_encode(SSOUser::claims(), JSON_PRETTY_PRINT).'</pre>';
} else {?>
	<p>User is not authenticated with IDP, to login click on login button.</p>
	<a class="btn btn-success" href="login.php">SSO Login</a>
<?php
}?>



<?php
include_once "include/footer.php";
?>