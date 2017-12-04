<?php
    require_once "../../users/users.php";
    require_once "../../session.php";
    class Test_User_Add{
        var $user_id;
        var $user;
        var $is_admin;
        var $session;
    
        function Test_User_Add($user_id,$is_admin){
            $this->user = new User();
            $this->user_id = $user_id;
            $this->is_admin = $is_admin;
        }
        
        function test_add(){
            $this->user->register($this->user_id ,$this->is_admin);
        }
    }