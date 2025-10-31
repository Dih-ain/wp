    <?php 
    session_start();
    include('includes/header.inc'); 
    include('includes/db_connect.inc');
    $sql = "SELECT skill_id, title, rate_per_hr,description,image_path FROM skills ORDER BY created_at DESC LIMIT 4";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $records = mysqli_fetch_all($result, MYSQLI_ASSOC);
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
            <button type="button" data-bs-target="#homeCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#homeCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#homeCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
            <button type="button" data-bs-target="#homeCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
          </div>
          <div class="carousel-inner">
            <?php foreach($records as $row){?>
              <div class="carousel-item active">
              <div class = "carousel-img-wrapper">
              <img src="<?php echo $row["image_path"]?>" class="d-block w-100" alt="French pastry piping cream">
              </div>
              <div class="carousel-caption d-none d-md-block"><h5><?php echo $row["title"]?></h5></div>
            </div>
          <?php  }?>
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
          <div class="col-12 col-sm-6 col-lg-3 mb-4">
            <h3 class="h6"><a href="skills.php" class="skill-link">Intro to PHP &amp; MySQL</a></h3>
            <p class="small">Rate: $55.00/hr</p>
            <a class="btn btn-accent" href="skills.php">View Details</a>
          </div>

          <div class="col-12 col-sm-6 col-lg-3 mb-4">
            <h3 class="h6"><a href="skills.php" class="skill-link">Intermediate Fingerstyle</a></h3>
            <p class="small">Rate: $45.00/hr</p>
            <a class="btn btn-accent" href="skills.php">View Details</a>
          </div>

          <div class="col-12 col-sm-6 col-lg-3 mb-4">
            <h3 class="h6"><a href="skills.php" class="skill-link">Artisan Bread Baking</a></h3>
            <p class="small">Rate: $25.00/hr</p>
            <a class="btn btn-accent" href="skills.php">View Details</a>
          </div>

          <div class="col-12 col-sm-6 col-lg-3 mb-4">
            <h3 class="h6"><a href="skills.php" class="skill-link">French Pastry Making</a></h3>
            <p class="small">Rate: $50.00/hr</p>
            <a class="btn btn-accent" href="skills.php">View Details</a>
          </div>
        </div>
      </div>
    </section>
  </main>

      <?php include('includes/footer.inc'); ?>