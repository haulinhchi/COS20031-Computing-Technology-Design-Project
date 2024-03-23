<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
  session_start();

  // Include settings and database connection
  require_once("./settings.php");

  $UserAuthenticationID = $_SESSION['job_seeker_ID'];
  $job_seeker = $conn->query("SELECT * FROM s104181721_db.JobSeeker WHERE UserAuthenticationID = '$UserAuthenticationID';");

  $js_job = $job_seeker->fetch_assoc();
  $JSJobTitle = $js_job['JSJobTitle'];

  if (stripos($JSJobTitle, 'bar') !== false) {
    $sug_job = $conn->query("SELECT * FROM s104181721_db.Job WHERE JobSpecialization = 'F&B';");
  } elseif (stripos($JSJobTitle, 'ist') !== false) {
    $sug_job = $conn->query("SELECT * FROM s104181721_db.Job WHERE JobSpecialization = 'Beauty & Spa';");
  } elseif (stripos($JSJobTitle, 'Tour') !== false) {
    $sug_job = $conn->query("SELECT * FROM s104181721_db.Job WHERE JobSpecialization = 'Tourism & Hospitality';");
  } else {
    $sug_job = $conn->query("SELECT * FROM s104181721_db.Job;");
  }

  // Initialize the WHERE clause for filtering
  $whereClause = "1"; // Default condition to select all jobs

  // Check if filter form is submitted
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // EXPERIENCE LEVEL
    $experienceLevels = $_POST['jopfilter_el'];
    if (!empty($experienceLevels)) {
      $whereClause .= " AND ExperienceLevel = '$experienceLevels'";
    }

    // WORKING FORMAT
    $workingFormats = $_POST['jopfilter_wf'];
    if (!empty($workingFormats)) {
      $whereClause .= " AND WorkingFormat = '$workingFormats'";
    }

    // SPECIALIZATION
    $specializations = $_POST['jopfilter_s'];
    if (!empty($specializations)) {
      $whereClause .= " AND JobSpecialization = '$specializations'";
    }

    if ($whereClause == 1) {
      // Query to fetch jobs based on filter conditions
      $filter_job = $conn->query("SELECT * FROM s104181721_db.Job");
    } else {
      $filter_job = $conn->query("SELECT * FROM s104181721_db.Job WHERE $whereClause");
    }

  } else {
    $filter_job = $conn->query("SELECT * FROM s104181721_db.Job");
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="description" content="COS20031 Computing Technology Design Project">
  <meta name="author" content="Lo Tuan Hung, Luong Chi Duc, Nguyen Vu Duy Minh, Hau Linh Chi, Dao Khanh Nga Thi">
  <link href="styles/style.css" rel="stylesheet">
  <link rel="icon" href="images/Favicon-02.png" type="image/x-icon">
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
  <script src="https://kit.fontawesome.com/f73039f1ad.js" crossorigin="anonymous"></script>

  <link href="styles/lightslider.css" rel="stylesheet" type="text/css">
  <script src="js/jquery.js"></script>
  <script src="js/lightslider.js"></script>
  <script src="js/script.js"></script>
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css">
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <title>Job Opportunities Page</title>
</head>

<body>

  <header>

    <!-- Navigation Bar -->

    <a href="pagenotfound.html"><img alt="Logo" src="images/Logo.png" class="logo"></a>

    <nav class="navbar">
      <a href="pagenotfound.html">Home</a>
      <a href="pagenotfound.html">About</a>
      <a href="courses.php">Courses</a>
      <a href="jobopportunities.php" class="btn_active">Job Opportunities</a>
    </nav>

    <div class="icons">
      <ul>
        <?php if ($js_job) { ?>
          <li><a href="jobseeker.php"><img src="<?php echo $js_job['JSImage']; ?>"></a></li>
        <?php } ?>
        <li><a href="login.php"><img src="icons/Logout.svg"></a></li>
      </ul>
    </div>

  </header>

  <main>

    <section class="jop-contents">
      <h1>Job opportunities</h1>

      <!-- First Course Group -->

      <div class="cp-box-container">
        <div class="header">
          <h5>Suggested for you</h5>
        </div>
        <ul class="autoWidth" class="cs-hidden">
          <?php while ($row = mysqli_fetch_assoc($sug_job)) { ?>
            <!-- Card 1 -->
            <li class="slide">
              <div class="sp-card">
                <div class="sp-image-box">
                  <img src="<?php echo $row['JobImage']; ?>" alt="product.png">
                </div>
                <div class="sp-product-details">
                  <div class="type">
                    <h6>
                      <?php echo $row['JobTitle']; ?>
                    </h6>
                  </div>
                  <div class="sp-product-require">
                    <ul>
                      <li><img src="icons/Location.svg">
                        <?php echo $row['WorkLocation']; ?>
                      </li>
                      <li><img src="icons/Fee.svg">
                        <?php echo $row['Salary']; ?> AUD$
                      </li>
                      <li><img src="icons/ExperienceLevel.svg">
                        <?php echo $row['ExperienceLevel']; ?>
                      </li>
                      <li><img src="icons/WorkingMode.svg">
                        <?php echo $row['WorkingFormat']; ?>
                      </li>
                    </ul>
                  </div>
                </div>
                <button class="sp-product-btn" onclick="location.href='pagenotfound.html'">Apply for this job</button>
              </div>
            </li>
          <?php } ?>
        </ul>
      </div>

      <!-- FILTER -->

      <button type="button" class="collapsible">Filter</button>

      <div class="content">
        <hr>
        <br>

        <div class="jop-filter">

          <form method="post" action="jobopportunities.php">

            <!-- EXPERIENCE LEVEL -->
            <div class="elevel">

              <p>Experience level</p>

              <label><input class="jopfilter" type="radio" name="jopfilter_el" value="Internship">
                <span>Internship</span></label>

              <label><input class="jopfilter" type="radio" name="jopfilter_el" value="Entry">
                <span>Entry</span></label>

              <label><input class="jopfilter" type="radio" name="jopfilter_el" value="Junior">
                <span>Junior</span></label>

              <label><input class="jopfilter" type="radio" name="jopfilter_el" value="Senior">
                <span>Senior</span></label>

            </div>
            <br>

            <!-- WORKING FORMAT -->
            <div class="wformat">

              <p>Working format</p>

              <label><input class="jopfilter" type="radio" name="jopfilter_wf" value="remote">
                <span>Remote</span></label>

              <label><input class="jopfilter" type="radio" name="jopfilter_wf" value="hybrid">
                <span>Hybrid</span></label>

              <label><input class="jopfilter" type="radio" name="jopfilter_wf" value="online">
                <span>Online</span></label>

              <label><input class="jopfilter" type="radio" name="jopfilter_wf" value="offline">
                <span>Offline</span></label>

              <label><input class="jopfilter" type="radio" name="jopfilter_wf" value="flexible">
                <span>Flexible</span></label>
            </div>
            <br>


            <!-- SPECIALISATION -->
            <div class="specialisation">

              <p>Specialisation</p>

              <label><input class="jopfilter" type="radio" name="jopfilter_s" value="beauty&spa">
                <span>Beauty & Spa</span></label>

              <label><input class="jopfilter" type="radio" name="jopfilter_s" value="f&b">
                <span>F&B</span></label>

              <label><input class="jopfilter" type="radio" name="jopfilter_s" value="tourism&hospitality">
                <span>Tourism & Hospitality</span></label>

            </div>

            <br>
            <!-- SUBMIT, CLEAR BUTTON -->
            <input class="jopsubmit" type="submit" value="Apply filter">
            <input class="jopclear" type="reset" value="Clear">

          </form>
        </div>
      </div>

      <!-- Second Course Group -->
      <div class="jop-slider">
        <div class="cp-box-container">
          <div class="header">
            <h5>All job opportunities</h5>
          </div>
          <ul class="autoWidth" class="cs-hidden">
            <?php while ($row = mysqli_fetch_assoc($filter_job)) { ?>
              <!-- Card 1 -->
              <li class="slide">
                <div class="sp-card">
                  <div class="sp-image-box">
                    <img src="<?php echo $row['JobImage']; ?>" alt="product.png">
                  </div>
                  <div class="sp-product-details">
                    <div class="type">
                      <h6>
                        <?php echo $row['JobTitle']; ?>
                      </h6>
                    </div>
                    <div class="sp-product-require">
                      <ul>
                        <li><img src="icons/Location.svg">
                          <?php echo $row['WorkLocation']; ?>
                        </li>
                        <li><img src="icons/Fee.svg">
                          <?php echo $row['Salary']; ?> AUD$
                        </li>
                        <li><img src="icons/ExperienceLevel.svg">
                          <?php echo $row['ExperienceLevel']; ?>
                        </li>
                        <li><img src="icons/WorkingMode.svg">
                          <?php echo $row['WorkingFormat']; ?>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <button class="sp-product-btn" onclick="location.href='pagenotfound.html'">Apply for this job</button>
                </div>
              </li>
            <?php } ?>
          </ul>
        </div>
      </div>

    </section>

  </main>

  <!--Back to top button-->
  <div>
    <a href="#" title="Back to top">
      <i class="uil uil-arrow-up" id="gotopbtn"></i>
    </a>
  </div>

  <footer>
    <div class="container">
      <div class="row">

        <!-- First column -->

        <div class="footer_col">
          <a href="pagenotfound.html"><img alt="Logo" src="images/Logo_footer.png" class="logo"></a>
          <br><br>
          <h4>Contact information</h4>
          <ul>
            <li>Main branch</li>
            <li><i class="fa-solid fa-location-dot"></i> P2 – 12A Eastern Park 2 Thạch Bàn,<br>Long Biên District, Hà
              Nội</li>
            <li><i class="fa-solid fa-phone"></i> (+84)98.499.65.98</li>
          </ul>
        </div>

        <!-- Second column -->

        <div class="footer_col">
          <h4>Navigation</h4>
          <ul>
            <li><a href="pagenotfound.html">Home</a></li>
            <li><a href="pagenotfound.html">About</a></li>
            <li><a href="courses.php">Courses</a></li>
            <li><a href="jobopportunities.php">Job Opportunities</a></li>
          </ul>
        </div>

        <!-- Third column -->

        <div class="footer_col">
          <h4>Contact us</h4>
          <form action="#">
            <input type="text" placeholder="Your name" class="inputName">
            <input type="text" placeholder="Your phone number" class="inputNumber">
            <input type="email" placeholder="Your email" class="inputEmail">
            <textarea placeholder="Message" class="textareaMessage"></textarea>
            <input type="submit" value="Submit" class="inputSubmit">
          </form>
        </div>
      </div>
    </div>
  </footer>


  <script>
    document.addEventListener("DOMContentLoaded", function() {
      var coll = document.getElementsByClassName("collapsible");
      var i;
      for (i = 0; i < coll.length; i++) {
        coll[i].classList.add("active")
        var content = coll[i].nextElementSibling;
        content.style.display = "block";
      }

      for (i = 0; i < coll.length; i++) {
        coll[i].addEventListener("click", function() {
          this.classList.toggle("active");
          var content = this.nextElementSibling;
          if (content.style.display === "block") {
            content.style.display = "none";
          } else {
            content.style.display = "block";
          }
        });
      }
    });
  </script>

</body>

</html>