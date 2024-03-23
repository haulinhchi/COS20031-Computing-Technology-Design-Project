<?php
session_start();

// Include settings and database connection
require_once("./settings.php");

$UserAuthenticationID = $_SESSION['recruiter_ID'];
$user_email = $_SESSION['re_email'];

$recruiter = $conn->query("SELECT * FROM s104181721_db.Recruiter WHERE UserAuthenticationID = '$UserAuthenticationID';");
$recruiter_data = mysqli_fetch_assoc($recruiter);
$RecruiterID = $recruiter_data['RecruiterID'];

$job = $conn->query("SELECT * FROM s104181721_db.Job WHERE RecruiterID = '$RecruiterID';");

$application = $conn->query("SELECT 
      Application.*, 
      Job.*, 
      JobSeeker.* 
    FROM 
      s104181721_db.Application
      JOIN s104181721_db.Job ON Application.JobID = Job.JobID
      JOIN s104181721_db.JobSeeker ON Application.JobSeekerID = JobSeeker.JobSeekerID
    WHERE 
      Job.RecruiterID = '$RecruiterID';");

$interview = $conn->query("SELECT 
      Job.*, 
      RecruiterInterview.* 
    FROM 
      s104181721_db.Job
      JOIN s104181721_db.RecruiterInterview ON RecruiterInterview.JobID = Job.JobID
    WHERE 
      Job.RecruiterID = '$RecruiterID';");
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
  <title>Recruiter Profile Page</title>
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
        <?php if ($recruiter_data) { ?>
          <li><a href="recruiter.php"><img src="<?php echo $recruiter_data['CompanyImage'] ?>"></a></li>
        <?php } ?>
        <li><a href="login.php"><img src="icons/Logout.svg"></a></li>
      </ul>
    </div>
  </header>

  <!-- MAIN CONTENT -->
  <main>
    <h1 class="rpp-heading">
      Profile
    </h1>
    <!-- HEADING -->
    <div class="rpp-intro">
      <?php if ($recruiter_data) { ?>
        <!-- INFORMATION -->
        <div class="rpp-intro-info">
          <div class="rpp-title">
            <h2>
              <?php echo $recruiter_data['CompanyName'] ?>
            </h2>
            <a class="profilelink" href="recruiteredit.php">
              <img src="icons/Edit.svg" />Edit
            </a>
          </div>
          <br>
          <hr>
          <br>
          <p>
            <img src="icons/Comsize.svg" />
            Company size:
            <span class="cpp-span">
              <?php echo $recruiter_data['Size'] ?>
            </span>
          </p>
          <p>
            <img src="icons/Phone.svg" />
            Phone number:
            <span class="cpp-span">
              <?php echo $recruiter_data['CompanyPhone'] ?>
            </span>
          </p>
          <p>
            <img src="icons/Message.svg" />
            Email:
            <span class="cpp-span">
              <?php echo $recruiter_data['CompanyEmail'] ?>
            </span>
          </p>
          <p>
            <img src="icons/Home.svg" />
            Introduction:
          </p>
          <p class="rpp-intro-para">
            <?php echo $recruiter_data['Introduction'] ?>
          </p>
        </div>
        <!-- IMAGE -->
        <div class="rpp-intro-img">
          <img src="<?php echo $recruiter_data['CompanyImage']; ?>" alt="Company's image">
        </div>
      <?php } ?>
    </div>

    <!-- JOB POSTING -->
    <div class="rpp-box-container">
      <div class="header">
        <h5>Job posting</h5>
      </div>
      <br>
      <hr>
      <br>

      <ul class="autoWidth" class="cs-hidden">
        <?php while ($row = mysqli_fetch_assoc($job)) { ?>
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
              <button class="sp-product-btn" onclick="location.href='reinterviewbook.php?JobID=<?php echo $row['JobID']; ?>'">Set interview details</button>
            </div>
          </li>
        <?php } ?>
      </ul>
    </div>

    <!-- CANDIDATES APPLIED -->
    <div class="rpp-box-container">
      <div class="header">
        <h5>Candidates applied</h5>
      </div>
      <br>
      <hr>
      <br>

      <ul class="autoWidth" class="cs-hidden">
        <?php while ($row = mysqli_fetch_assoc($application)) { ?>
          <!-- Card 1 -->
          <li class="slide">
            <div class="sp-card">
              <div class="sp-image-box">
                <img src="<?php echo $row['JSImage']; ?>" alt="product.png">
                <h4>
                  <?php echo $row['FirstName'] . ' ' . $row['LastName']; ?>
                </h4>
              </div>
              <div class="sp-product-details">
                <div class="sp-product-require">
                  <ul>
                    <li><img src="icons/JobApplied.svg"> Job applied:
                      <span class="ca_span">
                        <?php echo $row['JobTitle']; ?>
                      </span>
                    </li>
                  </ul>
                </div>
              </div>
              <button class="ca-product-btn" onclick="location.href='jobseekerrpov.php?JobSeekerID=<?php echo $row['JobSeekerID']; ?>'">View job seeker profile</button>
            </div>
          </li>
        <?php } ?>
      </ul>
    </div>
    
    <!-- INTERVIEW SCHEDULE -->
    <div class="rpp-box-container">
      <div class="header">
        <h5>Interview schedule</h5>
      </div>
      <br>
      <hr>
      <br>

      <ul class="autoWidth" class="cs-hidden">
        <?php while ($row = mysqli_fetch_assoc($interview)) { ?>
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
                    <li><img src="icons/Calendar.svg">
                      <?php echo $row['DateStart'] . '  to  ' . $row['DateEnd']; ?>
                    </li>
                    <li><img src="icons/Time.svg">
                      <?php echo date('H:i', strtotime($row['TimeStart'])) . ' to ' . date('H:i', strtotime($row['TimeEnd'])); ?>
                    </li>
                  </ul>
                </div>
              </div>
              <button class="sp-product-btn" onclick="location.href='reinterviewset.php?JobID=<?php echo $row['JobID']; ?>'">View interview details</button>
            </div>
          </li>
        <?php } ?>
      </ul>
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
            <li><i class="fa-solid fa-location-dot"></i> P2 - 12A Eastern Park 2 Thạch Bàn,<br>Long Biên District, Hà
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