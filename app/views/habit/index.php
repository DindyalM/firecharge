<?php 
    require($_SERVER['DOCUMENT_ROOT'] .'/app/controllers/habit.php');
    
    $habit = new Habit();
    $habit->connect();
    
    
?>

