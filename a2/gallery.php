<?php include('includes/header.inc'); ?>

<body class = "bg-light-orange">
    
  
  <!-- Main -->
  <main class="container my-5">
    <h2 class="mb-4 text-accent">Skill Gallery</h2>
    <div class="row align-items-start">


 <div class="row g-4" id="skillsGrid">

<div class="col-lg-3 col-md-4 col-6 col-sm-12">
        <a href="#" class="gallery-link" data-bs-toggle="modal" data-bs-target="#galleryModal" data-bs-image="assets/images/skills/1.png">
          <img src="assets/images/skills/1.png" class="img-fluid" alt="Skill 1">
        </a>
        <p class="mt-2 fw-bold">Beginner Guitar Lessons</p>
      </div>

<div class="col-lg-3 col-md-4 col-6">
        <a href="#" class="gallery-link" data-bs-toggle="modal" data-bs-target="#galleryModal" data-bs-image="assets/images/skills/2.png">
          <img src="assets/images/skills/2.png" class="img-fluid" alt="Skill 2">
        </a>
        <p class="mt-2 fw-bold">Intermediate Fingerstyle</p>
      </div>

<div class="col-lg-3 col-md-4 col-6">
        <a href="#" class="gallery-link" data-bs-toggle="modal" data-bs-target="#galleryModal" data-bs-image="assets/images/skills/3.png">
          <img src="assets/images/skills/3.png" class="img-fluid" alt="Skill 3">
        </a>
        <p class="mt-2 fw-bold">Artisan Bread Baking</p>
      </div>

      <div class="col-lg-3 col-md-4 col-6">
        <a href="#" class="gallery-link" data-bs-toggle="modal" data-bs-target="#galleryModal" data-bs-image="assets/images/skills/4.png">
          <img src="assets/images/skills/4.png" class="img-fluid" alt="Skill 4">
        </a>
        <p class="mt-2 fw-bold">French Pastry Making</p>
      </div>
      
      <div class="col-lg-3 col-md-4 col-6">
        <a href="#" class="gallery-link" data-bs-toggle="modal" data-bs-target="#galleryModal" data-bs-image="assets/images/skills/5.png">
          <img src="assets/images/skills/5.png" class="img-fluid" alt="Skill 5">
        </a>
        <p class="mt-2 fw-bold">Watercolor Basics</p>
      </div>

      <div class="col-lg-3 col-md-4 col-6">
        <a href="#" class="gallery-link" data-bs-toggle="modal" data-bs-target="#galleryModal" data-bs-image="assets/images/skills/6.png">
          <img src="assets/images/skills/6.png" class="img-fluid" alt="Skill 6">
        </a>
        <p class="mt-2 fw-bold">Digital Illustration With Procreate</p>
      </div>

      <div class="col-lg-3 col-md-4 col-6">
        <a href="#" class="gallery-link" data-bs-toggle="modal" data-bs-target="#galleryModal" data-bs-image="assets/images/skills/7.png">
          <img src="assets/images/skills/7.png" class="img-fluid" alt="Skill 7">
        </a>
        <p class="mt-2 fw-bold">Morning Vinyasa Flow</p>
      </div>

      <div class="col-lg-3 col-md-4 col-6">
        <a href="#" class="gallery-link" data-bs-toggle="modal" data-bs-target="#galleryModal" data-bs-image="assets/images/skills/8.png">
          <img src="assets/images/skills/8.png" class="img-fluid" alt="Skill 8">
        </a>
        <p class="mt-2 fw-bold">Intro To PHP & MySQL</p>
      </div>
            </div>
        </div>
    </main>

    <!-- Skill Detail Modal -->
  <div class="modal fade" id="galleryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content bg-transparent border-0">
        <img src="assets/images/skills/1.png" id="galleryModalImage" class="img-fluid rounded" alt="Gallery Preview">
      </div>
    </div>
  </div>


    <?php include('includes/footer.inc'); ?>