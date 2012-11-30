<?php
    require_once "../autoload.php";
	//echo phpversion();
?>

<html>
	<head>
		<title> Ping </title>
	</head>
	<body>
		<form method="post" action="http://localhost/distributedbank3/proses_ping.php">
			<table>				
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
			</table>			
			
			<input type="submit" value="Ping" name="btn_ping"/>
		</form>
	</body>
<html>
