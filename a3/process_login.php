<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'])) {
    
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    
    if (empty($username) || empty($password)) {
        $_SESSION['flash_message'] = 'Please provide both username/email and password.';
        $_SESSION['flash_type'] = 'danger';
    } else {
        // Check if user exists by username or email
        $stmt = $conn->prepare("SELECT user_id, username, password FROM users WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username, $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            
            // Verify password
            if (password_verify($password, $user['password'])) {
                // Login successful
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['flash_message'] = 'Welcome back, ' . htmlspecialchars($user['username']) . '!';
                $_SESSION['flash_type'] = 'success';
                
                $stmt->close();
                header("Location: index.php");
                exit();
            } else {
                $_SESSION['flash_message'] = 'Invalid username/email or password.';
                $_SESSION['flash_type'] = 'danger';
            }
        } else {
            $_SESSION['flash_message'] = 'Invalid username/email or password.';
            $_SESSION['flash_type'] = 'danger';
        }
        
        $stmt->close();
    }
}
?>