<?php

include_once "include/header.php";

$errorMsg = "Unexpected error happened failed to Authenticated.";
try {
	$as = SSOUser::get_auth_provider();
	$as->requireAuth();
	if ($as->isAuthenticated()) {
		header("Location: index.php");
		exit();
	}
}
catch (Error $e) {
	$errorMsg = $e->getMessage();
}
?>

<div class="alert alert-primary" role="alert">
	<?=$errorMsg?>
</div>

<?php
include_once "include/footer.php";
?>
