<?php
  session_start();

  // Include settings and database connection
  require_once("./settings.php");

  $UserAuthenticationID = $_SESSION['job_seeker_ID'];
  $user_email = $_SESSION['js_email'];

  $job_seeker = $conn->query("SELECT * FROM s104181721_db.JobSeeker WHERE UserAuthenticationID = '$UserAuthenticationID';");
  $job_seeker_data = mysqli_fetch_assoc($job_seeker);
  $JobSeekerID = $job_seeker_data['JobSeekerID'];

  $education = $conn->query("SELECT * FROM s104181721_db.Education WHERE JobSeekerID = '$JobSeekerID';");
  $skill = $conn->query("SELECT * FROM s104181721_db.Skill WHERE JobSeekerID = '$JobSeekerID';");
  $working_experience = $conn->query("SELECT * FROM s104181721_db.WorkingExperience WHERE JobSeekerID = '$JobSeekerID';");
  $extracurriculum_activity = $conn->query("SELECT * FROM s104181721_db.ExtracurriculumActivity WHERE JobSeekerID = '$JobSeekerID';");

  $CourseRegistration = $conn->query("SELECT * FROM s104181721_db.CourseRegistration WHERE JobSeekerID = '$JobSeekerID';");

  // Fetch all CourseIDs
  $courseIDs = [];
  while ($courseIDRow = $CourseRegistration->fetch_assoc()) {
    $courseIDs[] = $courseIDRow['CourseID'];
  }
  $courseIDsString = implode("','", $courseIDs);
  $course = $conn->query("SELECT * FROM s104181721_db.Course WHERE CourseID IN ('$courseIDsString');");

  $application = $conn->query("SELECT * FROM s104181721_db.Application WHERE JobSeekerID = '$JobSeekerID';");

  // Fetch all JobIDs
  $jobIDs = [];
  while ($jobIDRow = $application->fetch_assoc()) {
    $jobIDs[] = $jobIDRow['JobID'];
  }
  $jobIDsString = implode("','", $jobIDs);
  $job = $conn->query("SELECT * FROM s104181721_db.Job WHERE JobID IN ('$jobIDsString');");

  $js_interview = $conn->query("SELECT 
      JobSeekerInterview.*, 
      Job.* 
    FROM 
      s104181721_db.JobSeekerInterview
      JOIN s104181721_db.Job ON JobSeekerInterview.JobID = Job.JobID
    WHERE 
      JobSeekerInterview.JobSeekerID = '$JobSeekerID';");
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
  <title>Job Seeker Profile Page</title>
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
          <li><a href="jobseeker.php"><img src="<?php echo $job_seeker_data['JSImage'] ?>"></a></li>
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
            <a class="profilelink" href="jobseekeredit.php">
              <img src="icons/Edit.svg" />Edit
            </a>
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
                <img src="icons/Message.svg" />
                Email:
                <span class="cpp-span">
                  <?php echo $user_email; ?>
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
            <a class="profilelink" href="jobseekeredit.php">
              <img src="icons/Edit.svg" />Edit
            </a>
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
            <a class="profilelink" href="jobseekeredit.php">
              <img src="icons/Edit.svg" />Edit
            </a>
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
            <a class="profilelink" href="jobseekeredit.php">
              <img src="icons/Edit.svg" />Edit
            </a>
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
            <a class="profilelink" href="jobseekeredit.php">
              <img src="icons/Edit.svg" />Edit
            </a>
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

    <!-- COURSES -->
    <div class="cpp-course-container">

      <!-- REGISTERED COURSES -->
      <div class="cp-box-container">
        <div class="header">
          <h5>Registered courses</h5>
        </div>
        <br>
        <hr>
        <br>

        <ul class="autoWidth" class="cs-hidden">
          <?php while ($row = mysqli_fetch_assoc($course)) { ?>
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
                <button class="sp-product-btn" onclick="location.href='pagenotfound.html'">See course details</button>
              </div>
            </li>
          <?php } ?>
        </ul>
      </div>

      <!-- JOB APPLICATIONS -->
      <div class="cp-box-container">
        <div class="header">
          <h5>Job applications</h5>
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
                      <li><img src="icons/PeopleGroup.svg">
                        <?php echo $row['WorkingFormat']; ?>
                      </li>
                    </ul>
                  </div>
                </div>
                <button class="sp-product-btn" onclick="location.href='jsinterviewbook.php?JobID=<?php echo $row['JobID']; ?>'">Book interview time</button>
              </div>
            </li>
          <?php } ?>
        </ul>
      </div>

      <!-- INTERVIEW SCHEDULE -->
      <div class="cp-box-container">
        <div class="header">
          <h5>Interview schedule</h5>
        </div>
        <br>
        <hr>
        <br>

        <ul class="autoWidth" class="cs-hidden">
          <?php while ($row = mysqli_fetch_assoc($js_interview)) { ?>
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
                        <?php echo $row['InterviewDate']; ?>
                      </li>
                      <li><img src="icons/Time.svg">
                        <?php echo date('H:i', strtotime($row['InterviewTime'])); ?>
                      </li>
                    </ul>
                  </div>
                </div>
                <button class="sp-product-btn" onclick="location.href='jsinterviewset.php?JobID=<?php echo $row['JobID']; ?>'">View interview time</button>
              </div>
            </li>
          <?php } ?>
        </ul>
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
            <li><a href="courses.php">Courses</a></li>
            <li><a href="jobopportunities.php">Job Opportunities</a></li>
          </ul>
        </div>

        <!-- Third column -->

        <div class="footer_col">
          <h4>Contact us</h4>
          <form action="">
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