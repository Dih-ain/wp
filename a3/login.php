<?php 
$title = "Login";
include('includes/header.inc');
include('includes/db_connect.inc');
include('process_login.php'); 
?>

<main class="main-content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7 col-sm-10">
                <div class="form-container">
                    <h1 class="page-title text-accent">Login</h1>
                    
                    <form id="loginForm" method="post" action="login.php" class="needs-validation" novalidate>
                        
                        <!-- Username or Email Field -->
                        <div class="form-group mb-3">
                            <label for="username" class="form-label">Username or Email *</label>
                            <input type="text" 
                                   class="form-control form-input" 
                                   id="username" 
                                   name="username"
                                   placeholder="Enter username or email" 
                                   required>
                            <div class="invalid-feedback">Please provide your username or email.</div>
                        </div>

                        <!-- Password Field -->
                        <div class="form-group mb-3">
                            <label for="password" class="form-label">Password *</label>
                            <input type="password" 
                                   class="form-control form-input" 
                                   id="password" 
                                   name="password"
                                   placeholder="Enter your password" 
                                   required>
                            <div class="invalid-feedback">Please provide your password.</div>
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group submit-group">
                            <button type="submit" class="btn btn-accent btn-primary submit-btn">Login</button>
                        </div>

                        <div class="text-center mt-3">
                            <p>Don't have an account? <a href="register.php" class="text-accent">Register here</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include('includes/footer.inc'); ?>
