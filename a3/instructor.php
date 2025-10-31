<?php
session_start();
$title = "Instructor Profile";
include('includes/header.inc');
include('includes/db_connect.inc');

// Get instructor ID
$instructor_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($instructor_id === 0) {
    $_SESSION['flash_message'] = 'Invalid instructor ID.';
    $_SESSION['flash_type'] = 'danger';
    header("Location: index.php");
    exit();
}

// Fetch instructor info
$stmt = $conn->prepare("SELECT user_id, username, email, bio, joined_at FROM users WHERE user_id = ?");
$stmt->bind_param("i", $instructor_id);
$stmt->execute();
$result = $stmt->get_result();
$instructor = $result->fetch_assoc();
$stmt->close();

if (!$instructor) {
    $_SESSION['flash_message'] = 'Instructor not found.';
    $_SESSION['flash_type'] = 'danger';
    header("Location: index.php");
    exit();
}

// Fetch instructor's skills
$stmt = $conn->prepare("SELECT skill_id, title, description, category, image_path, rate_per_hr, level FROM skills WHERE user_id = ? ORDER BY created_at DESC");
$stmt->bind_param("i", $instructor_id);
$stmt->execute();
$skills_result = $stmt->get_result();
$stmt->close();
?>

<main class="container my-5">
    <!-- Instructor Header -->
    <div class="mb-4">
        <h1 class="text-accent mb-3">Instructor: <?php echo strtolower(htmlspecialchars($instructor['username'])); ?></h1>
        <p class="instructor-bio"><?php echo nl2br(htmlspecialchars($instructor['bio'])); ?></p>
    </div>

    <!-- Instructor's Skills -->
    <h2 class="mb-4 text-accent">Skills Offered</h2>

    <?php if ($skills_result->num_rows > 0): ?>
        <div class="row g-4">
            <?php while ($skill = $skills_result->fetch_assoc()): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card skill-card h-100">
                        <img src="<?php echo htmlspecialchars($skill['image_path']); ?>" 
                             class="card-img-top" 
                             alt="<?php echo htmlspecialchars($skill['title']); ?>">
                        <div class="card-body">
                            <h5 class="card-title text-accent">
                                <?php echo htmlspecialchars($skill['title']); ?>
                            </h5>
                            <p class="mb-2"><strong>Rate:</strong> $<?php echo number_format($skill['rate_per_hr'], 2); ?>/hr</p>
                            <a href="details.php?id=<?php echo $skill['skill_id']; ?>" class="btn btn-accent">View</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <div class="alert alert-info">
            This instructor hasn't added any skills yet.
        </div>
    <?php endif; ?>
</main>

<?php include('includes/footer.inc'); ?>
