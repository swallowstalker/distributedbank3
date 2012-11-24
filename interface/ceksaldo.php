<?php
    require_once "../autoload.php";
?>

<html>
	<head>
		<title> Cek Saldo </title>
	</head>
	<body>
	    <?php // tambahin post untuk form ?>
		<form method="post" action="http://localhost/dist-bank/distributedbank3/proses_cek_saldo.php">
			<table>
				<tr>
					<td> Nama  </td>
					<td> <select name="dropdown_nama">
					    <?php
					        // list seluruh user yang sudah diregister di cabang kita untuk pilihan.
					        $bank = new Bank4();
					        $allUser = $bank->getAllUser();
					        foreach($allUser as $user) {
					            echo "<option value=\"". $user->id ."\">". $user->nama ."</option>";
					        }
					    ?>
					</select> </td> 
				</tr>
				<tr>
					<td> <input type="submit" value="Cek Saldo" name="btn_saldo"/>  </td>
					<td> <input type="submit" value="Cek Total Saldo" name="btn_total_saldo"/> </td> 
				</tr>				
			</table>		
			
		</form>
	</body>
<html>
