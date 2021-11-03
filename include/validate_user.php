<?php

if(!$_SESSION['cus_name'] && !$_SESSION['user_id'])
	{
		header("location: login.php");
}

?>