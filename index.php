<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Tabla de jugadores</title>
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
                    <div class="col-sm-8"><h2>Listado de Jugadores</h2></div>
                    <div class="col-sm-4">
                        <a href="registro.php" class="btn btn-info add-new"><i class="fa fa-plus"></i> Agregar Jugador</a>
                    </div>
                </div>
            </div>

             <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Celular</th>
                        <th>Saldo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                 
                <tbody>


                <?php 
                    include ('database.php');
                    $jugador = new Database();
                    $listado=$jugador->read();
                    

                ?>

               
                <?php 
                    while ($row=mysqli_fetch_object($listado)){
                    $id=$row->id;
                    $nombre=$row->nombre;
                    $apellido=$row->apellido;
                    $celular=$row->celular;
                    $saldo=$row->saldo;

                ?>
                    
                    <tr>
                    <td><?php echo $nombre;?></td>
                    <td><?php echo $apellido;?></td>
                    <td><?php echo $celular;?></td>
                    <td><?php echo $saldo;?></td>

                    
                    <td>
                    <a href="update.php?id=<?php echo $id;?>" class="edit" title="Editar" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                    <a href="delete.php?id=<?php echo $id;?>" class="delete" title="Eliminar" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                    </td>
                    </tr>   
                    <?php
                    }
                ?>

               
                          
                </tbody>
            </table>

                <?php
                    if($listado->num_rows > 0){                    
                ?>

                <div class="row">
                    <div class="col-sm-4">
                        <a href="partida.php" class="btn btn-info add-new"><i class="fa fa-plus"></i>Iniciar Partida</a>
                    </div>
                </div>
            
            <?php
                }
            ?>
        </div>
    </div>     
</body>
</html>