<?php 
   session_start();
   include("php/config.php");

   // Check if the user is logged in
   if(!isset($_SESSION['valid'])){
       header("Location: index.php");
       exit();
   }

   // Fetch user details if the user is logged in
   $id = $_SESSION['id'];
   $query = mysqli_query($con, "SELECT * FROM users WHERE Id=$id");

   // Initialize variables
   $res_Uname = $res_Email  = $res_Cnic = $res_StudyProgram = $res_AboutMe = $res_ProfilePicture = '';

   if ($query) {
       while ($result = mysqli_fetch_assoc($query)) {
           $res_Uname = $result['Username'];
           $res_Email = $result['Email'];
           $res_Cnic = $result['CNIC'];
           $res_StudyProgram = $result['Study_Program'];
           $res_AboutMe = $result['About_Me'];
           $res_ProfilePicture = $result['Profile_Picture'];
       }
   }

   // Handle profile update when form is submitted
   if (isset($_POST['submit'])) {
       $username = $_POST['username'];
       $email = $_POST['email'];
       $study_program = $_POST['study_program'];
       $about_me = $_POST['about_me'];
       $file_path = $res_ProfilePicture;  // Default to current picture

       // Handle file upload for profile picture
       if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
           // Get file details
           $file_name = $_FILES['profile_picture']['name'];
           $file_tmp = $_FILES['profile_picture']['tmp_name'];
           $file_size = $_FILES['profile_picture']['size'];
           $file_type = $_FILES['profile_picture']['type'];

           // Define the directory for uploading files
           $upload_dir = 'uploads/';

           if (!is_dir($upload_dir)) {
               mkdir($upload_dir, 0777, true);
           }

           $file_path = $upload_dir . basename($file_name);

           // Validate file type (JPEG, PNG, GIF)
           $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
           if (in_array($file_type, $allowed_types)) {
               // Move file to the server directory
               if (!move_uploaded_file($file_tmp, $file_path)) {
                   echo "Error uploading file.";
               }
           } else {
               echo "Invalid file type. Only JPG, PNG, or GIF are allowed.";
           }
       }

       // Update user details in the database
       $edit_query = mysqli_query($con, "UPDATE users SET Username='$username', Email='$email', Study_Program='$study_program', About_Me='$about_me', Profile_Picture='$file_path' WHERE Id=$id");

       if ($edit_query) {
           echo "<div class='message'><p>Profile Updated!</p></div><br>";
           echo "<a href='home.php'><button class='btn'>Go Home</button></a>";
       } else {
           echo "Error occurred: " . mysqli_error($con);
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
    <title>Change Profile</title>
    <style>
        /* Profile Picture Styling */
        .profile_picture {
            width: 100px;            
            height: 100px;           
            border-radius: 50%;      
            object-fit: cover;       
            border: 3px solid #fff;  
            margin: 10px auto;       
            display: block;          
        }
        .profile-container {
            text-align: center;      
            margin-top: 20px;        
        }
    </style>
</head>
<body>
    <div class="nav">
        <div class="logo">
            <p><a href="home.php">Logo</a></p>
        </div>
        <div class="right-links">
            <a href="#">Change Profile</a>
            <a href="php/logout.php"> <button class="btn">Log Out</button> </a>
        </div>
    </div>
    <div class="container">
        <div class="box form-box">
            <header>Change Profile</header>
            <form action="" method="post" enctype="multipart/form-data">
                <!-- Profile Picture -->
                <div class="profile-container">
                    <label for="profile_picture">Profile Picture</label><br>
                    <?php if ($res_ProfilePicture != '') { ?>
                        <img src="<?php echo $res_ProfilePicture; ?>" alt="Profile Picture" class="profile_picture">
                    <?php } else { ?>
                        <p>No profile picture uploaded.</p>
                    <?php } ?>
                    <input type="file" name="profile_picture" accept="image/*">
                </div>

                <!-- Username -->
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" value="<?php echo $res_Uname; ?>" autocomplete="off" required>
                </div>

                <!-- Email -->
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" value="<?php echo $res_Email; ?>" autocomplete="off" required>
                </div>

               

                <!-- Study Program -->
                <div class="field input">
                    <label for="study_program">Study Program</label>
                    <select name="study_program" id="study_program" required>
                        <option value="">Select Study Program</option>
                        <option value="BSCS" <?php if ($res_StudyProgram == "BSCS") echo "selected"; ?>>BSCS (Bachelor of Science in Computer Science)</option>
                        <option value="BSIT" <?php if ($res_StudyProgram == "BSIT") echo "selected"; ?>>BSIT (Bachelor of Science in Information Technology)</option>
                        <option value="BSSE" <?php if ($res_StudyProgram == "BSSE") echo "selected"; ?>>BSSE (Bachelor of Science in Software Engineering)</option>
                        <option value="BSDS" <?php if ($res_StudyProgram == "BSDS") echo "selected"; ?>>BSDS (Bachelor of Science in Data Science)</option>
                        <option value="BSMGT" <?php if ($res_StudyProgram == "BSMGT") echo "selected"; ?>>BSMGT (Bachelor of Science in Management)</option>
                        <option value="BSAI" <?php if ($res_StudyProgram == "BSAI") echo "selected"; ?>>BSAI (Bachelor of Science in Artificial Intelligence)</option>
                        <option value="MCS" <?php if ($res_StudyProgram == "MCS") echo "selected"; ?>>MCS (Master of Computer Science)</option>
                        <option value="MIT" <?php if ($res_StudyProgram == "MIT") echo "selected"; ?>>MIT (Master of Information Technology)</option>
                    </select>
                </div>

                <!-- About Me -->
                <div class="field input">
                    <label for="about_me">About Me</label>
                    <textarea name="about_me" id="about_me" rows="4" cols="50" required><?php echo $res_AboutMe; ?></textarea>
                </div>

                <!-- Submit Button -->
                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Update Profile">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
