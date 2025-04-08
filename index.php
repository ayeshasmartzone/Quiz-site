<?php 



session_start();



// Check if user is already logged in, redirect to home if so
if(isset($_SESSION['valid'])){
    header("Location: home.php");
    exit;
}

include("php/config.php");

if(isset($_POST['submit'])){
    // Validate input to prevent SQL Injection
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    
    // Check if user exists in the database
    $result = mysqli_query($con, "SELECT * FROM users WHERE Email='$email'") or die("Select Error: " . mysqli_error($con));
    $row = mysqli_fetch_assoc($result);

    if(is_array($row) && !empty($row)){
        // Password verification using password_hash
        if(password_verify($password, $row['Password'])){
            $_SESSION['valid'] = $row['Email'];
            $_SESSION['username'] = $row['Username'];
            $_SESSION['age'] = $row['Age'];
            $_SESSION['id'] = $row['Id'];

            // Redirect to home page
            header("Location: home.php");
            exit;
        } else {
            $error_message = "Wrong password!";
        }
    } else {
        $error_message = "No user found with this email!";
    }
}







?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <div class="box form-box">
            <header>Login</header>
            
            <!-- Display error message if there is an error -->
            <?php if(isset($error_message)): ?>
                <div class="message">
                    <p><?php echo $error_message; ?></p>
                </div>
            <?php endif; ?>


            <?php
// Get the role from the query parameter (either 'attendee' or 'organizer')
$role = isset($_GET['role']) ? $_GET['role'] : null;

// Optional: Display role for debugging purposes
echo "Role: " . $role;

// You can display different content or handle the login differently based on the role
if ($role == 'attendee') {
    echo "<h2>Attendee Login</h2>";
} elseif ($role == 'organizer') {
    echo "<h2>Organizer Login</h2>";
} else {
    echo "<h2>Login</h2>";
}
?>






            <form id="loginForm" action="" method="post">
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>

                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Login">
                </div>

                <div class="field">
                    <!-- Clear All Button -->
                    <button type="button" class="btn" onclick="clearForm()">Clear All</button>
                </div>

                <div class="links">
                    Don't have an account? <a href="register.php">Sign Up Now</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Clear the form fields
        function clearForm() {
            document.getElementById("loginForm").reset(); // Resets the form fields to their default values
        }
    </script>
</body>
</html>
