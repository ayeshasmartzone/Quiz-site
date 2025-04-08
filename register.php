<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Register</title>
    <style>
        
.profile_picture{
    width: 100px;            
    height: 100px;           
    border-radius: 50%;      
    object-fit: cover;       
    border: 3px solid white;  
    margin: 10px auto;       
    display: block;         
}


.profile_picture {
    text-align: center;      
    margin-top: 20px;        /* Space at the top */
}

    </style>
</head>
<body>
    <div class="container">
        <div class="box form-box">
        <?php 
            // Include the database connection file
            include("php/config.php");

            if (isset($_POST['submit'])) {
                // Get the form data
                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $cnic = $_POST['cnic'];
                $study_program = $_POST['study_program'];
                $about_me = $_POST['about_me'];

                // Handle file upload for profile picture
                $file_path = ''; // Initialize the file path variable
                if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
                    // Get the file details
                    $file_name = $_FILES['profile_picture']['name'];
                    $file_tmp = $_FILES['profile_picture']['tmp_name'];
                    $file_size = $_FILES['profile_picture']['size'];
                    $file_type = $_FILES['profile_picture']['type'];
                    
                    // Define the directory where the file will be uploaded
                    $upload_dir = 'uploads/';  // Make sure this folder exists or create it
                    // Ensure that the folder exists and has proper write permissions
                    if (!is_dir($upload_dir)) {
                        mkdir($upload_dir, 0777, true); // Create the folder if it doesn't exist
                    }
                    
                    $file_path = $upload_dir . basename($file_name);
                    
                    // Check if the file is an image (optional)
                    $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];  // Allowed file types
                    if (in_array($file_type, $allowed_types)) {
                        // Move the uploaded file to the upload directory
                        if (move_uploaded_file($file_tmp, $file_path)) {
                            // File uploaded successfully
                        } else {
                            echo "Error uploading file.";
                        }
                    } else {
                        echo "Invalid file type. Only JPG, PNG, or GIF are allowed.";
                    }
                }

                // Verify if the email is already in use
                $verify_query = mysqli_query($con, "SELECT Email FROM users WHERE Email='$email'");

                // Check if the email already exists
                if (mysqli_num_rows($verify_query) != 0) {
                    echo "<div class='message'>
                              <p>This email is already used. Try another one!</p>
                          </div> <br>";
                    echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button></a>";
                } else {
                    // Hash the password using bcrypt before storing it
                    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

                    // Insert the user into the database with the hashed password
                    $insert_query = "INSERT INTO users (Username, Email, Password, CNIC, Study_Program, About_Me, Profile_Picture) 
                                     VALUES ('$username', '$email', '$hashedPassword', '$cnic', '$study_program', '$about_me', '$file_path')";

                    if (mysqli_query($con, $insert_query)) {
                        echo "<div class='message'>
                                  <p style='color: green;'>Registration successful!</p>
                              </div> <br>";
                        echo "<a href='index.php'><button class='btn'>Login Now</button></a>";
                    } else {
                        echo "Error: " . mysqli_error($con);
                    }
                }

            } else {
        ?>

        <header>Sign Up</header>
        <form id="registerForm" action="" method="post" enctype="multipart/form-data">
            <div class="field input">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" autocomplete="off" required>
            </div>

            <div class="field input">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" autocomplete="off" required>
            </div>

            <div class="field input">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" autocomplete="off" required>
            </div>

            <div class="field input">
                <label for="cnic">CNIC (13 digits):</label>
                <input type="text" name="cnic" id="cnic" required maxlength="13" pattern="\d{13}" title="CNIC must be 13 digits" autocomplete="off">
            </div>

            <div class="field input">
                <label for="study_program">Study Program</label>
                <select name="study_program" id="study_program" required>
                    <option value="">Select Study Program</option>
                    <option value="BSCS">BSCS (Bachelor of Science in Computer Science)</option>
                    <option value="BSIT">BSIT (Bachelor of Science in Information Technology)</option>
                    <option value="BSSE">BSSE (Bachelor of Science in Software Engineering)</option>
                    <option value="BSDS">BSDS (Bachelor of Science in Data Science)</option>
                    <option value="BSMGT">BSMGT (Bachelor of Science in Management)</option>
                    <option value="BSAI">BSAI (Bachelor of Science in Artificial Intelligence)</option>
                    <option value="MCS">MCS (Master of Computer Science)</option>
                    <option value="MIT">MIT (Master of Information Technology)</option>
                    <option value="ADPCS">ADPCS (Associate Degree in Computer Science)</option>
                    <option value="MSCS">MSCS (Master of Science in Computer Science)</option>
                </select>
            </div>

            <div class="field input">
                <label for="profile_picture">Profile Picture:</label>
                <input type="file" name="profile_picture" id="profile_picture" accept="image/*" required>
            </div>

            <div class="field input">
                <label for="about_me">About Me:</label>
                <textarea name="about_me" id="about_me" rows="4" cols="50" placeholder="Write a short paragraph about yourself..." required></textarea>
            </div>

            <div class="field">
                <input type="submit" class="btn" name="submit" value="Register">
            </div>

            <div class="field">
                <button type="button" class="btn" onclick="clearForm()">Clear All</button>
            </div>

            <div class="links">
                Already a member? <a href="index.php">Sign In</a>
            </div>
        </form>

        <?php } ?>
    </div>

    <script>
        // Clear the form fields
        function clearForm() {
            document.getElementById("registerForm").reset(); // Resets the form fields to their default values
        }

        // Client-side validation
        document.querySelector("form").addEventListener("submit", function(event) {
            var cnic = document.getElementById("cnic").value;

            // CNIC validation
            if (!/^\d{13}$/.test(cnic)) {
                alert("CNIC must be 13 digits.");
                event.preventDefault();  // Prevent form submission if validation fails
                return;
            }

            var password = document.getElementById("password").value;

            // Check if password is at least 8 characters long, includes one uppercase letter, and one special character
            var passwordRegex = /^(?=.*[A-Z])(?=.*[\W_]).{8,}$/;

            if (!passwordRegex.test(password)) {
                alert("Password must be at least 8 characters long, and include at least one uppercase letter and one special character.");
                event.preventDefault();  // Prevent form submission if validation fails
                return;
            }
        });
    </script>
</body>
</html>
