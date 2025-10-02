<?php
include('includes/db_connect.inc');
include('includes/header.inc');
$skill_id = isset($_GET['skill_id']) ? (int) $_GET['skill_id'] : 0;

$sql = "SELECT * FROM skills WHERE skill_id = $skill_id";
$record = $conn->query($sql);
$current_skill = $record->fetch_assoc();
 echo $current_skill['rate_per_hr'] ?>



<?php include 'includes/footer.inc';
?>
