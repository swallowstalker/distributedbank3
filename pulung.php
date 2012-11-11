<?php
require_once "nusoap/lib/nusoap.php";
require_once "mysql/Bank4.php";

/* Fungsi kuorum dan register untuk web service sisdis
 * 
 * Pulung Ragil Lanang
 */

function kuorum() {
    // ke depannya bisa diganti ama satu source file, isinya endpoint dari kelompok lain.
    $client1 = new nusoap_client("http://192.168.0.1/webservice.php");
    $client2 = new nusoap_client("http://192.168.0.2/webservice.php");
    $client4 = new nusoap_client("http://192.168.0.4/webservice.php");
    $client5 = new nusoap_client("http://192.168.0.5/webservice.php");
    $client6 = new nusoap_client("http://192.168.0.6/webservice.php");
    $client7 = new nusoap_client("http://192.168.0.7/webservice.php");
    $totalActiveNode = 0;
    
    $totalActiveNode = $client1->call("ping") + $client2->call("ping");
    $totalActiveNode = $totalActiveNode + $client4->call("ping") + $client5->call("ping");
    $totalActiveNode = $totalActiveNode + $client6->call("ping") + $client7->call("ping");
    
    return $totalActiveNode;
}

function register($user_id, $nama, $ip_domisili) {
    if (kuorum() >= 4) {
        $bank = new Bank4();
        $bank->u_id = $user_id;
        $bank->u_name = $nama;
        $bank->u_ip_domisili = $ip_domisili;
        $bank->u_saldo = 0;
        
        if (!($bank->userIsExist())) {
            $bank->insert();
        }
    }
}

$server = new soap_server();
$server->register("register");
$server->service($HTTP_RAW_POST_DATA);

?>
