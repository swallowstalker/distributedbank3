<?php

require_once "autoload.php";

/* 
 * 
 */
class KantorCabang4 {
	private $bank;
	private $client;
	
	public function __construct() {
		$this->bank = new Bank4();
		$this->client = new SoapClient(PEER4);
	}
	
	public function transfer($user_id, $nilai) {
		$kuorum = $this->kuorum();
		$status = 0;
		if ($kuorum >= 4) {
			$saldo = $this->getSaldo($user_id);
			$ret = $this->bank->updateSaldo($user_id, $saldo + $nilai);
			if ($ret == 0) {
				$status = 1;
			}
		}
		return $status;
	}
	
	public function register($user_id, $nama, $ip_domisili) {
		$kuorum = $this->kuorum();
		if ($kuorum >= 4) {			
			if (!($this->bank->isUserExist($user_id))) {
				$this->bank->insert($user_id, $nama, 0, $ip_domisili);
			}
		}
	}
	
	public function ping() {
		return 1;
	}
	
	public function getSaldo($user_id) {
		$result = $this->bank->getSaldo($user_id);
		return $result;
	}
	
	public function getTotalSaldo($user_id) {
		$kuorum = $this->kuorum();
		if ($kuorum < 7) {
			return -1;
		}
		$dom = $this->bank->getUserDomisili($user_id);
		$total = 0;
		if ($dom == HERE) {
			foreach (LOCATION as $loc) {
				$saldo = $this->getSaldoInPeers($loc, $user_id);
				$total += $saldo;
			}
			$total += $this->getSaldo($user_id);
		} else {
			return -1;
		}
		return $total;
	}
	
	private function kuorum() {
		// ke depannya bisa diganti ama satu source file, isinya endpoint dari kelompok lain.
		$client1 = new SoapClient(PEER1);
		$client2 = new SoapClient(PEER2);
		$client3 = new SoapClient(PEER3);
		$client4 = new SoapClient(PEER4);
		$client5 = new SoapClient(PEER5);
		$client6 = new SoapClient(PEER6);
		$client7 = new SoapClient(PEER7);
		$totalActiveNode = $client4->ping();
		
		$totalActiveNode = $client1->ping() + $client2->ping();
		$totalActiveNode = $totalActiveNode + $client3->ping() + $client5->ping();
		$totalActiveNode = $totalActiveNode + $client6->ping() + $client7->ping();
		
		return $totalActiveNode;
	}
	
	/**
	* getSaldo in another cabang
	*/
	private function getSaldoInPeers($loc, $user_id) {
		// ke depannya bisa diganti ama satu source file, isinya endpoint dari kelompok lain.
		$this->client->__setLocation($loc);
		$saldo = $client->getSaldo($user_id);
		if($saldo < 0) {
			$client->register();
		}
		return $saldo;
	}
}

$server = new SoapServer('distributed-bank.wsdl');
$server->setClass('KantorCabang4');
$server->handle();

?>
