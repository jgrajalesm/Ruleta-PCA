<?php
	
	class Database{
		private $con;
		private $dbhost="localhost";
		private $dbuser="root";
		private $dbpass="";
		private $dbname="ruleta";
		#iniciamos la conexion 
		function __construct(){
			$this->connect_db();
		}

		#Metodo para conectarnos a la BD
		public function connect_db(){
			$this->con = mysqli_connect($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);
			if(mysqli_connect_error()){
				die("Conexión a la base de datos falló " . mysqli_connect_error() . mysqli_connect_errno());
			}
		}

		# metodo encargado de limpiar las variables antes de que se puedan registar en la BD
		public function sanitize($var){
  			$return = mysqli_real_escape_string($this->con, $var);
  			return $return;
		}

		#Metodo que guarda los datos en la BD
		public function create($nombre,$apellido,$celular){
			$sql = "INSERT INTO `jugador` (nombre, apellido, celular, saldo) VALUES ('$nombre', '$apellido', '$celular', 10000)";
			$res = mysqli_query($this->con, $sql);
			if($res){
			  return true;
					}
			else{
			return false;
		 		}
		}

		#Leemos la BD con el siguiente metodo
		public function read(){
			$sql = "SELECT * FROM jugador";
			$res = mysqli_query($this->con, $sql);
			return $res;
			}

		#Con este metodo obtenemos un solo registro de la BD para modificarlos con el metodo siguiente update
		public function single_record($id){
			$sql = "SELECT * FROM jugador where id='$id'";
			$res = mysqli_query($this->con, $sql);
			$return = mysqli_fetch_object($res );
			return $return ;
		}

		#metodo que actuliza los datos en la BD
		public function update($nombre,$apellido,$celular,$saldo,$id){
			$sql = "UPDATE jugador SET nombre='$nombre', apellido='$apellido', celular='$celular', saldo='$saldo' WHERE id=$id";
			$res = mysqli_query($this->con, $sql);
			if($res){
				return true;
			}
			else{
				return false;
			}
		}

		#metodo para eliminar el registro con su respectivo id
		public function delete($id){
			$sql = "DELETE FROM jugador WHERE id=$id";
			$res = mysqli_query($this->con, $sql);
			if($res){
			return true;
			}
			else{
			return false;
			}
		}

		#metodo que actualiza los datos de la apuesta
		public function update_apuesta($saldo,$id){
			$sql = "UPDATE jugador SET saldo='$saldo' WHERE id=$id";
			$res = mysqli_query($this->con, $sql);
			if($res){
				return true;
			}
			else{
				return false;
			}
		}
}
?>