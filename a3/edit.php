<?php 
session_start();
$title = "Edit Skill";
include('includes/header.inc');
include('includes/db_connect.inc');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    $_SESSION['flash_message'] = 'Please login to edit skills.';
    $_SESSION['flash_type'] = 'warning';
    header("Location: login.php");
    exit();
}

// Get skill ID
$skill_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($skill_id === 0) {
    $_SESSION['flash_message'] = 'Invalid skill ID.';
    $_SESSION['flash_type'] = 'danger';
    header("Location: skills.php");
    exit();
}

// Fetch skill with prepared statement
$stmt = $conn->prepare("SELECT * FROM skills WHERE skill_id = ?");
$stmt->bind_param("i", $skill_id);
$stmt->execute();
$result = $stmt->get_result();
$skill = $result->fetch_assoc();
$stmt->close();

if (!$skill) {
    $_SESSION['flash_message'] = 'Skill not found.';
    $_SESSION['flash_type'] = 'danger';
    header("Location: skills.php");
    exit();
}

// Check if user owns this skill
if ($skill['user_id'] != $_SESSION['user_id']) {
    $_SESSION['flash_message'] = 'You do not have permission to edit this skill.';
    $_SESSION['flash_type'] = 'danger';
    header("Location: details.php?id=" . $skill_id);
    exit();
}

include('process_edit.php'); 
?>

<main class="main-content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col-sm-10">
                <div class="form-container">
                    <h1 class="page-title text-accent">Edit Skill</h1>
                    
                    <form id="editSkillForm" method="post" action="edit.php?id=<?php echo $skill_id; ?>" enctype="multipart/form-data" novalidate>
                        
                        <!-- Title Field -->
                        <div class="form-group mb-3">
                            <label for="title" class="form-label">Title *</label>
                            <input type="text" 
                                   class="form-control form-input" 
                                   id="title" 
                                   name="title"
                                   value="<?php echo htmlspecialchars($skill['title']); ?>"
                                   placeholder="Enter skill title" 
                                   required>
                            <div class="invalid-feedback">Please provide a valid title.</div>
                        </div>

                        <!-- Description Field -->
                        <div class="form-group mb-3">
                            <label for="description" class="form-label">Description *</label>
                            <textarea class="form-control form-input textarea-input" 
                                      id="description" 
                                      name="description"
                                      rows="4" 
                                      placeholder="Enter Description" 
                                      required><?php echo htmlspecialchars($skill['description']); ?></textarea>
                            <div class="invalid-feedback">Please provide a description.</div>
                        </div>

                        <!-- Category Field -->
                        <div class="form-group mb-3">
                            <label for="category" class="form-label">Category *</label>
                            <input type="text" 
                                   class="form-control form-input" 
                                   id="category" 
                                   name="category"
                                   value="<?php echo htmlspecialchars($skill['category']); ?>"
                                   placeholder="Enter skill category" 
                                   required>
                            <div class="invalid-feedback">Please provide a valid category.</div>
                        </div>

                        <!-- Rate per Hour Field -->
                        <div class="form-group mb-3">
                            <label for="rate" class="form-label">Rate per Hour ($) *</label>
                            <input type="number" 
                                   class="form-control form-input" 
                                   id="rate" 
                                   name="rate"
                                   value="<?php echo htmlspecialchars($skill['rate_per_hr']); ?>"
                                   placeholder="Enter rate per hour" 
                                   min="0" 
                                   step="0.01" 
                                   required>
                            <div class="invalid-feedback">Please provide a valid rate.</div>
                        </div>

                        <!-- Level Field -->
                        <div class="form-group mb-3">
                            <label for="level" class="form-label">Level *</label>
                            <select class="form-select form-input" 
                                    id="level" 
                                    name="level"
                                    required>
                                <option value="">Please select</option>
                                <option value="Beginner" <?php echo $skill['level'] === 'Beginner' ? 'selected' : ''; ?>>Beginner</option>
                                <option value="Intermediate" <?php echo $skill['level'] === 'Intermediate' ? 'selected' : ''; ?>>Intermediate</option>
                                <option value="Expert" <?php echo $skill['level'] === 'Expert' ? 'selected' : ''; ?>>Expert</option>
                            </select>
                            <div class="invalid-feedback">Please select a level.</div>
                        </div>

                        <!-- Current Image Display -->
                        <div class="form-group mb-3">
                            <label class="form-label">Current Image</label>
                            <div>
                                <img src="<?php echo htmlspecialchars($skill['image_path']); ?>" 
                                     alt="<?php echo htmlspecialchars($skill['title']); ?>" 
                                     class="img-fluid rounded" 
                                     style="max-height: 150px;">
                            </div>
                        </div>

                        <!-- Skill Image Field (Optional for update) -->
                        <div class="form-group mb-3">
                            <label for="image" class="form-label">Replace Image (optional)</label>
                            <div class="file-input-wrapper">
                                <input type="file" 
                                       class="form-control form-input file-input" 
                                       id="image" 
                                       name="image"
                                       accept=".jpg,.jpeg,.png,.gif,.webp">
                            </div>
                            <div class="invalid-feedback" id="imageError">Please select a valid image file.</div>
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group submit-group">
                            <button type="submit" class="btn btn-accent btn-primary submit-btn">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include('includes/footer.inc'); ?>
