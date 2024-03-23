<?php
  session_start();

  // Include settings and database connection
  require_once("./settings.php");

  // Retrieve the JobID
  $JobID = $_GET['JobID'];
  $check = $conn->query("SELECT * FROM s104181721_db.RecruiterInterview WHERE JobID = '$JobID';");

  // Check if any rows were returned
  if ($check->num_rows > 0) {
    // Redirect to another page after form submission
    header("Location: reinterviewset.php?JobID=$JobID");
  } else {
    $UserAuthenticationID = $_SESSION['recruiter_ID'];
    $recruiter = $conn->query("SELECT * FROM s104181721_db.Recruiter WHERE UserAuthenticationID = '$UserAuthenticationID';");
    $recruiter_data = mysqli_fetch_assoc($recruiter);
    $RecruiterID = $recruiter_data['RecruiterID'];

    $job = $conn->query("SELECT * FROM s104181721_db.Job WHERE JobID = '$JobID';");
    $job_data = mysqli_fetch_assoc($job);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Get form data
      $ID = $_POST['ID'];
      $DateStart = $_POST['date_start'];
      $DateEnd = $_POST['date_end'];
      $TimeStart = $_POST['time_start'];
      $TimeEnd = $_POST['time_end'];
      $LinkMeeting = $_POST['link'];
  
      // Execute the query
      $conn->query("INSERT INTO s104181721_db.RecruiterInterview (JobID, DateStart, DateEnd, TimeStart, TimeEnd, LinkMeeting)
        VALUES ('$ID', '$DateStart', '$DateEnd', '$TimeStart', '$TimeEnd', '$LinkMeeting');");

      // Redirect to the appropriate page
      header("Location: ./recruiter.php");
    }
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
  <title>Recruiter - Book Interview Schedule Page</title>
</head>

<body>
  <header>

    <!-- Navigation Bar -->

    <a href="pagenotfound.html"><img alt="Logo" src="images/Logo.png" class="logo"></a>

    <nav class="navbar">
      <a href="pagenotfound.html">Home</a>
      <a href="pagenotfound.html">About</a>
    </nav>

    <div class="icons">
      <ul>
        <?php while ($row = mysqli_fetch_assoc($recruiter)) { ?>
          <li><a href="recruiter.php"><img src="<?php echo $row['CompanyImage']; ?>"></a></li>
        <?php } ?>
        <li><a href="login.php"><img src="icons/Logout.svg"></a></li>
      </ul>
    </div>

  </header>

  <!-- MAIN CONTENT -->
  <main>
    <div class="bwp-contents">
      <!--Navigation Button-->
      <div class="bwp-nav">
        <a href="javascript:history.back()"><img src="icons/Navigation.svg"></a> <!--Come Back Page-->
        <h1>Set Available Interview Time</h1>
      </div>

      <!--Interview Details-->
      <div class="bwp-interview-details">
        <!--Job Applied Card-->
        <div class="bwp-interview-schedule">
          <div class="bwp-card">
            <?php if ($job_data) { ?>
              <div class="sp-image-box">
                <img src="<?php echo $job_data['JobImage']; ?>" alt="product.png">
              </div>
              <div class="sp-product-details">
                <div class="type">
                  <h6><?php echo $job_data['JobTitle']; ?></h6>
                </div>
                <div class="sp-product-require">
                  <ul>
                    <li><img src="icons/Location.svg"> <?php echo $job_data['WorkLocation']; ?></li>
                    <li><img src="icons/Fee.svg"> <?php echo $job_data['Salary']; ?> AUD$ </li>
                    <li><img src="icons/ExperienceLevel.svg"> <?php echo $job_data['ExperienceLevel']; ?></li>
                    <li><img src="icons/WorkingMode.svg"> <?php echo $job_data['WorkingFormat']; ?></li>
                  </ul>
                </div>
              </div>
            <?php } ?>
          </div>
        </div>

        <!--Job Applied Schedule-->
        <form class="bwp-interview-schedule" action="reinterviewbook.php" method="post">
          <div class="bwp-interview-setup">
            <div class="bgp-interview-picktime">

            <?php if ($job_data) { ?>
              <input name="ID" value="<?php echo $job_data['JobID']; ?>" hidden>
            <?php } ?>

              <!--Set Interview Date-->
              <div class="bgp-interview-button">
                <div class="bwp-interview-picked">
                  <span class="bwp-interview-icon"><img src="icons/TimeDate.svg"></span>
                  <input name="date_start" type="text" class="bwp-input" placeholder="yyyy-mm-dd" required>
                </div>
                <span class="bgp-link-point"> - </span>
                <div class="bwp-interview-picked">
                  <span class="bwp-interview-icon"><img src="icons/TimeDate.svg"></span>
                  <input name="date_end" type="text" class="bwp-input" placeholder="yyyy-mm-dd" required>
                </div>
              </div>

              <!--Set Interview Hour-->
              <div class="bgp-interview-button">
                <div class="bwp-interview-picked">
                  <span class="bwp-interview-icon"><img src="icons/TimeClock.svg"></span>
                  <input name="time_start" type="text" class="bwp-input" placeholder="00:00" required>
                </div>
                <span class="bgp-link-point"> - </span>
                <div class="bwp-interview-picked">
                  <span class="bwp-interview-icon"><img src="icons/TimeClock.svg"></span>
                  <input name="time_end" type="text" class="bwp-input" placeholder="00:00" required>
                </div>
              </div>

              <!--Set URL Link-->
              <div class="bgp-interview-button">
                <div class="bgp-interview-picked">
                  <span class="bwp-interview-icon"><img src="icons/Link_B.svg"></span>
                  <input name="link" type="text" class="bwp-input" placeholder="Interview Meeting Room Link" required>
                </div>
              </div>

              <!--Submit Button-->
              <div class="bwp-submit-box">
                <button type="submit" class="bwp-submit-btn">Set Available Time</button>
              </div>
            </div>
          </div>
        </form>
        <!---->
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