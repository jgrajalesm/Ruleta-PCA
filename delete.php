<?php 
if (isset($_GET['id'])){
	include('database.php');
	$jugador = new Database();
	$id=intval($_GET['id']);
	$res = $jugador->delete($id);
	if($res){
		header('location: index.php');
	}else{
		echo "Error al eliminar el registro";
	}
}
?>