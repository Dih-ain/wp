<?php include('includes/header.inc');
include('includes/db_connect.inc');
include('process_add.php'); ?>


    <main class="main-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8 col-sm-10">
                    <div class="form-container">
                        <h1 class="page-title text-accent">Add New Skill</h1>
                        
                        <form id="addSkillForm" method="post" action="add.php" enctype="multipart/form-data" novalidate>
                            
                            <!-- Title Field -->
                            <div class="form-group">
                                <label for="title" class="form-label">Title *</label>
                                <input type="text" 
                                       class="form-control form-input" 
                                       id="title" 
                                       name="title"
                                       placeholder="Enter skill title" 
                                       required>
                                <div class="invalid-feedback">Please provide a valid title.</div>
                            </div>

                            <!-- Description Field -->
                            <div class="form-group">
                                <label for="description" class="form-label">Description *</label>
                                <textarea class="form-control form-input textarea-input" 
                                          id="description" 
                                          name="description"
                                          rows="4" 
                                          placeholder="Enter Description" 
                                          required></textarea>
                                <div class="invalid-feedback">Please provide a description.</div>
                            </div>

                            <!-- Category Field -->
                            <div class="form-group">
                                <label for="category" class="form-label">Category *</label>
                                <input type="text" 
                                       class="form-control form-input" 
                                       id="category" 
                                       name="category"
                                       placeholder="Enter skill category" 
                                       required>
                                <div class="invalid-feedback">Please provide a valid category.</div>
                            </div>

                            <!-- Rate per Hour Field -->
                            <div class="form-group">
                                <label for="rate" class="form-label">Rate per Hour ($) *</label>
                                <input type="number" 
                                       class="form-control form-input" 
                                       id="rate" 
                                       name="rate"
                                       placeholder="Enter rate per hour" 
                                       min="0" 
                                       step="0.01" 
                                       required>
                                <div class="invalid-feedback">Please provide a valid rate.</div>
                            </div>

                            <!-- Level Field -->
                            <div class="form-group">
                                <label for="level" class="form-label">Level *</label>
                                <select class="form-select form-input" 
                                        id="level" 
                                        name="level"
                                        required>
                                    <option value="" selected>Please select</option>
                                    <option value="beginner">Beginner</option>
                                    <option value="intermediate">Intermediate</option>
                                    <option value="advanced">Advanced</option>
                                    <option value="expert">Expert</option>
                                </select>
                                <div class="invalid-feedback">Please select a level.</div>
                            </div>

                            <!-- Skill Image Field -->
                            <div class="form-group">
                                <label for="image" class="form-label">Skill Image *</label>
                                <div class="file-input-wrapper">
                                    <input type="file" 
                                           class="form-control form-input file-input" 
                                           id="image" 
                                           name="image"
                                           accept=".jpg,.jpeg,.png,.gif,.webp" 
                                           required>

                                </div>
                                <div class="invalid-feedback" id="imageError">Please select a valid image file.</div>
                            </div>

                            <!-- Submit Button -->
                            <div class="form-group submit-group">
                                <button type="submit" class="btn btn-accent btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

<?php include('includes/footer.inc'); ?>
