<?php
session_start();
require_once "database.php"; // Include your database connection

// Check if user is already logged in
if (isset($_SESSION["user"])) {
    header("Location: profile.php");
    exit();
}

$error_message = "";

// Process form submission
if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    //$recaptcha_response = $_POST['g-recaptcha-response']; // Get reCAPTCHA response

    // Validate reCAPTCHA
    /*$recaptcha_secret = '6LfdOW4qAAAAAPDe9_SaddhI4NPz3jAbv-lkcrez';
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$recaptcha_secret}&response={$recaptcha_response}");
    $responseKeys = json_decode($response, true);

    // Proceed only if reCAPTCHA is verified
    if (intval($responseKeys["success"]) !== 1) {
        $error_message = "Please complete the reCAPTCHA verification.";
    } else {*/
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($connect, $sql);
        $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
        
        if ($user) {
          if (password_verify($password, $user["password"])) {
                $login_count = $user["login_count"] + 1;
                $last_login = date("Y-m-d H:i:s"); // Current timestamp

                $update_sql = "UPDATE users SET login_count = ?, last_login = ? WHERE email = ?";
                $stmt = $connect->prepare($update_sql);
                $stmt->bind_param("iss", $login_count, $last_login, $email);
                $stmt->execute();
                $stmt->close();
                
                 session_start();
                 $_SESSION["user"] = "yes";
                 $_SESSION["first"] = $user["firstname"];
                 $_SESSION["last"] = $user["lastname"];
                 $_SESSION["count"] = $user["login_count"];
                 $_SESSION["date"] = $user["last_login"];
                 header("Location: profile.php");
                 die();
             }else{
                 echo "<div class='alert alert-danger'>Password incorrect!</div>";
             }
         }else{
             echo "<div class='alert alert-danger'>Email does not exist!</div>";
         }
    }
//}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="css/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <link rel="icon" type="image/png" sizes="512x512" href="images/favicon6.png">
    <link rel="icon" href="images/favicon6.ico" type="image/x-icon">
    <link rel="shortcut icon" href="images/favicon6.ico" type="image/x-icon">
    <!-- <script src="https://www.google.com/recaptcha/api.js" async defer></script> -->
</head>
<body>
<nav>     
      </ul>
 
         <ul>
 
           <li class="dropdown / montserrat-font">
             <a href="index.html" class="dropbtn">Home</a>
             
            </li>
 
            <li class="dropdown / montserrat-font">
             <a href="products.html" class="dropbtn">Products</a>
           
            </li>
 
            <li class="dropdown / montserrat-font">
             <a href="requests.html" class="dropbtn">Requests</a>
             
            </li>
 
            <li class="dropdown / montserrat-font">
             <a href="resources.html" class="dropbtn">Resources</a>
             
            </li>
 
            <li class="dropdown / montserrat-font">
             <a href="nogrid.html" class="dropbtn">About Us</a>
             
            </li>
 
            <li class="dropdown / montserrat-font">
             <a href="profile.php" class="dropbtn"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFFFFF"><path d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-160v-112q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v112H160Zm80-80h480v-32q0-11-5.5-20T700-306q-54-27-109-40.5T480-360q-56 0-111 13.5T260-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T560-640q0-33-23.5-56.5T480-720q-33 0-56.5 23.5T400-640q0 33 23.5 56.5T480-560Zm0-80Zm0 400Z"/></svg></a>
            </li>
                      
            <li class="dropdown / montserrat-font">
             <a href="#benefits" class="dropbtn"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFFFFF"><path d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z"/></svg></a>
             <div class="dropdown-content">
               <!--Search Navigation Bar-->
          
               <div class="search-container">
           <form class="search-bar">
               <input class="form-control mr-sm-2" type="search" placeholder="Keyword" aria-label="Search">
               <button class="btn btn-success" type="submit">Search</button>
           </form>
               </div>
             </div>
           </div>
            </li>
 
           </ul>
     </nav>
    <div class="regbody">
    <div class="container2">
        <h1 class="text-center">Log In</h1> <!-- Centered heading -->
        <?php
        if ($error_message) {
            echo "<div class='alert alert-danger text-center'>" . htmlspecialchars($error_message) . "</div>"; // Center error message
        }
        ?>
        <form action="login.php" method="post"> <!-- Form action points to itself -->
            <div class="form-group">
                <input type="email" placeholder="Enter Email" name="email" class="form-control" autofocus required>                
            </div>
            <div class="form-group">
                <input type="password" placeholder="Enter Password" name="password" class="form-control" required>                
            </div>
            <div class="form-group text-center"> <!-- Center the reCAPTCHA -->
                <div class="g-recaptcha" data-sitekey="6LfdOW4qAAAAAJLi1UukNFLMrfIoEZ5bBbezMg6x"></div> <!-- Add your site key here -->
            </div>
            <div class="text-center"> <!-- Center the button -->
                <input type="submit" value="Login" name="login" class="btn btn-primary mt-3">
            </div>
        </form>
        <div class="text-center"> <!-- Center the registration link -->
            <p>Need to create an account? <a href="registration.php">Register Here</a></p>
        </div>
        <div class="text-center"> 
            <p>Forgot password? <a href="reset.php">Reset Here</a></p>
        </div>
    </div>
    </div>
</body>
</html>
