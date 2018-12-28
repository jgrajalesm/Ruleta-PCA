<?php
	if (isset($_GET['id'])){
		$id=intval($_GET['id']);
	} else {
		header("location:index.php");
	}
?>


<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Modificar jugadores</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>
    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Editar Jugador</h2></div>
                    <div class="col-sm-4">
                        <a href="index.php" class="btn btn-info add-new"><i class="fa fa-arrow-left"></i> Regresar</a>
                    </div>
                </div>
            </div>

            <?php
				
				include ("database.php");
				$jugador= new Database();
				
				if(isset($_POST) && !empty($_POST)){
					$nombre = $jugador->sanitize($_POST['nombre']);
					$apellido = $jugador->sanitize($_POST['apellido']);
					$celular = $jugador->sanitize($_POST['celular']);
					$saldo = $jugador->sanitize($_POST['saldo']);
					$id_jugador=intval($_POST['id_jugador']);
					$res = $jugador->update($nombre, $apellido, $celular, $saldo, $id_jugador);
					if($res){
						$message= "Datos actualizados con éxito";
						$class="alert alert-success";
						
					}else{
						$message="No se pudieron actualizar los datos";
						$class="alert alert-danger";
					}
					
					?>
				<div class="<?php echo $class?>">
				  <?php echo $message;?>
				</div>	
					<?php
				}
				$datos_jugador=$jugador->single_record($id);
			?>

			<div class="row">
				<form method="post">
				<div class="col-md-12">
					<label>Nombre:</label>
					<input type="text" name="nombre" id="nombre" class='form-control' maxlength="200" required  value="<?php echo $datos_jugador->nombre;?>">
					<input type="hidden" name="id_jugador" id="id_jugador" class='form-control' maxlength="200"   value="<?php echo $datos_jugador->id;?>">
				</div>
				<div class="col-md-12">
					<label>Apellido:</label>
					<input type="text" name="apellido" id="apellido" class='form-control' maxlength="200" required value="<?php echo $datos_jugador->apellido;?>">
				</div>
				<div class="col-md-12">
					<label>Celular:</label>
					<input type="text" name="celular" id="celular" class='form-control' maxlength="10" required value="<?php echo $datos_jugador->celular;?>">
				</div>

				<div class="col-md-12">
					<label>Saldo:</label>
					<input type="number" name="saldo" id="saldo" class='form-control' required value="<?php echo $datos_jugador->saldo;?>">
				</div>
				
				<div class="col-md-12 pull-right">
				<hr>
					<button type="submit" class="btn btn-success">Actualizar datos</button>
				</div>
				</form>
			</div>
        </div>
    </div>     
</body>
</html>