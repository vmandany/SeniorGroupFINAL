<?php
session_start();
if (isset($_SESSION["user"])) {
    header("Location: index.html");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="css/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <link rel="icon" type="image/png" sizes="512x512" href="images/favicon6.png">
    <link rel="icon" href="images/favicon6.ico" type="image/x-icon">
    <link rel="shortcut icon" href="images/favicon6.ico" type="image/x-icon">
    <style>
        .strength-meter {
            height: 5px;
            border-radius: 3px;
            margin-top: 5px;
            transition: width 0.5s;
        }
        .weak { background-color: red; }
        .medium { background-color: orange; }
        .strong { background-color: green; }
        #password-feedback { color: white; }
    </style>
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
        <h1>Create a New Account</h1>
        <?php
        /*if (isset($_POST["submit"])) {
            $firstname = $_POST["firstname"];
            $lastname = $_POST["lastname"];
            $userRole = $_POST["user-role"] ?? "";
            $email = $_POST["email"];
            $password = $_POST["password"];
            $passwordRepeat = $_POST["repeat_password"];

            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $errors = array();

            if (empty($firstname) || empty($lastname) || empty($userRole) || empty($email) || empty($password) || empty($passwordRepeat)) {
                array_push($errors, "All fields are required!");
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                array_push($errors, "Email is not valid!");
            }
            if (empty($userRole)) {
                array_push($errors, "Please select a user role!");
            }
            if (strlen($password) < 8) {
                array_push($errors, "Password must be at least 8 characters long!");
            }
            if ($password !== $passwordRepeat) {
                array_push($errors, "Password does not match!");
            }

            require_once "database.php";

            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($connect, $sql);
            $rowCnt = mysqli_num_rows($result);
            if ($rowCnt > 0) {
                array_push($errors, "Email already exists!");
            }
            if (count($errors) > 0) {
                echo "<div class='error-container'>";
                foreach ($errors as $error) {
                    echo "<div class='alert alert-danger'>$error</div>";
                }
                echo "</div>";
            } else {
                $sql = "INSERT INTO users (firstname, lastname, userRole, email, password) VALUES (?, ?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($connect);
                $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
                if ($prepareStmt) {
                    mysqli_stmt_bind_param($stmt, "sssss", $firstname, $lastname, $userRole, $email, $passwordHash);
                    mysqli_stmt_execute($stmt);
                    echo "<div class ='alert alert-success'>You have registered Successfully!</div>";
                } else {
                    die("Something went wrong :(");
                }
            }
        }*/
        if (isset($_POST["submit"])) {
            $firstname = $_POST["firstname"];
            $lastname = $_POST["lastname"];
            $userRole = $_POST["user-role"] ?? "";
            $email = $_POST["email"];
            $password = $_POST["password"];
            $passwordRepeat = $_POST["repeat_password"];

            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $errors = array();

            if (empty($firstname) || empty($lastname) || empty($userRole) || empty($email) || empty($password) || empty($passwordRepeat)) {
                array_push($errors, "All fields are required!");
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                array_push($errors, "Email is not valid!");
            }
            if (strlen($password) < 8) {
                array_push($errors, "Password must be at least 8 characters long!");
            }
            if ($password !== $passwordRepeat) {
                array_push($errors, "Password does not match!");
            }

            require_once "database.php";

            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($connect, $sql);
            $rowCnt = mysqli_num_rows($result);
            if ($rowCnt > 0) {
                array_push($errors, "Email already exists!");
            }
            if (count($errors) > 0) {
                foreach ($errors as $error) {
                    echo "<div class='alert alert-danger'>$error</div>";
                }
            } else {
                $sql = "INSERT INTO users (firstname, lastname, userRole, email, password) VALUES (?, ?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($connect);
                $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
                if ($prepareStmt) {
                    mysqli_stmt_bind_param($stmt, "sssss", $firstname, $lastname, $userRole, $email, $passwordHash);
                    mysqli_stmt_execute($stmt);
                    echo "<div class ='alert alert-success'>You have registered Successfully!</div>";
                } else {
                    die("Something went wrong :(");
                }
            }
        }
        ?>
        
        <form action="registration.php" method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="firstname" placeholder="First Name:" autofocus>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="lastname" placeholder="Last Name:">
            </div>
            <div class="form-group">
                <select id="user-role" class="form-control" name="user-role">
                    <option value="" disabled selected>Select role</option>
                    <option value="employee">Employee</option>
                    <option value="manager">Manager</option>
                </select>
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email:">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" id="password" placeholder="Password:" oninput="checkPasswordStrength()">
                <div id="password-strength" class="strength-meter"></div>
                <small id="password-feedback" class="form-text"></small>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="repeat_password" placeholder="Confirm Password:">
            </div>
            <div class="form-btn">
                <input type="submit" class="btn btn-primary" value="Register" name="submit">
            </div>
        </form>
        <div>
            <div><p>Already Registered? <a href="login.php">Login Here</a></p></div>
        </div>
    </div>
    </div>

    <script>
        function checkPasswordStrength() {
            const password = document.getElementById("password").value;
            const strengthMeter = document.getElementById("password-strength");
            const feedback = document.getElementById("password-feedback");

            let strength = 0;
            if (password.length >= 8) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[a-z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^A-Za-z0-9]/.test(password)) strength++; // Special characters

            switch (strength) {
                case 0:
                    strengthMeter.style.width = "0%";
                    feedback.textContent = "";
                    break;
                case 1:
                    strengthMeter.style.width = "20%";
                    strengthMeter.className = "strength-meter weak";
                    feedback.textContent = "Weak password.";
                    break;
                case 2:
                    strengthMeter.style.width = "50%";
                    strengthMeter.className = "strength-meter medium";
                    feedback.textContent = "Medium password.";
                    break;
                case 3:
                    strengthMeter.style.width = "75%";
                    strengthMeter.className = "strength-meter medium";
                    feedback.textContent = "Strong password.";
                    break;
                case 4:
                case 5:
                    strengthMeter.style.width = "100%";
                    strengthMeter.className = "strength-meter strong";
                    feedback.textContent = "Very strong password!";
                    break;
                default:
                    strengthMeter.style.width = "0%";
                    feedback.textContent = "";
                    break;
            }
        }
    </script>
</body>
</html>
