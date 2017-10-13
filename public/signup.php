<h1>Sign Up</h1>
<a href="./index.php">Home</a>

<?php
/**
 * Created by PhpStorm.
 * User: abstruct
 * Date: 2017-10-13
 * Time: 4:02 PM
 */

require '../server/model/User.php';

if (isset($_POST['user_info'])) {
    $user = new User();
}

?>