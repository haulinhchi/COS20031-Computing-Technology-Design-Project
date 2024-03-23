<?php
  session_start();

  // Include settings and database connection
  require_once("./settings.php");

  $UserAuthenticationID = $_SESSION['job_seeker_ID'];
  $job_seeker = $conn->query("SELECT * FROM s104181721_db.JobSeeker WHERE UserAuthenticationID = '$UserAuthenticationID';");

  $js_job = $job_seeker->fetch_assoc();
  $JSJobTitle = $js_job['JSJobTitle'];

  if (stripos($JSJobTitle, 'Bar') !== false) {
    $sug_course = $conn->query("SELECT * FROM s104181721_db.Course WHERE CourseCategory = 'F&B';");
  } elseif (stripos($JSJobTitle, 'ist') !== false) {
    $sug_course = $conn->query("SELECT * FROM s104181721_db.Course WHERE CourseCategory = 'Beauty & Spa';");
  } elseif (stripos($JSJobTitle, 'Tour') !== false) {
    $sug_course = $conn->query("SELECT * FROM s104181721_db.Course WHERE CourseCategory = 'Tourism & Hospitality';");
  } else {
    $sug_course = $conn->query("SELECT * FROM s104181721_db.Course;");
  }

  // Check if the filter form is submitted
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check and apply filter conditions based on user input
    $course_category = ($_POST["course_category"]);

    if ($course_category === 'All') {
      $whereClause = "1";
    } else {
      $whereClause = "CourseCategory = '$course_category'";
    }

    // Query to fetch courses based on filter conditions
    $filter_course = $conn->query("SELECT * FROM s104181721_db.Course WHERE $whereClause;");
    
  } else {
    $filter_course = $conn->query("SELECT * FROM s104181721_db.Course;");
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
  <title>Courses Page</title>
</head>

<body>
  <header>

    <!-- Navigation Bar -->

    <a href="pagenotfound.html"><img alt="Logo" src="images/Logo.png" class="logo"></a>

    <nav class="navbar">
      <a href="pagenotfound.html">Home</a>
      <a href="pagenotfound.html">About</a>
      <a href="courses.php" class="btn_active">Courses</a>
      <a href="jobopportunities.php">Job Opportunities</a>
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

    <section class="cp-contents">
      <h1>Courses</h1>

      <!-- First Course Group -->
      <div class="cp-box-container">
        <div class="header">
          <h5>Suggested for you</h5>
        </div>
        <hr>

        <ul class="autoWidth" class="cs-hidden">
          <?php while ($row = mysqli_fetch_assoc($sug_course)) { ?>
            <!-- Card 1 -->
            <li class="slide">
              <div class="sp-card">
                <div class="sp-image-box">
                  <img src="<?php echo $row['CourseImage']; ?>" alt="product.png">
                </div>
                <div class="sp-product-details">
                  <div class="type">
                    <h6>
                      <?php echo $row['Title']; ?>
                    </h6>
                  </div>
                  <div class="sp-product-require">
                    <ul>
                      <li><img src="icons/Time.svg">
                        <?php echo $row['Length']; ?> weeks
                      </li>
                      <li><img src="icons/Fee.svg">
                        <?php echo $row['Price']; ?> AUD$
                      </li>
                    </ul>
                  </div>
                </div>
                <button class="sp-product-btn" onclick="location.href='pagenotfound.html'">Register for this course</button>
              </div>
            </li>
          <?php } ?>
        </ul>
      </div>

      <!-- Second Course Group -->

      <div class="cp-box-container">
        <div class="header">
          <h5>All courses</h5>
        </div>
        <hr>

        <!-- Suggest Button-->
        <form method="post" action="courses.php" id="cp-search-buttons">
          <div id="form_check">
            <!-- Suggest Input-->
            <div>
              <label><input class="cp-suggested-btn" type="radio" name="course_category" value="All" id="All">
                <span>All</span></label>
              <label><input class="cp-suggested-btn" type="radio" name="course_category" value="F&B" id="FnB">
                <span>F&B</span></label>
              <label><input class="cp-suggested-btn" type="radio" name="course_category" value="Beauty & Spa" id="BeautynSpa">
                <span>Beauty & Spa</span></label>
              <label><input class="cp-suggested-btn" type="radio" name="course_category" value="Tourism & Hospitality" id="TourismHospitality">
                <span>Tourism & Hospitality</span></label>
            </div>

            <!--Submit button-->
            <div>
              <input class="cp-submit-btn" type="submit" value="Apply filter">
            </div>
          </div>
        </form>

        <ul class="autoWidth" class="cs-hidden">
          <?php while ($row = mysqli_fetch_assoc($filter_course)) { ?>
            <!-- Card 1 -->
            <li class="slide">
              <div class="sp-card">
                <div class="sp-image-box">
                  <img src="<?php echo $row['CourseImage']; ?>" alt="product.png">
                </div>
                <div class="sp-product-details">
                  <div class="type">
                    <h6>
                      <?php echo $row['Title']; ?>
                    </h6>
                  </div>
                  <div class="sp-product-require">
                    <ul>
                      <li><img src="icons/Time.svg">
                        <?php echo $row['Length']; ?> weeks
                      </li>
                      <li><img src="icons/Fee.svg">
                        <?php echo $row['Price']; ?> AUD$
                      </li>
                    </ul>
                  </div>
                </div>
                <button class="sp-product-btn" onclick="location.href='pagenotfound.html'">Register for this course</button>
              </div>
            </li>
          <?php } ?>
        </ul>
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

  <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

  <script>
    const swiper = new Swiper('.swiper', {
      autoplay: {
        delay: 3000,
        disableOnInteraction: false,
      },
      loop: true,

      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },

      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });

    AOS.init();
  </script>



</body>

</html>