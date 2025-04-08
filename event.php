<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Event Management System</title>
    <!-- Updated Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

    <style>
.button-box {
  width: 320px;
  margin: 35px auto;
  position: relative;
  border-radius: 30px;
  background: #fff;
}

.toggle-btn {
  padding: 10px 40px;
  cursor: pointer;
  background: transparent;
  border: 0;
  outline: none;
  position: relative;
  text-align: center;
}

#btn {
  left: 0;
  top: 0;
  position: absolute;
  width: 160px;
  height: 100%;
  background: var(--theme-color);
  border-radius: 30px;
  transition: .5s;
}

/* Modal styles */
.modal {
    display: none; /* Hidden by default */
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.4); /* Background overlay */
}

/* Modal content */
.modal-content {
    background-color: #fff;
    margin: 20% auto; /* Reduced margin for bigger popup */
    padding: 30px; /* Increased padding */
    border: 1px solid #888;
    width: 400px; /* Increased width */
    border-radius: 10px;
    text-align: center;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Added shadow for better visibility */
}

/* Close button in the modal */
.close-btn {
    color: #aaa;
    font-size: 32px; /* Larger close icon */
    font-weight: bold;
    float: right;
    cursor: pointer;
}

.close-btn:hover,
.close-btn:focus {
    color: black;
    cursor: pointer;
}

/* Modal button styles */
.modal-content button {
    padding: 15px 30px; /* Increased padding */
    font-size: 18px; /* Increased font size */
    border-radius: 8px;
    border: 1px solid #888;
    cursor: pointer;
    background-color: #007bff; /* Blue background */
    color: white;
    transition: background-color 0.3s, transform 0.3s;
}

/* Add space between Yes and No buttons */
.modal-content button:not(:last-child) {
    margin-right: 20px; /* Space between the buttons */
}

/* Hover effects for buttons */
.modal-content button:hover {
    background-color: #0056b3; /* Darker blue on hover */
    transform: scale(1.05); /* Slight zoom effect */
}

/* Active state for buttons */
.modal-content button:active {
    transform: scale(1); /* Reset scale when button is clicked */
}

/* Adjust button layout on small screens */
@media (max-width: 500px) {
    .modal-content {
        width: 90%; /* Make modal more responsive */
    }
    .modal-content button {
        width: 100%; /* Make buttons full width on small screens */
        margin-bottom: 10px;
    }
    .modal-content button:not(:last-child) {
        margin-right: 0; /* Remove margin on small screens */
    }
}











    </style>
</head>
<body>
    <header class="header">
        <a href="#" class="logo"> <span>A</span>yesha(bc200401541)</a>
        <nav class="navbar">
            <a href="#">Home</a>
            <a href="#services">Services</a>
            <a href="#">About</a>
            <a href="register.php">Register</a>
            <a href="index.php">Login</a>
            <div id="menu-bar" class="fas fa-bars"></div>
        </nav>
    </header>

    <!-- Home Section -->
    <section class="home" id="home">
        <div class="content">
            <h3>Where your dreams will take off <br>  
            <span>AyeshaPlannerPro</span></h3>
           

            <div class="form-box">
  <div class="button-box">
    <div id="btn"></div>
    <button type="button" class="toggle-btn" onclick="attendeeClick()"> Attendee</button>
    <button type="button" class="toggle-btn" onclick="organizerClick()">Organizer</button>
  </div>
</div>






            
        </div>
        <div class="swiper-container home-slider">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="assets/image1.jpg.webp" alt="Image 1">
                </div>
                <div class="swiper-slide">
                    <img src="assets/image10.jpg" alt="Image 10">
                </div>
                <div class="swiper-slide">
                    <img src="assets/image3.jpg" alt="Image 3">
                </div>
                <div class="swiper-slide">
                    <img src="assets/image4.jpg" alt="Image 4">
                </div>
                <div class="swiper-slide">
                    <img src="assets/image5.jpg" alt="Image 5">
                </div> 
                <div class="swiper-slide">
                    <img src="assets/image6.jpg" alt="Image 6">
                </div> 
                <div class="swiper-slide">
                    <img src="assets/image7.jpg" alt="Image 7">
                </div>
                <div class="swiper-slide">
                    <img src="assets/image9.jpg" alt="Image 9">
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="service" id="services">
        <h1 class="heading">Our <span>Services</span></h1>
        <div class="box-container">
            <div class="box">
                <div class="fas fa-envelope"></div>
                <h3>Invitation Card Design</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis, quia illum quas maiores modi minima deserunt doloremque quos voluptatum dolore.</p>
            </div>
    
            <div class="box">
                <div class="fas fa-photo-video"></div>
                <h3>Photo and Video</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis, quia illum quas maiores modi minima deserunt doloremque quos voluptatum dolore.</p>
            </div>
    
            <div class="box">
                <div class="fas fa-music"></div>
                <h3>Entertainment</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis, quia illum quas maiores modi minima deserunt doloremque quos voluptatum dolore.</p>
            </div>
    
            <div class="box">
                <div class="fas fa-birthday-cake"></div>
                <h3>Custom Food</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis, quia illum quas maiores modi minima deserunt doloremque quos voluptatum dolore.</p>
            </div>

            <div class="box">
                <div class="fas fa-music"></div>
                <h3>Entertainment</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis, quia illum quas maiores modi minima deserunt doloremque quos voluptatum dolore.</p>
            </div>

            <div class="box">
                <div class="fas fa-photo-video"></div>
                <h3>Photography</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis, quia illum quas maiores modi minima deserunt doloremque quos voluptatum dolore.</p>
            </div>
            <div class="box">
                <div class="fas fa-photo-video"></div>
                <h3>Photo and Video</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis, quia illum quas maiores modi minima deserunt doloremque quos voluptatum dolore.</p>
            </div>
            <div class="box">
                <div class="fas fa-music"></div>
                <h3>Entertainment</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis, quia illum quas maiores modi minima deserunt doloremque quos voluptatum dolore.</p>
            </div>
    
        </div>
    </section>

    <footer class="footer">
        <div class="footercontainer">
            <div class="socialicons">
                <a href=""><i class="fa-brands fa-facebook"></i></a>
                <a href=""><i class="fa-brands fa-instagram"></i></a>
                <a href=""><i class="fa-brands fa-twitter"></i></a>
                <a href=""><i class="fa-brands fa-youtube"></i></a>
            </div>
            <div class="footernav">
                <ul>
                    <li><a href="">home</a></li>
                    <li><a href="">about</a></li>
                    <li><a href="">contact us</a></li>
                    <li><a href="">our team</a></li>
                </ul>
            </div>
        </div>

        <div class="footerbottom">
            <p>copyright &copy;2025; Designed by <span class="designer">Ayesha</span></p>
        </div>
    </footer>



    <!-- Modal for Confirmation -->
    <div id="confirmation-modal" class="modal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeModal()">&times;</span>
            <h1>Are you an <span id="role-text"></span>?</h1>
            <button onclick="confirmRole('yes')">Yes</button>
            <button onclick="confirmRole('no')">No</button>
        </div>
    </div>

    <!-- Swiper JS Library -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- Swiper Initialization Script -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<!-- Swiper Initialization Script -->

<script>
 var btn = document.getElementById('btn');
        var modal = document.getElementById("confirmation-modal");
        var roleText = document.getElementById("role-text");
        var roleToConfirm = '';

        // Attendee button clicked
        function attendeeClick() {
            btn.style.left = '0';
            roleToConfirm = 'Attendee';
            roleText.innerHTML = 'Attendee';
            showModal();
        }

        // Organizer button clicked
        function organizerClick() {
            btn.style.left = '160px'; // Adjust this value based on the width of the buttons
            roleToConfirm = 'Organizer';
            roleText.innerHTML = 'Organizer';
            showModal();
        }

        // Show the modal
        function showModal() {
            modal.style.display = "block";
        }

        // Close the modal
        function closeModal() {
            modal.style.display = "none";
        }

        // Handle user confirmation
        function confirmRole(response) {
            if (response === 'yes') {
                window.location.href = 'index.php?role=' + roleToConfirm.toLowerCase();
            } else {
                closeModal(); // Close modal if "No" is selected
            }
        }












    






        var swiper = new Swiper(".home-slider", {
            effect: "coverflow",
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: "auto",
            coverflowEffect: {
                rotate: 0,
                stretch: 0,
                depth: 100,
                modifier: 2,
                slideShadows: true,
            },
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
        });


       
    </script>
</body>
</html>
