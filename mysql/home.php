<?php require_once 'Bank4.php' ?>

<html>
	<head>
		<title> Tes Bank </title>
	</head>
	<body>
		<?php
			$bank = new Bank4();
			$bank->u_id = "0906513200";
			$bank->u_nama = "Tobio";
			//$bank->u_saldo = 2000000;
			//$bank->u_ip_domisili = "192.168.0.4";
			
			if($bank->userIsExist()){
				$bank1 = $bank->getSaldo();				
				echo $bank1->saldo;
				echo "<br />";
			} else {
				echo $bank->insert();
				echo "<br />";
			}
			echo $bank->updateSaldo(15000000);
			echo "<br />";
		?>
		blablabla
	</body>
</html>