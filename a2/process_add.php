<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $conn->real_escape_string($_POST['title']);
    $description = $conn->real_escape_string($_POST['description']);
    $category = $conn->real_escape_string($_POST['category']);
    $rate = (float)$_POST['rate'];
    $level = $conn->real_escape_string($_POST['level']);
    $image = trim($_FILES['image']['name']);
    $temp = $_FILES['image']['tmp_name'];
    $error = $_FILES['image']['error'];
    $type = $_FILES['image']['type'];
    $size = $_FILES['image']['size'];
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    $max_size = 10 * 1024 * 1024;
    $upload_dir = 'assets/images/skills/';
    $ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
    if ($error === 0 && in_array($type, $allowed_types) && $size < $max_size) {
        $stmt = $conn->prepare("INSERT INTO skills (title, description, category, rate_per_hr, level, image_path) VALUES (?, ?, ?, ?, ?, '')");
        $stmt->bind_param("sssss", $title, $description, $category, $rate, $level);
        $stmt->execute();
        $new_id = $stmt->insert_id;
        $stmt->close();
        $image_path = $upload_dir . $new_id . '.' . $ext;
        if (move_uploaded_file($temp, $image_path)) {
            $stmt = $conn->prepare("UPDATE skills SET image_path = ? WHERE skill_id = ?");
            $stmt->bind_param("si", $image_path, $new_id);
            $stmt->execute();
            $stmt->close();
            exit();
        } else {
            $conn->query("DELETE FROM skills WHERE skill_id = $new_id");
            echo '<div class="alert alert-danger">Image upload failed.</div>';
        }
    } else {
        echo '<div class="alert alert-danger">Invalid image file.</div>';
    }
}
?>