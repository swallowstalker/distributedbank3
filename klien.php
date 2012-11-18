<?php
	require_once "autoload.php";
	extract($_POST);
	//$client = new nusoap_client("http://kawung.cs.ui.ac.id/~yahya.muhammad/kc/server.php");
	$client = new nusoap_client(PEER4,true);

	$error = $client->getError();
	if ($error) {
		echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
	}
	//echo "getSaldo: ".$getSaldo."; getTotalSaldo: ".$getTotalSaldo;
	if ($register)
		$result = $client->call("register", array("user_id" => $user_id, 'nama' => $name, 'ip_domisili' => $ip_domisili));
	else
		$result = "no query submitted";

	print_r($result);
	if ($client->fault) {
		echo "<h2>Fault</h2><pre>";
		print_r($result);
		echo "</pre>";
	}
	else {
		$error = $client->getError();
		if ($error) {
			echo "<h2>Error</h2>{$user_id}<pre>" . $error . "</pre>";
		}
		else {
			echo "<h2>register({$user_id})</h2><pre>";
			echo $result;
			echo "</pre>";
		}
	}

?>