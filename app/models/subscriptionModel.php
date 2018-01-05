
<?php
class SubscriptionModel extends Model {
    
    // EFFECTS: finds posts from the users you are subscribed to
    public function findSubscriptionPostsByUserId($subscriber_id) {
        $this->connect();
        
        $stmt = $this->db->prepare('SELECT u1.Username AS "Poster_Username", p.Text AS "Post", u2.Username AS "Posted_To_Username" FROM Post p
                                    INNER JOIN Subscription s ON s.Subscriber_Id=?
                                    INNER JOIN User u1 ON u1.User_Id=p.Poster_Id
                                    INNER JOIN User u2 ON u2.User_Id=p.User_Id
                                    WHERE p.Poster_Id=s.Subscribed_To_Id');
        $stmt->bind_param('i', $subscriber_id);
        
        $stmt->execute();
        
        $result = $stmt->get_result();
        
        if($this->db->error) {
            return false;
        }
        
        return $result;
    }
    
        // EFFECTS: finds habits from the users you are subscribed to
    public function findSubscriptionHabitsByUserId($subscriber_id) {
        $this->connect();
        
        $stmt = $this->db->prepare('SELECT * FROM Habit h
                                    INNER JOIN Subscription s ON s.Subscriber_Id=?
                                    INNER JOIN User u ON u.User_Id=h.User_Id
                                    WHERE h.User_Id=s.Subscribed_To_Id');
        $stmt->bind_param('i', $subscriber_id);
        
        $stmt->execute();
        
        $result = $stmt->get_result();
        
        if($this->db->error) {
            return false;
        }
        
        return $result->fetch_all(FETCH_ASSOC);
    }
    
    // EFFECTS: finds users whom the correlated user_id is subscribed to
    public function create($subscriber_id, $subscribe_to_id) {
        $this->connect();
        
        $stmt = $this->db->prepare('INSERT INTO Subscription (Subscriber_Id, Subscribed_To_Id) VALUES (?, ?)');
        $stmt->bind_param('ii', $subscriber_id, $subscribe_to_id);
        
        $stmt->execute();
        
        $result = $stmt->get_result();
        
        if($this->db->error) {
            return false;
        }
        
        return true;
    }
    
    public function subscriptionExists($subscriber_id, $subscribed_to_id) {
        $this->connect();

        $stmt = $this->db->prepare("SELECT * FROM Subscription WHERE Subscriber_Id=? AND Subscribed_To_Id=?");
        $stmt->bind_param('ii', $subscriber_id, $subscribed_to_id);

        $stmt->execute();
        $result = $stmt->get_result();
        
        $result->fetch_array(MYSQLI_ASSOC);
        return $result->num_rows > 0;
    }
    
    //     // EFFECTS: unsubscribe subscribee from subscriber
    public function destroy($subscriber_id, $unsubscribe_to_id) {
        $this->connect();
        
        $stmt = $this->db->prepare('DELETE FROM Subscription WHERE Subscriber_Id=? AND Subscribed_To_Id=?'); 
        $stmt->bind_param('ii',$subscriber_id,$unsubscribe_to_id);
        $stmt->execute();
        
        $result = $stmt->get_result();
        
        if($this->db->error) {
            return false;
        }
        
        return true;
    }
}
?>