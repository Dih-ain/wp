<footer class="footer-grad py-4 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <?php
                // Fetch all usernames for footer
                $users_result = $conn->query("SELECT username FROM users ORDER BY username");
                $usernames = [];
                while ($user = $users_result->fetch_assoc()) {
                    $usernames[] = $user['username'];
                }
                ?>
                <p class="mb-0">
                    <?php echo implode(' ', array_map('htmlspecialchars', $usernames)); ?>
                </p>
            </div>
            <div class="col-md-6 text-md-end">
                <p class="mb-0">&copy; <?php echo date('Y'); ?> SkillSwap. All rights reserved.</p>
            </div>
        </div>
    </div>
</footer>

<!-- Bootstrap 5 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom JS -->
<script src="assets/js/scripts.js"></script>
</body>
</html>