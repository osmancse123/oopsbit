<?php

	class dbconnect
	{
		public $hostaddress="localhost";
		public $userName="root";
		public $password="";
		public $dbName="newdb";
		public $link;
		public $sms="";


		function __construct()
		{
			$this->connection();
		}



		function connection()
		{
			$this->link=new mysqli($this->hostaddress,$this->userName,$this->password,$this->dbName);

			if($this->link)
			{
				 //$this->sms="Connection Successfully";
				
			}
			else
			{
				 $this->sms="Connection Unsuccessfully";
				
			}	

		}

		function insert($q)
		{
			$r=$this->link->query($q);
			if($r)
			{
				$this->sms="Insert Successfully";
			}
			else
			{
				$this->sms="Insert unsuccessfully";

			}

		}

	    function selectQuery($q)
		{
			$r=$this->link->query($q);
			if($r->num_rows>0)
			{
					return $r;
			}
			else
			{
				$this->sms=" unsuccessfully";

			}

		}

		function edit($q)
		{
			$r=$this->link->query($q);
			if($r)
			{
					$this->sms="edit Successfully";
			}
			else
			{
				$this->sms="edit unsuccessfully";

			}

		}
		function del($q)
		{
			$r=$this->link->query($q);
			if($r)
			{
					$this->sms="delete Successfully";
			}
			else
			{
				$this->sms="delete unsuccessfully";

			}

		}


		
		function __destruct()
		{
			$this->link->close();
		}


		
	}


	
	

?>