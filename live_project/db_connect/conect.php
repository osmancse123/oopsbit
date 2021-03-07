<?php
class database {
  /*
    mohammadali@gmail.com
    public $servername="localhost";
	public $username="fgcgov_clg";
	public $pass="$(Uct%iyoac%";
	public $db_name="fgcgov_admin";*/
	public $servername="localhost";
	public $username="root";
	public $pass="";
	public $db_name="sbhscedu_database";
    //public $db_name="aaaaa";
	
	public $link;
	public $eror;
	public $sms;
	public $la;
	//database connection 
	public function __construct()
	{
		$this->db_connect();
	}

	private function db_connect()
	{
		$this->link= new mysqli($this->servername,$this->username,$this->pass,$this->db_name) or die ("database connect failed".$this->link->error."(".$this->link->errno.")");
		if(!$this->link)
		{
			echo $this->eror="connection failed";
		}
	}
	// end database connection 

	//sql injection
	public function escape($value)
	{
		$ouput=mysqli_real_escape_string($this->link,$value);
		return $ouput;
	}
	//check insert query
	public function insert_query($query)
	{
	
		$insert_query=$this->link->query($query);
		if($insert_query)
		{
			 $this->sms="<span class='text-center text-success glyphicon glyphicon-ok'><strong>&nbsp;Data Insert Successfully</strong></span>";
			 $la=mysqli_insert_id($this->link);
			 return $la;
		}
		else
		{
			 $this->sms="<span class='text-center text-danger glyphicon glyphicon-remove'><strong>&nbsp;Data Insert Unuccessfully</strong></span>";
		}
	}
	//chect select query
	public function  select_query($query)
	{
		$select_query=$this->link->query($query);
		if($select_query->num_rows>0)
		{
			return $select_query; 
		}
		else
		{
			return false;
		}
		
	}
	
		public function NeAdmisiion($table,$fildname,$prefix,$id_length)
	{
		
				 $query="SELECT MAX($fildname) FROM $table WHERE `id` LIKE('%$prefix%')";
				$result=$this->select_query($query)->fetch_array();
				$max_id=$result[0];
				//print $max_id."<br/>";
				$prefix_length=strlen($prefix);
				//print $prefix_length."<br/>";
				$only_id=substr($max_id,$prefix_length);
				//print $only_id;
				$new=(int)($only_id);
				//print $new;
				$new++;
				//print $new;
				$number_of_zero=$id_length-$prefix_length-strlen($new);
				$zero=str_repeat("0", $number_of_zero);
				//print $zero;
				$made_id=$prefix.$zero.$new;
				//print $made_id;
				return $made_id;

	}
	
	
	public function autogenerat($table,$fildname,$prefix,$id_length)
	{
		$query="SELECT MAX($fildname) FROM $table";
		$result=$this->select_query($query)->fetch_array();
		$max_id=$result[0];
		//print $max_id."<br/>";
		$prefix_length=strlen($prefix);
		//print $prefix_length."<br/>";
		$only_id=substr($max_id,$prefix_length);
		//print $only_id;
		$new=(int)($only_id);
		//print $new;
		$new++;
		//print $new;
		$number_of_zero=$id_length-$prefix_length-strlen($new);
		$zero=str_repeat("0", $number_of_zero);
		//print $zero;
		$made_id=$prefix.$zero.$new;
		//print $made_id;
		return $made_id;

	}
		//public $prefix=date("Y.m.d");
	//with out prefix auto generate
	public function withoutPrefix($table,$fildname,$prefix,$id_length)
	{
		$query="SELECT MAX($fildname) FROM $table";
		$result=$this->select_query($query)->fetch_array();
		$max_id=$result[0];
		//print $max_id."<br/>";
		$prefix_length=strlen($prefix);
		//print $prefix_length."<br/>";
		$only_id=substr($max_id,$prefix_length);
		//print $only_id;
		$new=(int)($only_id);
		//print $new;
		$new++;
		//print $new;
		$number_of_zero=$id_length-$prefix_length-strlen($new);
		$zero=str_repeat("0", $number_of_zero);
		//print $zero;
		$made_id=$prefix.$zero.$new;
		//print $made_id;
		return $made_id;

	}

	public function voucherID($table,$fildname,$prefix,$id_length,$classID)
	{
		       $query="SELECT MAX($fildname) FROM $table where `class_id`='$classID'";
		
				$result=$this->select_query($query)->fetch_array();
				$max_id=$result[0];
				//print $max_id."<br/>";
				$prefix_length=strlen($prefix);
				//print $prefix_length."<br/>";
				$only_id=substr($max_id,$prefix_length);
				//print $only_id;
				$new=(int)($only_id);
				//print $new;
				$new++;
				//print $new;
				$number_of_zero=$id_length-$prefix_length-strlen($new);
				$zero=str_repeat("0", $number_of_zero);
				//print $zero;
				$made_id=$prefix.$zero.$new;
				//print $made_id;
				return $made_id;

	}
	
	
	public function forStudent($table,$fildname,$prefix,$id_length)
	{
	
	$SUBSTR = strlen($prefix);
			if($SUBSTR <=4) {
				$frssubstr = substr($prefix,2,2);
				$totalstr = $frssubstr;
			}else{
				$frssubstr = substr($prefix,2,2);
				$sndsubstr = substr($prefix,7,2);
				$totalstr = $frssubstr.$sndsubstr;
			}
		$query="SELECT MAX($fildname) FROM $table WHERE `id` LIKE('%$totalstr%')";
		$result=$this->select_query($query)->fetch_array();
		$max_id=$result[0];
		//print $max_id."<br/>";
		
		
		$prefix_length=strlen($totalstr);
		//print $prefix_length."<br/>";
		
		$only_id=substr($max_id,$prefix_length);
		//print $only_id;
		$new=(int)($only_id);
		//print $new;
		$new++;
		//print $new;
		$number_of_zero=$id_length-$prefix_length-strlen($new);
		$zero=str_repeat("0", $number_of_zero);
		//print $zero;
		$made_id=$totalstr.$zero.$new;
		$retrunID =  str_replace('-', '0', $made_id);
		return $retrunID;

	}
	//chect update and replace query
	public function update_query($query)
	{
		$update=$this->link->query($query);
		if($update)
		{
			$this->sms="<span class='text-center text-success glyphicon glyphicon-ok'><strong>&nbsp;Data Update Successfully</strong></span>";
		}
		else
		{
			$this->sms="<span class='text-center text-danger glyphicon glyphicon-remove'><strong>&nbsp;Data Update Unuccessfully</strong></span>";
		}
	}
	//check delete query

	public function delete_query($query)
	{
		$delete=$this->link->query($query);
		if($delete)
		{
			$this->sms="<span class='text-center text-success glyphicon glyphicon-ok'><strong>&nbsp;Data Delete Successfully</strong></span>";
			//header('location:index.php');
		}
		else
		{
			$this->sms="<span class='text-center  text-danger glyphicon glyphicon-remove'><strong>&nbsp;Data Delete Unsuccessfully</strong></span>";
		}
	}
	//database connection close
	
	public function passward_encrypt($user_pass)
	{
		$format="$2y$10$";
		$salt_lenght=22;
		$salt=$this->salt_generate($salt_lenght);
		$format_and_salt=$format.$salt;
		 $hash=crypt($user_pass,$format_and_salt);
		return $hash;
	}

	public function salt_generate($lenght)
	{
		$uniqe_id=md5(uniqid(mt_rand(),true));
		$base64_string=base64_encode($uniqe_id);
		$verify_base64=str_replace("+",".", $base64_string);
		$salt=substr($verify_base64,0,$lenght);
		return $salt;

	}
	public function my_money_format($num){
    $money=explode('.',$num);
    if(strlen($money[1])==0)
        $money[1]='00';
    if(strlen($money[0])==0)
        $money[0]='0';    
    if(strlen($money[0])>2){
        $taka=$money[0];
        $thousand=substr($taka, -3);
        $taka=substr($taka,0,strlen($taka)-3);
        $i=0;
        while(strlen($taka)>0){
            if(strlen($taka)>1){
                $pp[$i]=substr($taka, -2);
                $taka=substr($taka,0,strlen($taka)-2);
            }else{
                $pp[$i]=substr($taka, -1);
                $taka=substr($taka,0,strlen($taka)-1);
            }
            $i++;
        }
        for($j=sizeof($pp)-1;$j>=0;$j--)
            $taka_add .=$pp[$j].',';
        return $taka_add.$thousand.".".$money[1];
    }else
        return $money[0].".".$money[1];    
}    
	


	public function _destruct()
	{
		$this->link->close();
	}

}

?>