<?php
	session_start();
	session_unset();
	if(session_destroy())
	{
		header("Location:admin_loginn.php"); 
	}
?>