<?php include('includes/header.inc');
include('includes/db_connect.inc');  ?>
   
  
  <!-- Main -->
  <main class="container my-5">
    <h2 class="mb-4 text-accent">Skill Gallery</h2>
    <div class="row align-items-start">


 <div class="row g-4" id="skillsGrid">

      <?php
      $result = $conn->query("SELECT skill_id, title, image_path FROM skills ORDER BY created_at DESC");
      while ($row = $result->fetch_assoc()) {
        echo <<< CDATA
        <div class="col-md-3 col-sm-6 text-center">
          <img src="{$row['image_path']}" class="img-fluid rounded img-slight-shadow gallery-img" alt="{$row['title']}">
          <p class="mt-2 fw-bold"><a href="details.php?id={$row['skill_id']}">{$row['title']}</a></p>
        </div>
        CDATA;
      }
      ?>
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