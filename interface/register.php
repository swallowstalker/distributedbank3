<html>
	<head>
		<title> Register </title>
	</head>
	<body>
	    <?php // tambahin post untuk form ?>
		<form method="post" action="http://localhost/distributedbank3/proses_register.php">
			<table>
				<tr>
					<td> Nama  </td>
					<td> <input type="text" name="field_nama"/> </td> 
				</tr>
				<tr>
					<td> ID  </td>
					<td> <input type="text" name="field_id" /> </td> 
				</tr>
			</table>			
			
			<input type="submit" value="Register" name="btn_register"/>
		</form>
	</body>
<html>
