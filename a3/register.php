<?php 
$title = "Register";
include('includes/header.inc');
include('includes/db_connect.inc');
include('process_register.php'); 
?>

<main class="main-content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col-sm-10">
                <div class="form-container">
                    <h1 class="page-title text-accent">Create Account</h1>
                    
                    <form id="registerForm" method="post" action="register.php" class="needs-validation" novalidate>
                        
                        <!-- Username Field -->
                        <div class="form-group mb-3">
                            <label for="username" class="form-label">Username *</label>
                            <input type="text" 
                                   class="form-control form-input" 
                                   id="username" 
                                   name="username"
                                   placeholder="Choose a username" 
                                   minlength="3"
                                   maxlength="50"
                                   required>
                            <div class="invalid-feedback">Please provide a username (3-50 characters).</div>
                        </div>

                        <!-- Email Field -->
                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Email *</label>
                            <input type="email" 
                                   class="form-control form-input" 
                                   id="email" 
                                   name="email"
                                   placeholder="Enter your email" 
                                   required>
                            <div class="invalid-feedback">Please provide a valid email address.</div>
                        </div>

                        <!-- Password Field -->
                        <div class="form-group mb-3">
                            <label for="password" class="form-label">Password *</label>
                            <input type="password" 
                                   class="form-control form-input" 
                                   id="password" 
                                   name="password"
                                   placeholder="Create a password" 
                                   minlength="6"
                                   required>
                            <div class="invalid-feedback">Password must be at least 6 characters.</div>
                        </div>

                        <!-- Confirm Password Field -->
                        <div class="form-group mb-3">
                            <label for="confirm_password" class="form-label">Confirm Password *</label>
                            <input type="password" 
                                   class="form-control form-input" 
                                   id="confirm_password" 
                                   name="confirm_password"
                                   placeholder="Confirm your password" 
                                   minlength="6"
                                   required>
                            <div class="invalid-feedback">Please confirm your password.</div>
                        </div>

                        <!-- Bio Field -->
                        <div class="form-group mb-3">
                            <label for="bio" class="form-label">Bio (Optional)</label>
                            <textarea class="form-control form-input textarea-input" 
                                      id="bio" 
                                      name="bio"
                                      rows="3" 
                                      placeholder="Tell us about yourself"></textarea>
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group submit-group">
                            <button type="submit" class="btn btn-accent btn-primary submit-btn">Register</button>
                        </div>

                        <div class="text-center mt-3">
                            <p>Already have an account? <a href="login.php" class="text-accent">Login here</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include('includes/footer.inc'); ?>
