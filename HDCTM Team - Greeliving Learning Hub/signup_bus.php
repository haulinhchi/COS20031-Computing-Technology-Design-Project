<?php
    // Include settings and database connection
    require_once("./settings.php");
    
    // Get form data
    $company_name = $_POST['company_name'];
    $contact_number = $_POST['contact_number'];
    $email = $_POST['email'];
    $pwd = $_POST['password'];

    // Insert data into UserAuthentication table
    $sql1 = "INSERT INTO s104181721_db.UserAuthentication (UserEmail, UserPassword, UserRole)
        VALUES ('$email', '$pwd', 'Recruiter')";
    $conn->query($sql1);

    // Get the UserAuthenticationID after inserting data into UserAuthentication table
    $UserAuthenticationID = $conn->insert_id;

    $sql2 = "INSERT INTO s104181721_db.Recruiter (UserAuthenticationID, CompanyName, CompanyPhone)
        VALUES ('$UserAuthenticationID', '$company_name', '$contact_number')";
    $conn->query($sql2);

    // Store data in the session
    $_SESSION['recruiter_ID'] = $UserAuthenticationID;
    $_SESSION['re_email'] = $email;

    // Redirect to the appropriate page
    header("Location: ./recruiter.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="description" content="COS20031 Computing Technology Design Project">
  <meta name="author" content="Lo Tuan Hung, Luong Chi Duc, Nguyen Vu Duy Minh, Hau Linh Chi, Dao Khanh Nga Thi">
  <link href="styles/style.css" rel="stylesheet">
  <link href="styles/hehe.css" rel="stylesheet">
  <link rel="icon" href="images/Favicon-02.png" type="image/x-icon">
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
  <script src="https://kit.fontawesome.com/f73039f1ad.js" crossorigin="anonymous"></script>
  <title>Website title appeared on the tab</title>
</head>

<body>
    <div class="si-content">

        <div class="si-form-box">
            <img alt="Logo" src="images/Logo.png" class="logo">
            <h1>Welcome back!</h1>
            <br>
            <div class="si-button-box">
                <button type="button" class="si-toggle-btn" id="si-btn-selected">Log In</button>
                <button type="button" class="si-toggle-btn" onclick="location.href='signup_role.html'">Sign Up</button>
            </div>
            <form class="inputgr" id="si-inputgr" action="signup_bus.php" method="post">
                <div class="si-input-box">
                    <span class="si-input-icon"><img src="icons/PersonSmall.svg"></span>
                    <input name="company_name" type="text" class="si-input" placeholder="Company Name" required> 
                </div>
                <div class="si-input-box">
                    <span class="si-input-icon"><img src="icons/PhoneL.svg"></span>
                    <input name="contact_number" type="text" class="si-input" placeholder="Contact Number" required> 
                </div>
                <div class="si-input-box">
                    <span class="si-input-icon"><img src="icons/MessageL.svg"></span>
                    <input name="email" type="text" class="si-input" placeholder="Email address" required>
                </div>
                <div class="si-input-box">
                    <span class="si-input-icon"><img src="icons/Check&Security.svg"></span>
                    <input name="password" type="password" class="si-input" placeholder="Password" required>
                </div>
                <div class="si-submit-box">
                    <button type="submit" class="si-submit-btn">Log in</button>
                </div>
            </form>
        </div>

        <div class="si-image">
            <img alt="Background.png" src="images/sign_background.jpg">
        </div>

    </div>
</body>

</html>