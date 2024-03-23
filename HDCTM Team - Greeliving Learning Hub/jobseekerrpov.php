<?php
  session_start();

  // Include settings and database connection
  require_once("./settings.php");

  $UserAuthenticationID = $_SESSION['recruiter_ID'];
  $recruiter = $conn->query("SELECT * FROM s104181721_db.Recruiter WHERE UserAuthenticationID = '$UserAuthenticationID';");
  
  $JobSeekerID = $_GET['JobSeekerID'];

  $job_seeker = $conn->query("SELECT * FROM s104181721_db.JobSeeker WHERE JobSeekerID = '$JobSeekerID';");
  $job_seeker_data = mysqli_fetch_assoc($job_seeker);

  $education = $conn->query("SELECT * FROM s104181721_db.Education WHERE JobSeekerID = '$JobSeekerID';");
  $skill = $conn->query("SELECT * FROM s104181721_db.Skill WHERE JobSeekerID = '$JobSeekerID';");
  $working_experience = $conn->query("SELECT * FROM s104181721_db.WorkingExperience WHERE JobSeekerID = '$JobSeekerID';");
  $extracurriculum_activity = $conn->query("SELECT * FROM s104181721_db.ExtracurriculumActivity WHERE JobSeekerID = '$JobSeekerID';");
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
  <title> Job Seeker Profile - Recruiter POV Page</title>
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
          <li><a href="recruiter.php"><img src="<?php echo $row['CompanyImage'] ?>"></a></li>
        <?php } ?>
        <li><a href="login.php"><img src="icons/Logout.svg"></a></li>
      </ul>
    </div>

  </header>

  <!-- MAIN CONTENT -->
  <main>
    <h1 class="cpp-heading">
      Profile
    </h1>
    <div class="cpp-bie-container">
      <!-- BASIC INFORMATION -->
      <div class="cpp-bi-container">
        <!-- HEADLINE -->
        <div class="cpp-bi-headline-container">
        <?php if ($job_seeker_data) { ?>
            <!-- PROFILE PICTURE -->
            <div class="cpp-bi-headline-profileimg">
              <img src="<?php echo $job_seeker_data['JSImage'] ?>" alt="Candidate Profile's Picture">
            </div>
            <!-- HEADLINE INFORMATION -->
            <div class="cpp-bi-headline-headline">
              <h2>
                <?php echo $job_seeker_data['FirstName'] . ' ' .  $job_seeker_data['LastName']; ?>
              </h2>
              <br>
              <p>
                <img src="icons/Job Title.svg" />
                Job title:
                <span class="cpp-span">
                  <?php echo $job_seeker_data['JSJobTitle']; ?>
                </span>
              </p>
              <p>
                <img src="icons/Experience Level.svg" />
                Experience level:
                <span class="cpp-span">
                  <?php echo $job_seeker_data['ExperienceLevel']; ?>
                </span>
              </p>
            </div>
          <?php } ?>
        </div>
        
        <br>

        <!-- PERSONAL INFORMATION -->
        <div class="cpp-bi-personalinfo-container">
          <!-- TITLE -->
          <div class="cpp-title">
            <h3>Personal information</h3>
          </div>

          <br>
          <hr>
          <br>

          <!-- CONTENT -->
          <div class="cpp-bi-personalinfo-content">
            <?php if ($job_seeker_data) { ?>
              <p>
                <img src="icons/Gender.svg" />
                Gender:
                <span class="cpp-span">
                  <?php echo $job_seeker_data['Gender']; ?>
                </span>
              </p>
              <p>
                <img src="icons/Calendar.svg" />
                DOB:
                <span class="cpp-span">
                  <?php echo $job_seeker_data['DOB']; ?>
                </span>
              </p>
              <p>
                <img src="icons/Phone.svg" />
                Phone number:
                <span class="cpp-span">
                  <?php echo $job_seeker_data['Phone']; ?>
                </span>
              </p>
              <p>
                <img src="icons/Location.svg" />
                Address:
                <span class="cpp-span">
                  <?php echo $job_seeker_data['Address']; ?>
                </span>
              </p>
            <?php } ?>
          </div>
        </div>
        
        <br>

        <!-- EDUCATION BACKGROUND -->
        <div class="cpp-bi-edubg-container">
          <!-- TITLE -->
          <div class="cpp-title">
            <h3>Education background</h3>
          </div>

          <br>
          <hr>
          <br>

          <!-- CONTENT -->
          <div class="cpp-bi-careerintro-content">
            <p>
              <span class="cpp-span">
                <div class="cpp-bi-personalinfo-content-edubg">
                  <ul>
                    <?php while ($row = mysqli_fetch_assoc($education)) { ?>
                      <li>
                        <?php echo $row['GraduationYear'] . ' ' .  $row['Institution'] ?>
                        <br>
                        <i>
                          <?php echo $row['Degree'] ?>
                        </i>
                      </li>
                      <br>
                    <?php } ?>
                  </ul>
                </div>
              </span>
            </p>
          </div>
        </div>
      </div>

      <!-- EXPERIENCE -->
      <div class="cpp-e-container">
        <!-- SKILLS -->
        <div class="cpp-e-skills-container">
          <!-- TITLE -->
          <div class="cpp-title">
            <h3>Skills</h3>
          </div>
          <br>
          <hr>
          <br>

          <!-- CONTENT -->
          <div class="cpp-e-skills-content">
            <?php while ($row = mysqli_fetch_assoc($skill)) { ?>
              <p>
                <?php echo $row['SkillName']; ?>
              </p>
            <?php } ?>
          </div>
        </div>

        <br>
        <br>

        <!-- WOKRING EXPERIENCE -->
        <div class="cpp-e-wokringexp-container">
          <!-- TITLE -->
          <div class="cpp-title">
            <h3>Working experience</h3>
          </div>
          <br>
          <hr>
          <br>

          <!-- CONTENT -->
          <div class="cpp-e-workingexp-content">
            <?php while ($row = mysqli_fetch_assoc($working_experience)) { ?>
              <!-- WORKING EXPERIENCE 1 -->
              <div class="cpp-e-workingexp-work">
                <!-- Company -->
                <h4>
                  <?php echo $row['WCompanyName']; ?>
                </h4>
                <br>
                <h4>
                  <?php echo $row['WTimeRange']; ?> weeks
                </h4>
                <br>
                <!-- Position -->
                <h5>
                  <?php echo $row['WJobRole']; ?>
                </h5>
                <br>
                <!-- Description & Achievement -->
                <div class="cpp-e-workingexp-work-desc">
                  <ul>
                    <li>
                      <?php echo $row['WDescription']; ?>
                    </li>
                  </ul>
                </div>
              </div>
              <br>
              <br>
            <?php } ?>
          </div>

          <!-- TITLE -->
          <div class="cpp-title">
            <h3>Extracurriculum Activity </h3>
          </div>
          <br>
          <hr>
          <br>

          <!-- CONTENT -->
          <div class="cpp-e-workingexp-content">
            <?php while ($row = mysqli_fetch_assoc($extracurriculum_activity)) { ?>
              <!-- WORKING EXPERIENCE 1 -->
              <div class="cpp-e-workingexp-work">
                <!-- Company -->
                <h4>
                  <?php echo $row['OrganizationName']; ?>
                </h4>
                <br>
                <h4>
                  <?php echo $row['EATimeRange']; ?> weeks
                </h4>
                <br>
                <!-- Position -->
                <h5>
                  <?php echo $row['EAJobRole']; ?>
                </h5>
                <br>
                <!-- Description & Achievement -->
                <div class="cpp-e-workingexp-work-desc">
                  <ul>
                    <li>
                      <?php echo $row['EADescription']; ?>
                    </li>
                  </ul>
                </div>
              </div>
              <br>
              <br>
            <?php } ?>
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