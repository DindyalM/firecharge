<?php

// EFFECTS: returns the html for the habit timeline, shows the create form
//          if show_habit_create is true or the username param in the url is equal
//          to the current user's username
function subscription_timeline($data, $subscription_data=false, $profile_owner_username=false) {
	$timeline = "";
	// insert data into timeline
	if($data) {
		if($subscription_data) {
			foreach($data as $d) {
				$timeline = $timeline . subscription_card($d, $subscription_data, $profile_owner_username);
			}
		}
		else {
			foreach($data as $d) {
				$timeline = $timeline . subscription_post_card($d);
			}
		}
	}
										
	return $timeline;
}
?>