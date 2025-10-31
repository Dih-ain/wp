<?php
session_start();
$title = "Skill Details";
include('includes/db_connect.inc');
include('includes/header.inc');

$skill_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($skill_id === 0) {
    $_SESSION['flash_message'] = 'Invalid skill ID.';
    $_SESSION['flash_type'] = 'danger';
    header("Location: skills.php");
    exit();
}

// Fetch skill with prepared statement
$stmt = $conn->prepare("SELECT s.*, u.username FROM skills s JOIN users u ON s.user_id = u.user_id WHERE s.skill_id = ?");
$stmt->bind_param("i", $skill_id);
$stmt->execute();
$result = $stmt->get_result();
$current_skill = $result->fetch_assoc();
$stmt->close();

if (!$current_skill) {
    $_SESSION['flash_message'] = 'Skill not found.';
    $_SESSION['flash_type'] = 'danger';
    header("Location: skills.php");
    exit();
}

$is_owner = isset($_SESSION['user_id']) && $_SESSION['user_id'] == $current_skill['user_id'];
?>

<main>
    <div class="container">
        <h1 class="mb-4 text-accent"><?php echo htmlspecialchars($current_skill['title']); ?></h1>
        
        <div class="detail-container">
            <div class="row">
                <div class="col-md-4">
                    <img src="<?php echo htmlspecialchars($current_skill['image_path']); ?>" 
                         alt="<?php echo htmlspecialchars($current_skill['title']); ?>" 
                         class="img-fluid rounded img-slight-shadow"
                         style="cursor: pointer;"
                         data-bs-toggle="modal"
                         data-bs-target="#imageModal">
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
                    
                    <p><span class="detail-label">Rate:</span> $<?php echo number_format($current_skill['rate_per_hr'], 2); ?>/hr</p>
                    
                    <p><span class="detail-label">Instructor:</span> 
                        <a href="instructor.php?id=<?php echo $current_skill['user_id']; ?>" class="skill-link">
                            <?php echo htmlspecialchars($current_skill['username']); ?>
                        </a>
                    </p>
                    
                    <div class="mt-4">
                        <a href="skills.php" class="btn btn-secondary">Back to Skills</a>
                        
                        <?php if ($is_owner): ?>
                            <a href="edit.php?id=<?php echo $skill_id; ?>" class="btn btn-warning">Edit Skill</a>
                            <a href="delete.php?id=<?php echo $skill_id; ?>" class="btn btn-danger">Delete Skill</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel"><?php echo htmlspecialchars($current_skill['title']); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="<?php echo htmlspecialchars($current_skill['image_path']); ?>" 
                     id="modalImage"
                     alt="<?php echo htmlspecialchars($current_skill['title']); ?>" 
                     class="img-fluid">
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.inc'; ?>