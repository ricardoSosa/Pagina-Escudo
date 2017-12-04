<?php
require_once "test_user_login.php";
require_once "test_user_add.php";
require_once "test_user_update.php";
require_once "test_user_remove.php";
    class Test_Main{
        var $login_user;
        
        function Test_Main(/*$user*/){
            //$this->login_user = new Test_User_Login($user);
        }
        
        function test_login(){
            $this->login_user->test_login();
        }
        
        function test_logout(){
            $this->login_user->test_logout();
        }
        
        function test_add_user($user,$is_admin){
            $add_user = new Test_User_Add($user,$is_admin);
            $add_user->test_add();
        }
        
        function test_update_user($user,$is_admin){
            $update_user = new Test_User_Update($user,$is_admin);
            $update_user->test_update();
        }
        
        function test_remove_user($user){
            $update_user = new Test_User_Remove($user);
            $update_user->test_remove();
        }
    }
    /*
    //----------------- TEST LOGIN ---------------------------------------//
    $user="user_prueba_noadmin_123";
    $test = new Test_Main($user);
    $test->test_login();
    $test->test_logout();
    echo "<br/>";
    $user2="user_prueba_admin_123";
    $test2 = new Test_Main($user2);
    $test2->test_login();
    $test->test_logout();
    //----------------- END TEST LOGIN ------------------------------------//
    
    //----------------- TEST ADD -----------------------------------------//
    $user="user_prueba2_noadmin_123";
    $is_admin=false;
    $test = new Test_Main();
    $test->test_add_user($user,$is_admin);
    echo "<br/>";

    //----------------- END TEST ADD ------------------------------------//
    

    //----------------- TEST UPDATE -----------------------------------------//
    $user="user_prueba2_noadmin_123";
    //Es lo unico que se me ocurre para actualizar :v
    $is_admin=true;
    $test = new Test_Main();
    $test->test_update_user($user,$is_admin);
    echo "<br/>";
    //----------------- END TEST UPDATE ------------------------------------//
*/
    //----------------- TEST REMOVE -----------------------------------------//
    $user="user_prueba2_noadmin_123";
    $test = new Test_Main();
    $test->test_remove_user($user);
    echo "<br/>";
    //----------------- END TEST REMOVE ------------------------------------//

    
?>