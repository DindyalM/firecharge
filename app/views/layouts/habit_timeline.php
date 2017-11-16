<?php
function habit_timeline($habits) {
    $timeline = '<div id="timeline" class="text-dark">';
    
    if($habits) {
        foreach($habits as $habit) {
            $timeline = $timeline . habit_card($habit);
        }
    }
        
    $timeline = $timeline . '</div>';
    return $timeline;
}
?>