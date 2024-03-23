<?php
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  session_start();

  // Include settings and database connection
  require_once("./settings.php");

  $UserAuthenticationID = $_SESSION['recruiter_ID'];

  $recruiter = $conn->query("SELECT * FROM s104181721_db.Recruiter WHERE UserAuthenticationID = '$UserAuthenticationID';");
  $existingRecruiter = $recruiter->fetch_assoc();

  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Retrieve data from the form
    $CompanyName = $_POST["rep-com-name"];
    $Size = $_POST["rep-com-size"];
    $CompanyPhone = $_POST["rep-com-phone"];
    $Introduction = $_POST["rep-com-intro"];
    $CompanyImage = $_POST["rep-com-img-link"];

    $sql = "UPDATE s104181721_db.Recruiter 
      SET CompanyName = '$CompanyName', 
        Size = '$Size', 
        CompanyPhone = '$CompanyPhone', 
        Introduction = '$Introduction', 
        CompanyImage = '$CompanyImage' 
      WHERE UserAuthenticationID = '$UserAuthenticationID';";
  
    // Execute the query
    if ($conn->query($sql) === TRUE) {
      // Redirect to another page after form submission
      header("Location: recruiter.php");
      exit();
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
  <title>Recruiter Edit Page</title>
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

    <h1 class="rep-heading">Profile</h1>

    <!--EDITING FORM-->
    <form method="post" action="recruiteredit.php" class="rep-form">
      <?php if ($existingRecruiter) { ?>

        <!--LEFT COLUMN-->
        <div class="rep-content-left">

          <!--COMPANY NAME-->
          <label class="rep-label">
            <img src="icons/PeopleGroup.svg">
            <input name="rep-com-name" type="text" class="rep-btn" placeholder="Company name" value="<?php echo $existingRecruiter['CompanyName']; ?>">
          </label>

          <!--COMPANY SIZE-->
          <label class="rep-label">
            <img src="icons/Comsize.svg">
            <input name="rep-com-size" type="text" class="rep-btn" placeholder="Company size" value="<?php echo $existingRecruiter['Size']; ?>">
          </label>

          <!--PHONE NUMBER-->
          <label class="rep-label">
            <img src="icons/Phone.svg">
            <input name="rep-com-phone" type="text" class="rep-btn" placeholder="Phone number" value="<?php echo $existingRecruiter['CompanyPhone']; ?>">
          </label>

          <!--COMPANY INTRODUCTION-->
          <div class="rep-input-box">
            <input name="rep-com-intro" type="text" class="rep-btn" placeholder="Introduction" value="<?php echo $existingRecruiter['Introduction']; ?>">
          </div>
        </div>

        <!--RIGHT COLUMN-->
        <div class="rep-content-right">

          <!--IMAGE BOX-->
          <div class="rep-img-box">
            <img src="<?php echo $existingRecruiter['CompanyImage']; ?>">
          </div>

          <!--IMAGE LINK-->
          <div class="rep-img-link">
            <img src="icons/Link_B.svg">
            <input name="rep-com-img-link" type="text" class="rep-link" placeholder="Insert profile image link" value="<?php echo $existingRecruiter['CompanyImage']; ?>">
          </div>
        </div>

      <?php } ?>

      <!--Save Edit Button-->

      <div class="rep-submit-btn">
        <input type="submit" value="Save changes">
      </div>
    </form>
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