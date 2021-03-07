<?php
error_reporting(1);
	class dbconnect
	{
		public $hostAddress="localhost";
		public $userName   ="root";
		public $password   ="";
		public $dbName     ="new_db";
		public $link;
		public $sms        ="";

		public function __construct()
		{
			$this->connection();
		}
		public function connection()
		{
			$this->link=new mysqli($this->hostAddress,$this->userName,$this->password,$this->dbName);

		
			if($this->link)
			{
				$sms="connection Successfully";
			}
			else 
			{
				$sms="connection Unsuccessfull";
			}

		}


		public function insert($q)
		{
			$r=$this->link->query($q);
			if($r)
			{
				$this->sms="insert Successfully";
			}
			else
			{
				$this->sms="<b style='color:red'>insert Unsuccessfull</b>";
			}
			
		}

		public function selectQuery($q)
		{
			$r=$this->link->query($q);
			if($r->num_rows>0)
			{
				return $r;
			}
			else
			{
				$this->sms="Unsuccessfull";
			}
		}


		public function edit($q)
		{
			$r=$this->link->query($q);
			if($r)
			{
				$this->sms="Successfully";
			}
			else
			{
				$this->sms="Unsuccessfull";
			}
		}


		public function del($del)
		{
			$r=$this->link->query($del);
			if($r)
			{
				$this->sms="Delete Successfully";
			}
			else
			{
				$this->sms="Delete Unsuccessfull";
			}
		}





		public function __destruct()
		{
			$this->link->close();
		}


	}




?>

<!-- 


	class Person

		public $name;
		public function personName()
		$this->name.
		$personOne = new Person;

this keyword diya name property ke indicate kora hoy.....$this->name.

keyword
class
property
method
object
peramitter


     kmspico.com  -->