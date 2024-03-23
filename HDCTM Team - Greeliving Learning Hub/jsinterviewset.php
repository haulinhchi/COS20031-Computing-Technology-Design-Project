<?php
  session_start();

  // Include settings and database connection
  require_once("./settings.php");

  $UserAuthenticationID = $_SESSION['job_seeker_ID'];

  // Retrieve the JobID
  $JobID = $_GET['JobID'];

  $job_seeker = $conn->query("SELECT * FROM s104181721_db.JobSeeker WHERE UserAuthenticationID = '$UserAuthenticationID';");
  $job_seeker_data = mysqli_fetch_assoc($job_seeker);
  $JobSeekerID = $job_seeker_data['JobSeekerID'];

  $job = $conn->query("SELECT * FROM s104181721_db.Job WHERE JobID = '$JobID';");

  $js_interview = $conn->query("SELECT * FROM s104181721_db.JobSeekerInterview
    WHERE JobSeekerID = '$JobSeekerID' AND JobID = '$JobID';");
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
  <title>Job Seeker - View Interview Schedule Page</title>
</head>

<body>
  <header>

    <!-- Navigation Bar -->

    <a href="pagenotfound.html"><img alt="Logo" src="images/Logo.png" class="logo"></a>

    <nav class="navbar">
      <a href="pagenotfound.html">Home</a>
      <a href="pagenotfound.html">About</a>
      <a href="courses.php">Courses</a>
      <a href="jobopportunities.php">Job Opportunities</a>
    </nav>

    <div class="icons">
      <ul>
        <?php if ($job_seeker_data) { ?>
          <li><a href="jobseeker.php"><img src="<?php echo $job_seeker_data['JSImage']; ?>"></a></li>
        <?php } ?> <li><a href="login.php"><img src="icons/Logout.svg"></a></li>
      </ul>
    </div>

  </header>

  <!-- MAIN CONTENT -->
  <main>
    <div class="bwp-contents">
      <!--Navigation Button-->
      <div class="bwp-nav">
        <a href="javascript:history.back()"><img src="icons/Navigation.svg"></a> <!--Come Back Page-->
        <h1>Your Interview Schedule</h1>
      </div>

      <!--Interview Details-->
      <div class="bwp-interview-details">
        <!--Job Applied Card-->
        <div class="bwp-interview-schedule">
          <div class="bwp-card">
            <?php while ($row = mysqli_fetch_assoc($job)) { ?>
              <div class="sp-image-box">
                <img src="<?php echo $row['JobImage']; ?>" alt="product.png">
              </div>
              <div class="sp-product-details">
                <div class="type">
                  <h6><?php echo $row['JobTitle']; ?></h6>
                </div>
                <div class="sp-product-require">
                  <ul>
                    <li><img src="icons/Location.svg"> <?php echo $row['WorkLocation']; ?></li>
                    <li><img src="icons/Fee.svg"> <?php echo $row['Salary']; ?> AUD$</li>
                    <li><img src="icons/ExperienceLevel.svg"> <?php echo $row['ExperienceLevel']; ?></li>
                    <li><img src="icons/WorkingMode.svg"> <?php echo $row['WorkingFormat']; ?></li>
                  </ul>
                </div>
              </div>
            <?php } ?>
          </div>
        </div>
        <!--Job Applied Schedule-->
        <div class="bwp-interview-schedule">
          <div class="bwp-interview-setup">
            <div class="bwp-interview-available">
              <?php while ($row = mysqli_fetch_assoc($js_interview)) { ?>
                <h2><?php echo date('H:i', strtotime($row['InterviewTime'])) . ' (' . $row['InterviewDate'] . ')'; ?></h2>
              <?php } ?>
              <ul>Notes:
                <li>Each interview session last from 20 to 45 minutes</li>
                <li>Please be present at least 10 minutes early </li>
              </ul>
            </div>
            <div class="bwp-submit-box">
              <button type="submit" class="bwp-submit-btn">Join Interview Meeting Room</button>
            </div>
            <div class="interview-link">
              <a href="pagenotfound.html">Google Meet Link</a>
            </div>
          </div>
        </div>
      </div>
    </div>
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