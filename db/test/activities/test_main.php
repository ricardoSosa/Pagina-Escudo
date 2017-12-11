<?php
    require_once "../../activities/activities.php";
    class Test_Activities{
        var $user_id;
        var $activity;
        var $is_admin;
        var $session;
    
        function Test_Activities(){
            $this->activity = new Activity();
            $this->activity->getActivities();
        }
        
        function test_add(){
            $this->user->register($this->user_id ,$this->is_admin);
        }
    }

    $test = new Test_Activities();

?>