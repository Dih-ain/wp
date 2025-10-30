<?php 
include('includes/header.inc'); 
include('includes/db_connect.inc');

// Fetch 4 latest skills for carousel
$carousel_result = $conn->query("SELECT skill_id, title, image_path FROM skills ORDER BY created_at DESC LIMIT 4");
$carousel_skills = [];
while ($row = $carousel_result->fetch_assoc()) {
    $carousel_skills[] = $row;
}

// Fetch 4 latest skills for cards
$cards_result = $conn->query("SELECT skill_id, title, rate_per_hr FROM skills ORDER BY created_at DESC LIMIT 4");
$card_skills = [];
while ($row = $cards_result->fetch_assoc()) {
    $card_skills[] = $row;
}
?>

<main id="content">
    <section class="py-4">
        <div class="container">
            <h1 class="display-6 mb-1 text-accent">SkillSwap</h1>
            <p class="text-muted mb-0">Browse the latest skills shared by our community.</p>
        </div>
    </section>

    <!-- Carousel -->
    <section class="py-4">
        <div class="container">
            <div id="homeCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <?php for ($i = 0; $i < count($carousel_skills); $i++): ?>
                        <button type="button" 
                                data-bs-target="#homeCarousel" 
                                data-bs-slide-to="<?php echo $i; ?>" 
                                <?php echo $i === 0 ? 'class="active" aria-current="true"' : ''; ?> 
                                aria-label="Slide <?php echo $i + 1; ?>"></button>
                    <?php endfor; ?>
                </div>
                <div class="carousel-inner">
                    <?php foreach ($carousel_skills as $index => $skill): ?>
                        <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                            <div class="carousel-img-wrapper">
                                <img src="<?php echo htmlspecialchars($skill['image_path']); ?>" 
                                     class="d-block w-100" 
                                     alt="<?php echo htmlspecialchars($skill['title']); ?>">
                            </div>
                            <div class="carousel-caption d-none d-md-block">
                                <h5><?php echo htmlspecialchars($skill['title']); ?></h5>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#homeCarousel" data-bs-slide="prev" aria-label="Previous slide">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#homeCarousel" data-bs-slide="next" aria-label="Next slide">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>

    <!-- Skill cards -->
    <section class="pb-5">
        <div class="container">
            <div class="row text-center">
                <?php foreach ($card_skills as $skill): ?>
                    <div class="col-12 col-sm-6 col-lg-3 mb-4">
                        <h3 class="h6">
                            <a href="details.php?id=<?php echo $skill['skill_id']; ?>" class="skill-link">
                                <?php echo htmlspecialchars($skill['title']); ?>
                            </a>
                        </h3>
                        <p class="small text-muted">Offered by <?php 
                        // Fetch username for this skill
                        $user_stmt = $conn->prepare("SELECT u.username FROM users u JOIN skills s ON u.user_id = s.user_id WHERE s.skill_id = ?");
                        $user_stmt->bind_param("i", $skill['skill_id']);
                        $user_stmt->execute();
                        $user_result = $user_stmt->get_result();
                        $user_data = $user_result->fetch_assoc();
                        $user_stmt->close();
                        echo strtolower(htmlspecialchars($user_data['username'])); 
                        ?></p>
                        <p class="small">Rate: $<?php echo number_format($skill['rate_per_hr'], 2); ?>/hr</p>
                        <a class="btn btn-accent" href="details.php?id=<?php echo $skill['skill_id']; ?>">View Details</a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</main>

<?php include('includes/footer.inc'); ?>