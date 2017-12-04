<?php
    require_once "../../users/users.php";
    require_once "../../session.php";
    class Test_User_Remove{
        var $user_id;
        var $user;
        var $session;
    
        function Test_User_Remove($user_id){
            $this->user = new User();
            $this->user_id = $user_id;
        }
        
        function test_remove(){
            $this->user->delete($this->user_id);
        }
    }