<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title'])) {
    
    // Check if user is logged in
    if (!isset($_SESSION['user_id'])) {
        $_SESSION['flash_message'] = 'You must be logged in to edit skills.';
        $_SESSION['flash_type'] = 'danger';
        header("Location: login.php");
        exit();
    }
    
    $user_id = $_SESSION['user_id'];
    $skill_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    
    // Verify ownership
    $stmt = $conn->prepare("SELECT user_id, image_path FROM skills WHERE skill_id = ?");
    $stmt->bind_param("i", $skill_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $existing_skill = $result->fetch_assoc();
    $stmt->close();
    
    if (!$existing_skill || $existing_skill['user_id'] != $user_id) {
        $_SESSION['flash_message'] = 'You do not have permission to edit this skill.';
        $_SESSION['flash_type'] = 'danger';
        header("Location: skills.php");
        exit();
    }
    
    // Sanitize input
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $category = trim($_POST['category']);
    $rate = (float)$_POST['rate'];
    $level = $_POST['level'];
    
    // Validate level
    $allowed_levels = ['Beginner', 'Intermediate', 'Expert'];
    if (!in_array($level, $allowed_levels)) {
        $_SESSION['flash_message'] = 'Invalid level selected.';
        $_SESSION['flash_type'] = 'danger';
        header("Location: edit.php?id=" . $skill_id);
        exit();
    }
    
    $image_path = $existing_skill['image_path'];
    
    // Check if new image uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $image = trim($_FILES['image']['name']);
        $temp = $_FILES['image']['tmp_name'];
        $type = $_FILES['image']['type'];
        $size = $_FILES['image']['size'];
        
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        $max_size = 10 * 1024 * 1024; // 10MB
        $upload_dir = 'assets/images/skills/';
        
        // Validate file
        if (!in_array($type, $allowed_types)) {
            $_SESSION['flash_message'] = 'Invalid image type. Allowed: JPG, PNG, GIF, WEBP.';
            $_SESSION['flash_type'] = 'danger';
            header("Location: edit.php?id=" . $skill_id);
            exit();
        }
        
        if ($size > $max_size) {
            $_SESSION['flash_message'] = 'Image file is too large. Maximum size: 10MB.';
            $_SESSION['flash_type'] = 'danger';
            header("Location: edit.php?id=" . $skill_id);
            exit();
        }
        
        // Get file extension
        $ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
        $new_image_path = $upload_dir . $skill_id . '.' . $ext;
        
        // Upload new image
        if (move_uploaded_file($temp, $new_image_path)) {
            // Delete old image if different
            if ($existing_skill['image_path'] !== $new_image_path && file_exists($existing_skill['image_path'])) {
                unlink($existing_skill['image_path']);
            }
            $image_path = $new_image_path;
        } else {
            $_SESSION['flash_message'] = 'Failed to upload new image.';
            $_SESSION['flash_type'] = 'danger';
            header("Location: edit.php?id=" . $skill_id);
            exit();
        }
    }
    
    // Update skill in database
    $stmt = $conn->prepare("UPDATE skills SET title = ?, description = ?, category = ?, rate_per_hr = ?, level = ?, image_path = ? WHERE skill_id = ? AND user_id = ?");
    $stmt->bind_param("sssdssii", $title, $description, $category, $rate, $level, $image_path, $skill_id, $user_id);
    
    if ($stmt->execute()) {
        $_SESSION['flash_message'] = 'Skill updated successfully!';
        $_SESSION['flash_type'] = 'success';
        $stmt->close();
        header("Location: details.php?id=" . $skill_id);
        exit();
    } else {
        $_SESSION['flash_message'] = 'Failed to update skill.';
        $_SESSION['flash_type'] = 'danger';
        $stmt->close();
        header("Location: edit.php?id=" . $skill_id);
        exit();
    }
}
?>