<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_delete'])) {
    
    // Check if user is logged in
    if (!isset($_SESSION['user_id'])) {
        $_SESSION['flash_message'] = 'You must be logged in to delete skills.';
        $_SESSION['flash_type'] = 'danger';
        header("Location: login.php");
        exit();
    }
    
    $user_id = $_SESSION['user_id'];
    $skill_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    
    if ($skill_id === 0) {
        $_SESSION['flash_message'] = 'Invalid skill ID.';
        $_SESSION['flash_type'] = 'danger';
        header("Location: skills.php");
        exit();
    }
    
    // Fetch skill with ownership verification
    $stmt = $conn->prepare("SELECT user_id, image_path FROM skills WHERE skill_id = ?");
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
    
    // Verify ownership
    if ($skill['user_id'] != $user_id) {
        $_SESSION['flash_message'] = 'You do not have permission to delete this skill.';
        $_SESSION['flash_type'] = 'danger';
        header("Location: skills.php");
        exit();
    }
    
    // Delete the skill from database
    $stmt = $conn->prepare("DELETE FROM skills WHERE skill_id = ? AND user_id = ?");
    $stmt->bind_param("ii", $skill_id, $user_id);
    
    if ($stmt->execute()) {
        // Delete the image file
        if (!empty($skill['image_path']) && file_exists($skill['image_path'])) {
            unlink($skill['image_path']);
        }
        
        $_SESSION['flash_message'] = 'Skill deleted successfully.';
        $_SESSION['flash_type'] = 'success';
        $stmt->close();
        header("Location: skills.php");
        exit();
    } else {
        $_SESSION['flash_message'] = 'Failed to delete skill.';
        $_SESSION['flash_type'] = 'danger';
        $stmt->close();
        header("Location: delete.php?id=" . $skill_id);
        exit();
    }
}
?>