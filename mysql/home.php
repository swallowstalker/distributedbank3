<?php require_once 'Bank4.php' ?>

<html>
	<head>
		<title> Tes Bank </title>
	</head>
	<body>
		<?php
			$bank = new Bank4();
			$u_id = "0906513200";
			$name = "Tobio";
			$saldo = 2000000;
			$ip_domisili = "192.168.0.4";
			
			if($bank->isUserExist($u_id)){
				$bank1 = $bank->getSaldo($u_id);				
				echo $bank1->saldo;
				echo "<br />";
			} else {
				echo $bank->insert($u_id, $name, $saldo, $ip_domisili);
				echo "<br />";
			}
			echo $bank->updateSaldo($u_id, 15000000);
			echo "<br />";
		?>
		blablabla
	</body>
</html>