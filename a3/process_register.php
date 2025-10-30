<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'])) {
    
    // Sanitize and validate input
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $bio = trim($_POST['bio'] ?? '');
    
    $errors = [];
    
    // Validation
    if (empty($username) || strlen($username) < 3 || strlen($username) > 50) {
        $errors[] = 'Username must be between 3 and 50 characters.';
    }
    
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Please provide a valid email address.';
    }
    
    if (empty($password) || strlen($password) < 6) {
        $errors[] = 'Password must be at least 6 characters.';
    }
    
    if ($password !== $confirm_password) {
        $errors[] = 'Passwords do not match.';
    }
    
    // Check if username or email already exists
    if (empty($errors)) {
        $stmt = $conn->prepare("SELECT user_id FROM users WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            $errors[] = 'Username or email already exists.';
        }
        $stmt->close();
    }
    
    // If no errors, create the user
    if (empty($errors)) {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // Insert user into database
        $stmt = $conn->prepare("INSERT INTO users (username, email, password, bio) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $email, $hashed_password, $bio);
        
        if ($stmt->execute()) {
            $_SESSION['flash_message'] = 'Registration successful! Please login.';
            $_SESSION['flash_type'] = 'success';
            $stmt->close();
            header("Location: login.php");
            exit();
        } else {
            $errors[] = 'Registration failed. Please try again.';
        }
        $stmt->close();
    }
    
    // Display errors
    if (!empty($errors)) {
        $_SESSION['flash_message'] = implode(' ', $errors);
        $_SESSION['flash_type'] = 'danger';
    }
}
?>