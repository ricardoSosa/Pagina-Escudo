<?php
	require_once "../../connection/connectionDB.php";
    
	class User{
		var $conect;
		var $connection;
		var $msg_success;
		var $msg_error;
        var $session;
        
        function User(){
            $this->connection= new  ConnectionDB();
            $this->conect=$this->connection->connect();
			$this->msg_success="Registro Exitoso";
			$this->msg_error="Error al Registrar";
        }
        
		function set_session($session){
            $this->session= $session;
		}
        
        
        function login($user_id){
            echo"Usuario: " . $user_id . " está logeado y";
            $sql = "SELECT * FROM users WHERE fb_id = '$user_id'";
            $result = $this->conect->query($sql);
            if(!$result){
                $this->msg_error="Lo sentimos, el sitio web está experimentando problemas.";
                $msg_db="Errno: " . $mysqli->errno . "\n";
                echo "$this->msg_error";
            }

            if ($result->num_rows === 0) {
                $this->msg_error= "Lo sentimos. No se pudo encontrar una coincidencia para el ID $user. Inténtelo de nuevo.";
                //TODO : header('Location: nuevo_usuario.php'); -> si no está agregar a la BD
                echo "$this->msg_error";
                exit;
            }

            $user_registred = $result->fetch_assoc();
            //0 = no admin
            if($user_registred['is_admin'] == 0){
                $this->session->set("admin", false);
            }else{
                $this->session->set("admin", true);
            }

        }
		
        function register($user_id,$is_admin){
            //TODO: Validar usuario,si ya está registrado
            echo"Usuario a Registrar: " . $user_id . " y ";
            $sql = "INSERT INTO users (fb_id,is_admin) VALUES ('".$user_id."','".$is_admin."')";
            $result = $this->conect->query($sql);
            if(!$result){
                $this->msg_error="Lo sentimos, el sitio web está experimentando problemas.";
                $msg_db="Errno: " . $mysqli->errno . "\n";
                echo "$this->msg_error";
            }else{
                if($is_admin){
                    echo "es admin";
                }else{
                    echo "no es admin";
                }
            }
        }
        
        /*---------------------------------------------------------------------------------------------------------------------------
		function registrar($id_cat, $nombre, $precio, $imagen, $descripcion){

			$queryRegistrar = "insert into productos (id_cat, nombre, precio, imagen, descripcion)
			values ('".$id_cat."', '".$nombre."', '".$precio."', '".$imagen."', '".$descripcion."')";
			$registrar = mysqli_query($this->conn, $queryRegistrar) or die(mysqli_error());

			if($registrar){
				echo "<script>location.href='../vista/index.php?mensaje=". $this->mensajeExito."';</script>";
			}else{
				echo "<script>location.href='../vista/index.php?mensaje=".$this->mensajeError."';</script>";
			}
		}
		//---------------------------------------------------------------------------------------------------------------------------
		function listar(){
			$sql="select * from productos";
			$rs=mysqli_query($this->conn, $sql);
			$i=0;
			if(mysqli_num_rows($rs)<1){
				echo "No hay productos registrados";
			}else{
			 echo "<table border='0' align='center' class='table_' >";
			 echo "<thead>
					<th>Categor&iacute;a</th>
					<th>Nombre</th>
					<th>Precio</th>
					<th>Imagen</th>
					<th>Descripci&oacute;n</th>
					<th>Modificar</th>
					<th>Eliminar</th>
				</thead>";
			 while ($row = mysqli_fetch_array($rs)){

                 if($row["id_cat"] == 1){
                    echo "<td align='center'>Manga</td>";
                 }elseif($row["id_cat"] == 2){
                     echo "<td align='center'>DC</td>";
                 }elseif($row["id_cat"] == 3){
                     echo "<td align='center'>Marvel</td>";
                 }

			echo "<td align='center'>".$row["nombre"]."</td>";
			echo "<td align='center'>".$row["precio"]."</td>";
			echo "<td align='center'>".$row["imagen"]."</td>";
			echo "<td align='center'>".$row["descripcion"]."</td>";

			echo '<td align="center">
			<a class="fancybox fancybox.iframe" href="../vista/fancyBoxModificar.php?id_producto='.$row["id_producto"].'&id_cat='.$row["id_cat"].'&nombre='.$row["nombre"].'&precio='.$row["precio"].'&imagen='.$row["imagen"].'&descripcion='.$row["descripcion"].'" >Editar</a></td>';
			echo "<td><a href='../control/controlador.php?eliminar=si&codigo=".$row["id_producto"]."'>Eliminar</a></td></tr>";
			$i++;
			}
			}
			echo "</table>";
		}
		//---------------------------------------------------------------------------------------------------------------------------
		function modificarUsuario($id_cat, $nombre, $precio, $imagen, $descripcion, $id_producto){
			$queryUpdate = "update productos set id_cat = '".$id_cat."', nombre = '".$nombre."', precio = '".$precio."', imagen = '".$imagen."', descripcion = '".$descripcion."' where id_producto = ".$id_producto;
			$update =mysqli_query($this->conn, $queryUpdate);
			if($update){
				echo "Actualizacion Exitosa";
			}else{
				echo "Error Al Actualizar";
				}
		}
		//---------------------------------------------------------------------------------------------------------------------------
		function eliminar($pk){
			$queryDelete = "delete from productos where id_producto = ".$pk;
                        
			$delete =mysqli_query($this->conn, $queryDelete);
			if($delete){
				echo "<script>
						alert('Eliminacion exitosa');
						location.href='../vista/modificarInformacion.php';
				</script>";
			}else{
				echo "<script>
						alert('Error Al Eliminar');
						location.href='../vista/modificarInformacion.php';
				</script>";
                        }
		}
		//--------------------------------------------------------------------------------------------------------------
		function buscar($dato){
			$sql="select *
			from productos
			where id_cat like '%".$dato."%' OR nombre like '%".$dato."%' OR precio like '%".$dato."%' OR imagen like '%".$dato."%' OR descripcion like '%".$dato."%'";
			$rs=mysqli_query($this->conn, $sql);
			$i=0;
			if(mysqli_num_rows($rs)<1){
				echo "La busqueda no obtuvo resultados.";
			}else{
			echo "<table border='0' align='center' class='table_' ><thead>
					<th>ID Categor&iacute;a</th>
					<th>Nombre</th>
					<th>Precio</th>
					<th>Imagen</th>
					<th>Descripci&oacute;n</th>
					<th>Modificar</th>
					<th>Eliminar</th>
				</thead><tbody>";
			 while ($row = mysqli_fetch_array($rs)){
			echo "<tr><td align='center'>".$row["id_cat"]."</td>";
			echo "<td align='center'>".$row["nombre"]."</td>";
			echo "<td align='center'>".$row["precio"]."</td>";
			echo "<td align='center'>".$row["imagen"]."</td>";
			echo "<td align='center'>".$row["descripcion"]."</td>";
			echo '<td align="center">
			<a class="fancybox fancybox.iframe" href="../vista/fancyBoxModificar.php?id_producto='.$row["id_producto"].'&id_cat='.$row["id_cat"].'&nombre='.$row["nombre"].'&precio='.$row["precio"].'&imagen='.$row["imagen"].'&descripcion='.$row["descripcion"].'" >Editar</a></td>';
			echo "<td><a href='../control/controlador.php?eliminar=si&codigo=".$row["id_producto"]."'>Eliminar</a></td></tr>";
			$i++;
			}
			}
			echo "</tbody></table>";
		}
	
                function eliminarImagen($pk){
                    $queryNameImage = "select id_cat, imagen from productos where id_producto = ".$pk;
                    $rs=mysqli_query($this->conn, $queryNameImage);
                    
                    if (mysqli_num_rows($rs) > 0) {
                        $row = mysqli_fetch_array($rs);
                        $dirDetalles="../../imagenes/productos/detalle/".$row["imagen"];
                        $dir="";
                        if ($row["id_cat"] == 1) {
                            $dir="../../imagenes/mangas/".$row["imagen"];
                        } elseif ($row["id_cat"] == 2) {
                            $dir="../../imagenes/DC/".$row["imagen"];
                        } elseif ($row["id_cat"] == 3) {
                            $dir="../../imagenes/Marvel/".$row["imagen"];
                        }
                     
                        unlink($dir);
                        unlink($dirDetalles);
            }
        }*/
    }
?>
