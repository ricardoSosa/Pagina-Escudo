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
        
        function update($user_id,$is_admin){
            //TODO: Validar usuario,si ya está registrado
            echo"Usuario a Actualizar: " . $user_id;
            $sql = "UPDATE users SET fb_id='".$user_id."',is_admin='".$is_admin."'";
            $result = $this->conect->query($sql);
			
			if(!$result){
				$this->msg_error="Lo sentimos, el sitio web está experimentando problemas.";
                $msg_db="Errno: " . $mysqli->errno . "\n";
                echo "$this->msg_error";
			}else{
				if($is_admin){
                    echo " Usuario Actualizado y es admin";
                }else{
                    echo " Usuario Actualizado y no es admin";
                }
            }
		}
        
        
    }
?>
