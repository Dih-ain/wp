<?php 
$title = "Gallery";
include('includes/header.inc');
include('includes/db_connect.inc');

// Fetch all skills
$result = $conn->query("SELECT skill_id, title, category, image_path FROM skills ORDER BY created_at DESC");

// Get unique categories for filter
$categories_result = $conn->query("SELECT DISTINCT category FROM skills ORDER BY category");
$categories = [];
while ($row = $categories_result->fetch_assoc()) {
    $categories[] = $row['category'];
}
?>
   
<!-- Main -->
<main class="container my-5">
    <h2 class="mb-4 text-accent">Skill Gallery</h2>
    
    <!-- Category Filter Dropdown -->
    <div class="row mb-4">
        <div class="col-md-3">
            <label for="categoryFilter" class="form-label">Filter by category</label>
            <select class="form-select" id="categoryFilter">
                <option value="all">All</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?php echo htmlspecialchars($cat); ?>">
                        <?php echo htmlspecialchars($cat); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="row g-4" id="skillsGrid">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="col-md-3 col-sm-6 text-center" data-category="<?php echo htmlspecialchars($row['category']); ?>">
                <img src="<?php echo htmlspecialchars($row['image_path']); ?>" 
                     class="img-fluid rounded img-slight-shadow gallery-img" 
                     alt="<?php echo htmlspecialchars($row['title']); ?>">
                <p class="mt-2 fw-bold">
                    <a href="details.php?id=<?php echo $row['skill_id']; ?>" class="skill-link">
                        <?php echo htmlspecialchars($row['title']); ?>
                    </a>
                </p>
            </div>
        <?php endwhile; ?>
    </div>
</main>

<!-- Gallery Modal -->
<div class="modal fade" id="galleryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-transparent border-0">
            <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
            <img src="" id="galleryModalImage" class="img-fluid rounded" alt="Gallery Preview">
        </div>
    </div>
</div>

<?php include('includes/footer.inc'); ?>