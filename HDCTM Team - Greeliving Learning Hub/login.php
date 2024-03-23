<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    session_start();

    // Include settings and database connection
    require_once("./settings.php");

    // Checking if the manager log in name and password match one in the user table
    if (isset($_POST["email"]) && isset($_POST['password'])) {
        $email = sanitize_input($_POST["email"]);
        $password = sanitize_input($_POST["password"]);

        $user_query= "SELECT * FROM s104181721_db.UserAuthentication WHERE UserEmail = '$email' AND UserPassword = '$password';";
        $result = $conn->query($user_query);

        // The system will return to the log in page if there is no user
        if ($result->num_rows == 0) {
            header("Location: ./login.php");
        } else {
            // Fetch user details
            $user = $result->fetch_assoc();

            // Check UserRole
            $userRole = $user['UserRole'];

            // Redirect based on UserRole
            switch ($userRole) {
                case 'Job Seeker':
                    $redirectPage = "jobseeker.php";
                    // Set session variables
                    $_SESSION['job_seeker_ID'] = $user['UserAuthenticationID'];
                    $_SESSION['js_email'] = $email;
                    break;
                case 'Recruiter':
                    $redirectPage = "recruiter.php";
                    // Set session variables
                    $_SESSION['recruiter_ID'] = $user['UserAuthenticationID'];
                    $_SESSION['re_email'] = $email;
                    break;
            }

            // Redirect to the appropriate page
            header("Location: ./$redirectPage");
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
    <link href="styles/hehe.css" rel="stylesheet">
    <link rel="icon" href="images/Favicon-02.png" type="image/x-icon">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <script src="https://kit.fontawesome.com/f73039f1ad.js" crossorigin="anonymous"></script>
    <title>Log In</title>
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
            <form class="inputgr" id="si-inputgr" method="post" action="login.php">
                <div class="si-input-box">
                    <span class="si-input-icon"><img src="icons/MessageL.svg"/></span>
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