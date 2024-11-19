<?php 
  require "../includes/header.php"; 
  require "../configs/config.php";
?>
<?php 
require "../configs/config.php"; // Ensure this file sets up your database connection

if(isset($_SESSION['username'])){
  header("localtion: ".APPURL."");
}

if (isset($_POST['submit'])) {
    if (empty($_POST['email']) || empty($_POST['password'])) {
        echo "<script>alert('One or more inputs are empty');</script>";
    } else {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Prepare a query to check email
        $login = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $login->bind_param("s", $email); // 's' indicates that the parameter is a string
        $login->execute();

        // Fetch the result
        $result = $login->get_result();
        $fetch = $result->fetch_assoc();

        if ($fetch) { // Check if a user was found
            if (password_verify($password, $fetch['password'])) {
                // Start session
                $_SESSION['username'] = $fetch['username'];
                $_SESSION['email'] = $fetch['email'];
                $_SESSION['user_id'] = $fetch['id'];

                session_start(); // Start the session
                $_SESSION['user_id'] = $fetch['id']; // Store user ID in session (optional)
                header("Location: ".APPURL.""); // Redirect to the desired location
                exit(); // Always exit after a redirect
            } else {
                echo "<script>alert('Email and password are incorrect');</script>";
            }
        } else {
            echo "<script>alert('Email and password are incorrect');</script>";
        }
    }
}
?>

    <section class="home-slider owl-carousel">

      <div class="slider-item" style="background-image: url(<?php echo APPURL; ?>/Imag/login.jpg);" data-stellar-background-ratio="0.5">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row slider-text justify-content-center align-items-center">

            <div class="col-md-7 col-sm-12 text-center ftco-animate">
            	<h1 class="mb-3 mt-5 bread">Login</h1>
	            <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Login</span></p>
            </div>

          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12 ftco-animate">
			<form action="login.php" method="POST" class="billing-form ftco-bg-dark p-3 p-md-5">
				<h3 class="mb-4 billing-heading">Login</h3>
	          	<div class="row align-items-end">
	          		<div class="col-md-12">
	                <div class="form-group">
	                	<label for="Email">Email</label>
	                  <input name="email" type="text" class="form-control" placeholder="Email">
	                </div>
	              </div>
                 
	              <div class="col-md-12">
	                <div class="form-group">
	                	<label for="Password">Password</label>
	                    <input name="password" type="password" class="form-control" placeholder="Password">
	                </div>

                </div>
                <div class="col-md-12">
                	<div class="form-group mt-4">
							<div class="radio">
                    <button name="submit" type="submit" class="btn btn-primary py-3 px-4">Login</button>
						    </div>
					</div>
                </div>

               
	          </form><!-- END -->
          </div> <!-- .col-md-8 -->
          </div>
        </div>
      </div>
    </section> <!-- .section -->

<?php require "../includes/footer.php"; ?>