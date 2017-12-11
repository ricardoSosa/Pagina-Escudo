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
                $msg_db="Errno: " . $this->conect->errno . "\n";
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
                $this->msg_error="Lo sentimos, el sitio web está experimentando problemas. No se pudo registrar usuario. Intentar más tarde";
                $msg_db="Errno: " . $this->conect->errno . "\n";
                echo "$this->msg_error";
            }else{
                if($is_admin){
                    echo "es admin..... USUARIO REGISTRADO";
                }else{
                    echo "no es admin.... USUARIO REGISTRADO";
                }
            }
        }
        
        function update($user_id,$is_admin){
            //TODO: Validar usuario,si ya está registrado
            echo"Usuario a Actualizar: " . $user_id;
            $sql = "UPDATE users SET is_admin='".$is_admin."' WHERE fb_id='".$user_id."'";
            $result = $this->conect->query($sql);
			
			if(!$result){
				$this->msg_error="<br>Lo sentimos, el sitio web está experimentando problemas. No se pudo actualizar usuario. Intentar más tarde";
                $msg_db="Errno: " . $this->conect->errno . "\n";
                echo "$this->msg_error";
			}else{
				if($is_admin){
                    echo " Usuario Actualizado y es admin";
                }else{
                    echo " Usuario Actualizado y no es admin";
                }
            }
		}
        
        function delete($user_id){
            //TODO: Validar usuario,si ya está registrado
            echo"Usuario a Eliminar: " . $user_id;
            $sql = "DELETE FROM users WHERE fb_id='".$user_id."'";
            $result = $this->conect->query($sql);
            
            if(!$result){
				$this->msg_error="Lo sentimos, el sitio web está experimentando problemas. No se pudo eliminar usuario. Intentar más tarde";
                $msg_db="Errno: " . $this->conect->errno . "\n";
                echo "$this->msg_error";
			}else{
				echo "<br> Usuario eliminado";
            }
        }
        
        /*---------------------------------------------------------------------------------------------------------------------------
		
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
		}*/
    }
?>
