<?php 
session_start();
$title = "Search";
include('includes/header.inc');
include('includes/db_connect.inc');

$search_query = isset($_GET['q']) ? trim($_GET['q']) : '';
$results = [];

if (!empty($search_query)) {
    // Prepare search query for LIKE
    $search_term = '%' . $search_query . '%';
    
    // Search in title and description using prepared statement
    $stmt = $conn->prepare("SELECT s.skill_id, s.title, s.description, s.category, s.image_path, s.rate_per_hr, s.level, s.user_id, u.username FROM skills s JOIN users u ON s.user_id = u.user_id WHERE s.title LIKE ? OR s.description LIKE ? ORDER BY s.created_at DESC");
    $stmt->bind_param("ss", $search_term, $search_term);
    $stmt->execute();
    $result = $stmt->get_result();
    
    while ($row = $result->fetch_assoc()) {
        $results[] = $row;
    }
    $stmt->close();
}
?>

<main class="container my-5">
    <h1 class="mb-4 text-accent">Search Results</h1>
    
    <?php if (!empty($search_query)): ?>
        <p class="lead">Showing results for: <strong>"<?php echo htmlspecialchars($search_query); ?>"</strong></p>
        <p class="text-muted"><?php echo count($results); ?> skill(s) found</p>
    <?php else: ?>
        <div class="alert alert-info">
            Please enter a search term.
        </div>
    <?php endif; ?>

    <?php if (!empty($results)): ?>
        <div class="row g-4">
            <?php foreach ($results as $skill): ?>
                <div class="col-md-4 col-sm-6">
                    <div class="card skill-card h-100">
                        <img src="<?php echo htmlspecialchars($skill['image_path']); ?>" 
                             class="card-img-top" 
                             alt="<?php echo htmlspecialchars($skill['title']); ?>">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="details.php?id=<?php echo $skill['skill_id']; ?>" class="skill-link">
                                    <?php echo htmlspecialchars($skill['title']); ?>
                                </a>
                            </h5>
                            <p class="card-text small"><?php echo htmlspecialchars(substr($skill['description'], 0, 100)) . '...'; ?></p>
                            <p class="mb-1"><strong>Category:</strong> <?php echo htmlspecialchars($skill['category']); ?></p>
                            <p class="mb-1">
                                <strong>Level:</strong> 
                                <span class=" badge-<?php echo strtolower($skill['level']); ?>">
                                    <?php echo htmlspecialchars($skill['level']); ?>
                                </span>
                            </p>
                            <p class="mb-1"><strong>Rate:</strong> $<?php echo number_format($skill['rate_per_hr'], 2); ?>/hr</p>
                            <p class="mb-3 small">
                                <strong>By:</strong> 
                                <a href="instructor.php?id=<?php echo $skill['user_id']; ?>" class="skill-link">
                                    <?php echo htmlspecialchars($skill['username']); ?>
                                </a>
                            </p>
                            <a href="details.php?id=<?php echo $skill['skill_id']; ?>" class="btn btn-accent">View Details</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php elseif (!empty($search_query)): ?>
        <div class="alert alert-warning mt-4">
            No skills found matching your search.
        </div>
    <?php endif; ?>

    <div class="mt-4">
        <a href="skills.php" class="btn btn-secondary">View All Skills</a>
    </div>
</main>

<?php include('includes/footer.inc'); ?>
