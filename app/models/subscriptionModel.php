
<?php
class SubscriptionModel extends Model {
    
    // EFFECTS: finds users whom the correlated user_id is subscribed to
    public function findSubscriptionsByUserId($subscribee_id) {
    //     $this->connect();
        
    //     $stmt = $this->db->prepare('SELECT * FROM Subscription WHERE Subscribee_Id=?');    
    //     $stmt->bind_param('i', $subscribee_id);
        
    //     $stmt->execute();
        
    //     $result = $stmt->get_result();
        
    //     if($this->db->error) {
    //         return false;
    //     }
        
    //     return $result->fetch_array();
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
    // public function destroy($subscribed_to_id, $subscriber_id) {
    //     $this->connect();
        
    //     $stmt = $this->db->prepare('DELETE FROM Subscription WHERE Subscriber_Id=? AND Subscribed_To_Id=?'); 
    //     $stmt->bind_param('ii',$subscriber_id,$subscribed_to_id);
    //     $stmt->execute();
        
    //     $result = $stmt->get_result();
        
    //     if($this->db->error) {
    //         return false;
    //     }
        
    //     return $result->fetch_array();
    // }
}
?>