<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Partida ruleta</title>
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
                    <div class="col-sm-8"><h2>Partida</h2></div>
                    <div class="col-sm-4">
                        <a href="index.php" class="btn btn-info add-new"><i class="fa fa-arrow-left"></i> Regresar</a>
                    </div>
                </div>
            </div>
<!- Estructura basica de la ruleta ->
            <table class="table table-bordered">
                <tr>
                    <td bgcolor="green" style="color:white;font-weight:600">0</td>
                    <td bgcolor="black" style="color:white;font-weight:600">1</td>
                    <td bgcolor="red" style="color:white;font-weight:600">2</td>
                    <td bgcolor="black" style="color:white;font-weight:600">3</td>
                    <td bgcolor="red" style="color:white;font-weight:600">4</td>
                    <td bgcolor="black" style="color:white;font-weight:600">5</td>
                    <td bgcolor="red" style="color:white;font-weight:600">6</td>
                    <td bgcolor="black" style="color:white;font-weight:600">7</td>
                    <td bgcolor="red" style="color:white;font-weight:600">8</td>
                    <td bgcolor="black" style="color:white;font-weight:600">9</td>
                    <td bgcolor="red" style="color:white;font-weight:600">10</td>
                    <td bgcolor="black" style="color:white;font-weight:600">11</td>
                    <td bgcolor="red" style="color:white;font-weight:600">12</td>
                </tr>
                <tr>
                    <td bgcolor="black" style="color:white;font-weight:600">13</td>
                    <td bgcolor="red" style="color:white;font-weight:600">14</td>
                    <td bgcolor="black" style="color:white;font-weight:600">15</td>
                    <td bgcolor="red" style="color:white;font-weight:600">16</td>
                    <td bgcolor="black" style="color:white;font-weight:600">17</td>
                    <td bgcolor="red" style="color:white;font-weight:600">18</td>
                    <td bgcolor="black" style="color:white;font-weight:600">19</td>
                    <td bgcolor="red" style="color:white;font-weight:600">20</td>
                    <td bgcolor="black" style="color:white;font-weight:600">21</td>
                    <td bgcolor="red" style="color:white;font-weight:600">22</td>
                    <td bgcolor="black" style="color:white;font-weight:600">23</td>
                    <td bgcolor="red" style="color:white;font-weight:600">24</td>
                    <td bgcolor="black" style="color:white;font-weight:600">25</td>
                </tr>
                <tr>
                    <td bgcolor="red" style="color:white;font-weight:600">26</td>
                    <td bgcolor="black" style="color:white;font-weight:600">27</td>
                    <td bgcolor="red" style="color:white;font-weight:600">28</td>
                    <td bgcolor="black" style="color:white;font-weight:600">29</td>
                    <td bgcolor="red" style="color:white;font-weight:600">30</td>
                    <td bgcolor="black" style="color:white;font-weight:600">31</td>
                    <td bgcolor="red" style="color:white;font-weight:600">32</td>
                    <td bgcolor="black" style="color:white;font-weight:600">33</td>
                    <td bgcolor="red" style="color:white;font-weight:600">34</td>
                    <td bgcolor="black" style="color:white;font-weight:600">35</td>
                    <td bgcolor="red" style="color:white;font-weight:600">36</td>
                    <td bgcolor="green" style="color:white;font-weight:600">37</td>
                    <td ></td>
                </tr>
            </table>

            <form method="post">
             <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Numero</th>
                        <th>Valor apuesta</th>
                       
                    </tr>
                </thead>
                 
                <tbody>

                
                <?php 
                    include ('database.php');
                    $jugador = new Database();
                    $listado=$jugador->read();
                    
                ?>

               
                <?php 
                    $jugadores = array();
                    while ($row=mysqli_fetch_object($listado)){
                    $id=$row->id;
                    $nombre=$row->nombre;
                    $apellido=$row->apellido;
                    $nombre_jugador = $nombre.' '.$apellido;
                    $saldo=$row->saldo;
                    $apuesta_min=$saldo*0.08;
                    $apuesta_max=$saldo*0.15;
                    $jugadores[] = $id;

                   
                ?>
                    
                    <tr>
                        <td><?php echo $nombre;?></td>
                        <td><?php echo $apellido;?></td>
                        <td><select name="numero_<?=$id?>" id="numero_<?=$id?>">
                            <?php
                                for($i=0; $i<=37; $i++){
                                    echo '<option value="'.$i.'">'.$i.'</option>';
                                }
                            ?>
                        </select></td>

                        <td><input type="number" name="apuesta_<?=$id?>" id="apuesta_<?=$id?>" min="<?=$apuesta_min;?>" max="<?=$apuesta_max;?>" required>
                            <input type="hidden" name="saldo_<?=$id?>" value="<?=$saldo?>">
                            <input type="hidden" name="jugador_<?=$id?>" value="<?=$nombre_jugador?>"></td>
                    </tr>   
                    <?php
                    }
                ?>

               
                          
                </tbody>
            </table>
            <?php
                if(isset($_POST) && !empty($_POST)){
                    $ruleta = rand(0,37);
                    $ganadores = false;
                    echo '<h1>El número ganador es: '.$ruleta.'</h1>';

                    $detalle_partida = array();
                    #Aqui se hacen las validaciones dependiendo del numero ganador, si es verde, rojo o negro
                    foreach($jugadores as $j){
                        $id_jugador = $j;
                        $numero_apuesta = $_POST['numero_'.$j];
                        $valor_apuesta = $_POST['apuesta_'.$j];
                        $nombre = $_POST['jugador_'.$j];
                        if($numero_apuesta == $ruleta){
                            if($numero_apuesta == 0 || $numero_apuesta == 37){
                                $valor_ganado = $valor_apuesta * 15;
                            }else{
                                $valor_ganado = $valor_apuesta * 2;
                            }
                            $ganador = 1;
                            $ganadores = true;
                            $nuevo_saldo = $_POST['saldo_'.$j] + $valor_ganado;
                        }else{
                            $nuevo_saldo = $_POST['saldo_'.$j] - $valor_apuesta;
                            $ganador = 0;
                        }

                        #arreglo en donde se almacena el nuevo saldo del jugador dependiento deñ resultado de la partida
                        $detalle_partida[] = array(
                            'jugador' => $id_jugador,
                            'numero_apuesta' => $numero_apuesta,
                            'valor_apuesta' => $valor_apuesta,
                            'nuevo_saldo' => $nuevo_saldo,
                            'nombre' => $nombre,
                            'ganador' => $ganador
                        );
                    }

                    if($ganadores){
                        echo '<h2>Ganadores: </h2><br>';
                    }else{
                        echo '<h2>No hubo ganadores en esta partida.</h2>';
                    }

                    foreach($detalle_partida as $datos=>$valor){
                        $jugador->update_apuesta($valor['nuevo_saldo'], $valor['jugador']);
                        if($valor['ganador'] == 1){
                            echo '<h3>'.$valor['nombre'].'</h3>';
                        }
                    }
                }
            ?>
            <div class="col-md-12 pull-right">
            <hr>
                <button type="submit" class="btn btn-success">Jugar</button>
            </div>
            </form>
        </div>
    </div>     
</body>
</html>