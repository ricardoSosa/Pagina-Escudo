<?php
    require_once "../../users/users.php";
    require_once "../../session.php";
    class Test_User_Update{
        var $user_id;
        var $user;
        var $is_admin;
        var $session;
    
        function Test_User_Update($user_id,$is_admin){
            $this->user = new User();
            $this->user_id = $user_id;
            $this->is_admin = $is_admin;
        }
        
        function test_update(){
            $this->user->update($this->user_id ,$this->is_admin);
        }
    }