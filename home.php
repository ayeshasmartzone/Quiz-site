<?php 
session_start();
include("php/config.php");

if(!isset($_SESSION['valid'])){
    header("Location: index.php");
    exit();
}

$id = $_SESSION['id'];
$query = mysqli_query($con, "SELECT * FROM users WHERE Id=$id");

while ($result = mysqli_fetch_assoc($query)) {
    $res_Uname = $result['Username'];
    $res_Email = $result['Email'];
    $res_Cnic = $result['CNIC'];  // Fetch CNIC
    $res_ProfilePicture = $result['Profile_Picture'];  // Fetch Profile Picture
    $res_StudyProgram = $result['Study_Program'];  // Fetch Study Program
    $res_AboutMe = $result['About_Me'];  // Fetch About Me
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Home</title>
    <style>
        
        .profile-pic {
            width: 100px;            
            height: 100px;           
            border-radius: 50%;      
            object-fit: cover;       
            border: 3px solid #fff;  
            margin: 10px auto;       
            display: block;          
        }

        /* Style for the profile picture container to position it at the top */
        .profile-container {
            text-align: center;      /* Center align the content inside the container */
            margin-top: 0 px;        /* Space at the top */


            
        }
        /* General body styles */
body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f6f9;
}

/* Navigation Bar Styles */
.nav {
    background-color:rgb(93, 140, 187);
    color: white;
    padding: 15px 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.nav .logo p {
    font-size: 24px;
    margin: 0;
    font-weight: bold;
    text-transform: uppercase;
}

.nav .right-links {
    font-size: 16px;
}

.nav .right-links a {
    color: white;
    text-decoration: none;
    margin-right: 20px;
    font-weight: bold;
    transition: color 0.3s;
}

.nav .right-links a:hover {
    color: #1abc9c;
}

.nav .right-links .btn {
    background-color: #e74c3c;
    color: white;
    padding: 8px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.nav .right-links .btn:hover {
    background-color: #c0392b;
}

/* Main Content Styles */
main {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 50px 0px;
}



/* Container for top box */
.main-box.top {
    display: flex;
    justify-content: center;
    gap: 30px;
    margin-bottom: 30px;
}

/* Box styles for each section */
.box {
    
    background-color: white;
    padding: 35px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    width: 100%;
    text-align: center;
    transition: transform 0.3s, box-shadow 0.3s;
}

.box:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
}

/* Box Content */
.box p {
    font-size: 16px;
    color: #34495e;
    line-height: 1.6;
}

.box b {
    font-weight: bold;
    color: #2c3e50;
}

/* Bottom Box Section */
.main-box.bottom {
    display: flex;
    flex-direction: column;
    gap: 20px;
    width: 100%;
    max-width: 1200px;
    margin-top: 30px;
}

.bottom .box {
    width: 100%;
    text-align: left;
    padding: 20px;
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.bottom .box p {
    font-size: 16px;
    color: #34495e;
    margin: 10px 0;
}

.bottom .box b {
    font-weight: bold;
    color: #2c3e50;
}

/* Media Queries for Responsive Design */
@media (max-width: 768px) {
    .main-box.top {
        flex-direction: column;
        align-items: center;
    }

    .box {
        width: 100%;
        margin-bottom: 20px;
    }

    .bottom .box {
        width: 100%;
    }
}



    </style>
</head>
<body>
    <div class="nav">
        <div class="logo">
            <p><a href="home.php">Event Management System</a></p>
        </div>
        <div class="right-links">
            <a href="edit.php?Id=<?php echo $id; ?>">Change Profile</a>
            <a href="php/logout.php"> <button class="btn">Log Out</button> </a>
        </div>
    </div>

    <main>
        <div class="main-box top">
            <div class="profile-container">
                <!-- Display Profile Picture as Circle -->
                <?php if ($res_ProfilePicture != '') { ?>
                    <img src="<?php echo $res_ProfilePicture; ?>" alt="Profile Picture" class="profile-pic">
                <?php } else { ?>
                    <p>No profile picture uploaded.</p>
                <?php } ?>
            </div>
                </div>

            

            <div class="top">
                <div class="box">
                    <p>Hello <b><?php echo $res_Uname; ?></b>, Welcome to Event Management</p>
                </div> <br>
                <div class="box">
                    <p>Your email is <b><?php echo $res_Email; ?></b>.</p>
                </div> <br>
                
                <div class="box">
                    <p>Your CNIC is <b><?php echo $res_Cnic; ?></b>.</p> 
                </div> <br> 
            
                <div class="box">
                    <p>Your study program is <b><?php echo $res_StudyProgram; ?></b>.</p>
                </div> <br>
                
                <div class="box">
                    <p>About you: <b><?php echo $res_AboutMe; ?></b></p>
                </div>
            </div>
        </div>
        </div>
    </main>
</body>
</html>
