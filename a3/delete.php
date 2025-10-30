<?php 
$title = "Delete Skill";
include('includes/header.inc');
include('includes/db_connect.inc');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    $_SESSION['flash_message'] = 'Please login to delete skills.';
    $_SESSION['flash_type'] = 'warning';
    header("Location: login.php");
    exit();
}

// Get skill ID
$skill_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($skill_id === 0) {
    $_SESSION['flash_message'] = 'Invalid skill ID.';
    $_SESSION['flash_type'] = 'danger';
    header("Location: skills.php");
    exit();
}

// Fetch skill with prepared statement
$stmt = $conn->prepare("SELECT * FROM skills WHERE skill_id = ?");
$stmt->bind_param("i", $skill_id);
$stmt->execute();
$result = $stmt->get_result();
$skill = $result->fetch_assoc();
$stmt->close();

if (!$skill) {
    $_SESSION['flash_message'] = 'Skill not found.';
    $_SESSION['flash_type'] = 'danger';
    header("Location: skills.php");
    exit();
}

// Check if user owns this skill
if ($skill['user_id'] != $_SESSION['user_id']) {
    $_SESSION['flash_message'] = 'You do not have permission to delete this skill.';
    $_SESSION['flash_type'] = 'danger';
    header("Location: details.php?id=" . $skill_id);
    exit();
}

include('process_delete.php'); 
?>

<!-- Delete Confirmation Modal -->
<div class="modal fade show" id="deleteModal" tabindex="-1" style="display: block; background-color: rgba(0,0,0,0.5);">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Deletion</h5>
                <button type="button" class="btn-close" onclick="window.location.href='details.php?id=<?php echo $skill_id; ?>'" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to permanently delete <strong><?php echo htmlspecialchars($skill['title']); ?></strong>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="window.location.href='details.php?id=<?php echo $skill_id; ?>'">Cancel</button>
                <form method="post" action="delete.php?id=<?php echo $skill_id; ?>" style="display: inline;">
                    <button type="submit" name="confirm_delete" class="btn btn-danger">Yes, Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.inc'); ?>