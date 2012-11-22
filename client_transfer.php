<?php
    
/** Transfer dalam sisi klien.
  * 
  */

require_once('autoload.php');

$client = new SoapClient(PEER4); // mesin kita sendiri.
echo $client->getSaldo("0906563104"); // periksa apakah user_id-nya ada.

$bank = new Bank4();
foreach($bank->getAllUser() as $test) {
    echo $test->id . ' Ganteng<br />';
}


?>
