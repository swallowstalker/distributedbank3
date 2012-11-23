<?php
require_once 'DB.php';

class Bank4 extends DB {

    private $db_connect= "";
    //public $u_id, $u_nama, $u_saldo, $u_ip_domisili;
    /*
        initialize the connection when the class creates
    */
    public function  __construct() {
        $this->db_connect = $this->pdo_connection();
    }
    /*
        terminate the connection when the class is terminate
    */
    public function  __destruct() {
        $this->db_connect = null;

    }
    public function errorMessage($msg) {
        echo "Error!! " . $msg . "<br/>";
    }
    /*
 	other class methods place here
    */
	
	public function isUserExist($u_id) {
        if(isset($u_id)){
			$query = 'SELECT id FROM bank
					  WHERE id=:u_id';
					  
			$sql_statement = $this->db_connect->prepare($query);
			$sql_statement->bindParam(':u_id',$this->u_id,PDO::PARAM_STR);

			if(!$sql_statement->execute()) {
				return false;
			}
			$sql_count = $sql_statement->rowCount();
			if($sql_count > 0) {
				return true;
			}
			else {
				return false;
			}
        } else {
			
			return false;
        }
    }
	
	public function getUserDomisili($u_id) {
        if(isset($u_id)){
			$query = 'SELECT ip_domisili FROM bank
					  WHERE id=:u_id';
					  
			$sql_statement = $this->db_connect->prepare($query);
			$sql_statement->bindParam(':u_id',$this->u_id,PDO::PARAM_STR);

			if(!$sql_statement->execute()) {
				return false;
			}
			$sql_count = $sql_statement->rowCount();
			if($sql_count > 0) {
				$sql_result = $sql_statement->fetch(PDO::FETCH_OBJ);

                return $sql_result->ip_domisili;
			}
        }
		return null;
    }
	
	public function insert($u_id, $name, $saldo, $ip_domisili)
	{
	    echo $name;
		try {
            if($this->isUserExist($u_id))
            {
               echo "User is already existed" . "<br/>";
               return false;
            }
            else{
                if(isset($u_id) && isset($name))
                {
                    $query = 'INSERT INTO bank
								SET id=:u_id,
								nama=:u_nama,
								saldo=:u_saldo,								
								ip_domisili=:u_ip_domisili';
                    $sql_statement = $this->db_connect->prepare($query);
                    $sql_statement->bindParam(':u_id',$u_id,PDO::PARAM_STR);
                    $sql_statement->bindParam(':u_nama',$name,PDO::PARAM_STR);
                    $sql_statement->bindParam(':u_saldo',$saldo,PDO::PARAM_INT);
                    $sql_statement->bindParam(':u_ip_domisili',$ip_domisili,PDO::PARAM_STR);

                    if(!$sql_statement->execute()) {
                        return false;
                    }
                    return true;
                }
                else {
                    return false;
                }
            }
        }
        catch(PDOException $e){
            //echo "error! can't insert into the user information" . $e->getMessage() . "<br/>";
            return false;
        }
	}
	
	public function updateSaldo($u_id, $newSaldo)
	{
		try {
           if(isset($u_id)) {
                $query ='UPDATE bank SET
                        saldo=:newSaldo
                        WHERE id=:u_id';
                $sql_statement = $this->db_connect->prepare($query);
                $sql_statement->bindParam(':newSaldo',$newSaldo,PDO::PARAM_INT);
                $sql_statement->bindParam(':u_id',$this->u_id,PDO::PARAM_STR);                

                if(!$sql_statement->execute()) {
                    return -1;
                }
                return 0;
            }
            else {
                return -1;
            }
        }
        catch(PDOException $e) {
            //echo "error! can't update your password!!" .$e->getMessage() . "<br/>"
            return -1;
        }
	}
	
	public function getAllUser()
	{
	    
		try {
           
                $query ='SELECT id, nama From bank';
                $sql_statement = $this->db_connect->prepare($query);
                //$sql_statement->bindParam(':newSaldo',$newSaldo,PDO::PARAM_INT);
                //$sql_statement->bindParam(':u_id',$this->u_id,PDO::PARAM_STR);                

                if(!$sql_statement->execute()) {
                    return -1;
                }
                
                $row_count = $sql_statement->rowCount();
                if ($row_count==0)
                {
                    return -1;
                }
                
                $sql_result = $sql_statement->fetchAll(PDO::FETCH_OBJ);
                return $sql_result;            
        }
        catch(PDOException $e) {
            //echo "error! can't update your password!!" .$e->getMessage() . "<br/>"
            return -1;
        }
	}
	
	public function getSaldo($u_id)
	{
		try {
            if($u_id) {
                $query = "SELECT saldo FROM bank WHERE id=:u_id";
                $sql_statement = $this->db_connect->prepare($query);
                $sql_statement->bindParam(':u_id',$u_id, PDO::PARAM_STR);

                if (!$sql_statement->execute()) {
                    return -1;
                }
                $row_count = $sql_statement->rowCount();
                if ($row_count==0)
                {
                    return -1;
                }

                $sql_result = $sql_statement->fetch(PDO::FETCH_OBJ);

                return $sql_result->saldo;
            }
            else {
                return -1;
            }
        }
        catch(PDOException $e){
            //echo "error: " . $e->getMessage() . "<br/>"
            return -1;
        }
	}
}
?>
