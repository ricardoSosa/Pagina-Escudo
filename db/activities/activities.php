<?php
	require_once "../../connection/connectionDB.php";
    
	class Activity{
		var $conect;
		var $connection;
		var $msg_success;
		var $msg_error;
        
        function Activity(){
            $this->connection= new  ConnectionDB();
            $this->conect=$this->connection->connect();
        }
		
        function register($activity_id, $status ,$creation_date, $expiration_date){
            //TODO: Validar usuario,si ya está registrado
            echo"Actividad a Registrar: " . $activity_id;
            $sql = "INSERT INTO posts (activity_id, status , creation_date, expiration_date) VALUES ('".$activity_id."','".$status."','".$creation_date."','".$expiration_date."')";
            $result = $this->conect->query($sql);
            if(!$result){
                $this->msg_error="Lo sentimos, el sitio web está experimentando problemas. No se pudo registrar la actividad. Intentar más tarde";
                $msg_db="Errno: " . $this->conect->errno . "\n";
                echo "$this->msg_error";
            }else{
                    echo ".... <br> Actividad Registrada";
            }
        }
        
        function update($activity_id, $status ,$creation_date, $expiration_date){
            echo"Actividad a Actualizar: " . $activity_id;
            $sql = "UPDATE posts SET status='".$status."', creation_date='".$creation_date."', expiration_date='".$expiration_date."' WHERE fb_id='".$activity_id."'";
            $result = $this->conect->query($sql);
			
			if(!$result){
				$this->msg_error="<br>Lo sentimos, el sitio web está experimentando problemas. No se pudo actualizar la actividad. Intentar más tarde";
                $msg_db="Errno: " . $this->conect->errno . "\n";
                echo "$this->msg_error";
			}else{
				echo ".... <br> Actividad Actualizada";
            }
		}
        
        function delete($activity_id){
            echo"Actividad a Eliminar: " . $activity_id;
            $sql = "DELETE FROM posts WHERE activity_id='".$activity_id."'";
            
            
            if(!$result = $this->conect->query($sql)){
				$this->msg_error="Lo sentimos, el sitio web está experimentando problemas. No se pudo eliminar usuario. Intentar más tarde";
                $msg_db="Errno: " . $this->conect->errno . "\n";
                echo "$this->msg_error";
			}else{
				echo "<br> Usuario eliminado";
            }
        }
        
        function getActivities(){
			$sql="select * from posts";
            
            if(!$result = $this->conect->query($sql)){
                $this->msg_error="Lo sentimos, el sitio web está experimentando problemas. Intentar más tarde";
                $msg_db="Errno: " . $this->conect->errno . "\n";
                echo "$this->msg_error";
                
            }
            
            if ($result->num_rows === 0) {
                echo "No hay publicaciones registradas.";
                exit;
            }
            
            echo "<ul>\n";
            while ($post = $result->fetch_assoc()) {
                echo "<li>Id=" . $post['id'] . "<br/>";
                echo "Estado: ". $post['status'] . " Fecha Creación: " . $post['creation_date'] . " Fecha Expiración: " . $post['expiration_date'];
                echo "</a></li>\n";
            }
            echo "</ul>\n";
            
		}
		
		function search($dato){
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
    }
?>
