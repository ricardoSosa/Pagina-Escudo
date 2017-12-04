<?php
class Session {
    function Session() {
        session_start ();
    }

    public function set($nombre, $valor) {
        $_SESSION [$nombre] = $valor;
    }

    public function get($nombre) {
        if (isset ( $_SESSION [$nombre] )) {
            return $_SESSION [$nombre];
        } else {
            return false;
        }
    }
    
    public function borrar_variable($nombre) {
        unset ( $_SESSION [$nombre] );
    }
    
    public function borrarsesíon() {
        $_SESSION = array();
        session_destroy ();
    }
}
?>