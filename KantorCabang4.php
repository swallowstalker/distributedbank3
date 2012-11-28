<?php

require_once "autoload.php";

/* 
 * 
 * 
 */
class KantorCabang4 {
	private $bank;
	private $client;
	private $peers;
	
	public function __construct() {
		$this->bank = new Bank4();
		$this->client = new SoapClient(PEER4);
		$this->peers = array(PEER1,PEER2,PEER3,PEER5,PEER6,PEER7);
	}
	
	/* Membutuhkan fungsi transfer di client untuk 
	 * memeriksa saldo user yang akan melakukan transfer.
	 */
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
		//$kuorum = 5;
		$res = 'kuorum: '.$kuorum;
		if ($kuorum >= 4) {
    		$res = $this->bank->insert($user_id, $nama, 0, $ip_domisili);
		}
		if ($res === true) {
			return 'Registered';
		}
		return $kuorum;
	}
	
	// ping keberadaan cabang ini
	public function ping() {
		return 1;
	}
	
	// ambil saldo di cabang sendiri
	public function getSaldo($user_id) {
		$result = $this->bank->getSaldo($user_id);
		return $result;
	}
	
	// ambil saldo di seluruh cabang lain
	public function getTotalSaldo($user_id) {
		$kuorum = $this->kuorum();
		if ($kuorum < 7) {
			return -1;
		}
		$dom = $this->bank->getUserDomisili($user_id);
		$total = 0;
		if ($dom == HERE) {
			foreach ($this->peers as $peer) {
				$saldo = $this->getSaldoInPeers($peer, $user_id);
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
		$totalActiveNode = $this->ping();
		foreach ($this->peers as $peer) {
			try {
				$client = new SoapClient($peer, array('exceptions'=>true));
				$pong = $client->ping();
				if (is_int($pong)) {
					$totalActiveNode += $pong;
				}
			} catch (Exception $except) {
			}
		}
		return $totalActiveNode;
	}
	
	/**
	* getSaldo di cabang lain
	*/
	private function getSaldoInPeers($loc, $user_id) {
		// ke depannya bisa diganti ama satu source file, isinya endpoint dari kelompok lain.
		$this->client = new SoapClient($loc);
		$saldo = $this->client->getSaldo($user_id);
		if($saldo < 0) {
			$user = $this->bank->getUserData($user_id);
			$this->client->register($user->user_id, $user->nama, $user->ip_domisili);
			$saldo = 0;
		}
		return $saldo;
	}
}

$server = new SoapServer('distributed-bank.xml');
$server->setClass('KantorCabang4');
$server->handle();
?>