<?php
include('includes/db_connect.inc');
include('includes/header.inc');
$sql = "SELECT skill_id, title, category, level, rate_per_hr FROM skills ORDER BY created_at";
$records = $conn->query($sql);
$skill_id = isset($get['skill_id'])

 ?>
<body class="bg-light-orange">
  

  <!-- Main -->
  <main class="container my-5">
    <h1 class="mb-4 text-accent">All Skills</h1>
    <div class="row">
      <!-- Left banner -->
      <div class="col-lg-4 mb-4">
        <img src="assets/images/skills_banner.png" alt="Skills Banner" class="img-fluid">
      </div>

      <!-- Skills Table -->
      <div class="col-lg-8">
        <table class="table table-striped skills-table">
          <thead class="table-accent text-white">
            <tr>
              <th>Title</th>
              <th>Category</th>
              <th>Level</th>
              <th>Rate ($/hr)</th>
            </tr>
          </thead>
          <tbody>

            <?php foreach ($records as $row) {
                        echo '<tr>';
                        echo '<td><a href="details.php?skill_id=' . $row['skill_id'] . '" id="' . $row['skill_id'] . '" class="skillsTableLink">' . $row['title'] . '</a></td>';
                        echo '<td>' . $row['category'] . '</td>';
                        echo '<td>' . $row['level'] . '</td>';
                        echo '<td>' . $row['rate_per_hr'] . '</td>';
                        echo '</tr>';

                    }
            ?>
            
          </tbody>
        </table>
      </div>
    </div>
  </main>

  
      <?php include('includes/footer.inc'); ?>

      