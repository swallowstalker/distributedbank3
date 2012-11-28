<?php
    require_once "../autoload.php";
	//echo phpversion();
?>

<html>
	<head>
		<title> Transfer </title>
	</head>
	<body>
		<form method="post" action="http://localhost/distributedbank3/proses_transfer.php">
			<table>
				<tr>
					<td> Pengirim  </td>
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
					<td> Tujuan  </td>
					<td> <select name="tujuan">
					    <option value="<?php echo PEER1; ?>">Cabang 1</option>
					    <option value="<?php echo PEER2; ?>">Cabang 2</option>
					    <option value="<?php echo PEER3; ?>">Cabang 3</option>
					    <option value="<?php echo PEER4; ?>">Cabang 4 (sendiri)</option>
					    <option value="<?php echo PEER5; ?>">Cabang 5</option>
					    <option value="<?php echo PEER6; ?>">Cabang 6</option>
					    <option value="<?php echo PEER7; ?>">Cabang 7</option>
					</select> </td> 
				</tr>
				<tr>
					<td> Nominal  </td>
					<td> <input type="text" name="field_nominal" /> </td> 
				</tr>
			</table>			
			
			<input type="submit" value="Transfer" name="btn_register"/>
		</form>
	</body>
<html>
