<?php
include('includes/db_connect.inc');
include('includes/header.inc');
$skill_id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$sql = "SELECT * FROM skills WHERE skill_id = $skill_id";
$record = $conn->query($sql);
$current_skill = $record->fetch_assoc();
?>
<main>
    <div class="container">
        <h1 class="mb-4"><?php echo ($current_skill['title']); ?></h1>
        
        <div class="detail-container">
            <div class="row">
                <div class="col-md-4">
                    <img src="<?php echo ($current_skill['image_path']); ?>" 
                         alt="<?php echo ($current_skill['title']); ?>" 
                         class="img-fluid">
                </div>
                <div class="col-md-8 detail-info">
                    <p><span class="detail-label">Description:</span></p>
                    <p><?php echo nl2br(htmlspecialchars($current_skill['description'])); ?></p>
                    
                    <p class="mt-3"><span class="detail-label">Category:</span> <?php echo htmlspecialchars($current_skill['category']); ?></p>
                    
                    <p><span class="detail-label">Level:</span> 
                        <span class="badge badge-<?php echo strtolower($current_skill['level']); ?>">
                            <?php echo htmlspecialchars($current_skill['level']); ?>
                        </span>
                    </p>
                    
                    <p><span class="detail-label">Rate:</span> $<?php echo ($current_skill['rate_per_hr']); ?>/hr</p>
                    
                    <div class="mt-4">
                        <a href="skills.php" class="btn btn-secondary">Back to Skills</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<?php include 'includes/footer.inc';
?>
