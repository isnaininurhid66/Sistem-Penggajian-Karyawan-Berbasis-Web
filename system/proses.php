<?php 
class proses{
	function __construct(){
		$server='localhost';
		$user='root';
		$psw='';
		$dbname='penggajian';
		$kon=$this->con=new PDO("mysql:host=$server;dbname=$dbname",$user,$psw);
		$mysqli = mysqli_connect($server,$user,$psw,$dbname);
# koneksi Database
$koneksi = new mysqli($server,$user,$psw,$dbname);
$conn   = mysqli_connect ($server, $user, $psw, $dbname);
$connect = new mysqli($server, $user, $psw, $dbname);
	}





	function get($cel=null,$table=null,$property=null){

		$qw ="SELECT $cel FROM $table $property";
		$ret=$this->con->query($qw);
		return $ret;
	}


	function ambil($cel=null,$table=null){

		$qw ="SELECT $cel FROM $table";
		$ret=$this->con->query($qw);
		return $ret;
	}



	function insert($table=null,$value=null){
		$qw="INSERT INTO $table VALUES($value)";
		$ret=$this->con->query($qw);
		return $ret;
	}


	function delete($table=null,$condition=null){
		$qw="DELETE FROM $table WHERE $condition";
		$ret=$this->con->query($qw);
		return $ret;
	}

	function update($table=null,$value=null,$property=null){
		$qw="UPDATE $table SET $value WHERE $property";
		$ret=$this->con->query($qw);
		return $ret;
	}



}
$db=new proses;
?>