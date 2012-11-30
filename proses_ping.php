<?php
    
    require_once "autoload.php";

    // extract hasil field kiriman dari form.
    extract($_POST);    
    
	// transfer ke mesin tujuan.
	try {
		$client = new SoapClient(trim($tujuan)); // mesin tujuan.
		$isActive = $client->ping();
	
		if ($isActive == 1)
			echo "bank active <br />";
		else
			echo "bank inactive <br />";
	} catch (Exception $except) {			
		echo "bank inactive <br />";
	}
		
    
    echo "<a href=\"interface/home.php\">Kembali</a>";
    
?>
