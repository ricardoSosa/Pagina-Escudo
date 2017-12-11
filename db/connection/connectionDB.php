<?php
    header("Content-Type: text/html;charset=utf-8");
    class ConnectionDB{
		var $host;
		var $user;
		var $password;
		var $database;
        var $msg_db;
		var $msg_error;

        function ConnectionDB(){
            $this->host="localhost"; //
            $this->user="root"; //usuario que tengas definido
			$this->password=""; //contraseña que tengas definidad
			$this->database="pagina_escudo"; //base de datos personas, si quieres utilizar otra base de datos solamente cambiala
        }

		function connect(){
            $mysqli = new mysqli($this->host, $this->user, $this->password, $this->database);
            if($mysqli->connect_errno){
                $msg_error="Lo sentimos, el sitio web está experimentando problemas.";
                $msg_db="Connect failed: ". $mysqli->connect_errno;
                exit();
            }
			return($mysqli);
			mysqli_close($mysqli); //cierra la conexion a nuestra base de datos, un ounto de seguridad importante.
        }
}
?>
