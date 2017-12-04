<?php
    require_once "../../users/users.php";
    require_once "../../session.php";
    class Test_User_Login{
        var $user_id;
        var $user;
        var $session;
        
        function Test_User_Login($user_id){
            $this->session = new Session();
            $this->user = new User();
            $this->user_id=$user_id;
            $this->user->set_session($this->session);
        }
        
        function test_login(){
            $this->user->login($this->user_id);
            if($this->session->get("admin")){
                echo " es admin";
            }else{
                echo " no es admin";
            }
        }
        
        function test_logout(){
                $this->session->borrarsesíon();
        }
    }    
?>