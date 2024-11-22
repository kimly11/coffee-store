<?php require "../layouts/header.php"; ?>
<?php require "../../configs/config.php"; ?>
<?php 
//require "../configs/config.php"; // Ensure this file sets up your database connection

// if(isset($_SESSION['username'])){
//   header("localtion: ".APPURL."");
// }

if (isset($_POST['submit'])) {
    if (empty($_POST['email']) || empty($_POST['password'])) {
        echo "<script>alert('One or more inputs are empty');</script>";
    } else {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Prepare a query to check email
        $login = $conn->prepare("SELECT * FROM admins WHERE email = ?");
        $login->bind_param("s", $email); // 's' indicates that the parameter is a string
        $login->execute();

        // Fetch the result
        $result = $login->get_result();
        $fetch = $result->fetch_assoc();

        if ($fetch) { // Check if a user was found
            if (password_verify($password, $fetch['password'])) {
                // Start session
                // $_SESSION['username'] = $fetch['username'];
                // $_SESSION['email'] = $fetch['email'];
                // $_SESSION['user_id'] = $fetch['id'];

                // session_start(); // Start the session
                // $_SESSION['user_id'] = $fetch['id']; // Store user ID in session (optional)
                header("Location: ".ADMINURL.""); // Redirect to the desired location
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



      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mt-5">Login</h5>
              <form method="POST" action="login-admins.php" class="p-auto">
                  <!-- Email input -->
                  <div class="form-outline mb-4">
                    <input type="email" name="email" id="form2Example1" class="form-control" placeholder="Email" />
                   
                  </div>

                  
                  <!-- Password input -->
                  <div class="form-outline mb-4">
                    <input type="password" name="password" id="form2Example2" placeholder="Password" class="form-control" />
                    
                  </div>



                  <!-- Submit button -->
                  <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Login</button>

                 
                </form>

            </div>
       </div>
     </div>
    </div>
    <?php require "../layouts/footer.php"; ?>
