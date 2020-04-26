<?php
	class config{
		public $servername;
		public $username;
		public $password;
		public $dbname;

	    public function configuration(){
			if($_SERVER['REMOTE_ADDR']=="127.0.0.1"){
				$this -> servername = "localhost";
				$this -> username = "root";
				$this -> password = "";
				$this -> dbname = "zen";
			}else{
				$this -> servername = "localhost";
				$this -> username = "axulcpij_test";
				$this -> password = 'secret';
				$this -> dbname = "axulcpij_arbeyvelasco";
			}
	    }
	}
?>
