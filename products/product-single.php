<?php 
  require "../includes/header.php"; 
  require "../configs/config.php";
?>
<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
	// data for singleProduct
    // Prepare a statement to prevent SQL injection for the main product
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
    
    // Bind the parameter
    $stmt->bind_param("i", $id); // Assuming id is an integer

    // Execute the statement
    $stmt->execute();
    
    // Get the result
    $result = $stmt->get_result();

    // Fetch the product as an object
    $singleProduct = $result->fetch_object();

    // Check if the product was found
    if ($singleProduct) {
        // You can now use $singleProduct to display details
		//data for relateProducts
        // Prepare a statement to fetch related products
        $relatedStmt = $conn->prepare("SELECT * FROM products WHERE type = ? AND id != ?");
        
        // Bind the parameters
        $relatedStmt->bind_param("si", $singleProduct->type, $singleProduct->id); // Assuming type is a string and id is an integer

        // Execute the statement
        $relatedStmt->execute();
        
        // Get the result for related products
        $relatedResult = $relatedStmt->get_result();

        // Fetch all related products as an array of objects
        $allRelatedProducts = [];
        while ($relatedProduct = $relatedResult->fetch_object()) {
            $allRelatedProducts[] = $relatedProduct;
        }

        // Now you can display related products or perform other actions with $allRelatedProducts
    } else {
        echo "<p>Product not found.</p>";
    }


	// Add to cart
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $image = $_POST['image'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $quantity = $_POST['quantity'];    
    $user_id = $_SESSION['user_id'];

    // Prepare the statement
    $insert_cart = $conn->prepare("INSERT INTO cart (name, image, price, description, quantity, user_id) VALUES (?, ?, ?, ?, ?, ?)");

    // Bind the parameters
    $insert_cart->bind_param("ssdsii", $name, $image, $price, $description, $quantity, $user_id); 
    // Assuming price is a double (d), and quantity and user_id are integers (i)

    // Execute the statement
    if ($insert_cart->execute()) {
        echo "<p>Item added to cart successfully!</p>";
    } else {
        echo "<p>Error adding item to cart: " . $conn->error . "</p>";
    }
}

} else {
    echo "<p>No product ID specified.</p>";	
}
?>
    <section class="home-slider owl-carousel">

      <div class="slider-item" style="background-image: url(<?php echo  APPURL; ?>/images/bg_3.jpg);" data-stellar-background-ratio="0.5">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row slider-text justify-content-center align-items-center">

            <div class="col-md-7 col-sm-12 text-center ftco-animate">
            	<h1 class="mb-3 mt-5 bread">Product Detail</h1>
	            <p class="breadcrumbs"><span class="mr-2"><a href="<?php echo  APPURL; ?>">Home</a></span> <span>Product Detail</span></p>
            </div>

          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section">
    	<div class="container">
    		<div class="row">
    			<div class="col-lg-6 mb-5 ftco-animate">
    				<a href="images/menu-2.jpg" class="image-popup"><img src="<?php echo APPURL; ?>/images/<?php echo $singleProduct->image; ?>" class="img-fluid" alt="Colorlib Template"></a>
    			</div>
    			<div class="col-lg-6 product-details pl-md-5 ftco-animate">
    				<h3><?php echo $singleProduct->name; ?></h3>
    				<p class="price"><span>$<?php echo $singleProduct->price; ?></span></p>
    				<p>
					<?php echo $singleProduct->description; ?>
					</p>
						<div class="row mt-4">
							<div class="col-md-6">
								<div class="form-group d-flex">
								<div class="select-wrap">
								<div class="icon"><span class="ion-ios-arrow-down"></span></div>
								<select name="" id="" class="form-control">
									<option value="">Small</option>
									<option value="">Medium</option>
									<option value="">Large</option>
									<option value="">Extra Large</option>
								</select>
	                			</div>
		            		</div>
						</div>
					<div class="w-100"></div>
					<div class="input-group col-md-6 d-flex mb-3">
	             	<span class="input-group-btn mr-2">
	                	<button type="button" class="quantity-left-minus btn"  data-type="minus" data-field="">
	                   		<i class="icon-minus"></i>
	                	</button>
	            	</span>
				<form method="POST" action="product-single.php?id=<?php echo $id; ?>">

	             	<input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="100">
	             	<span class="input-group-btn ml-2">
	                		<button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
	                     	<i class="icon-plus"></i>
	                 	</button>
	             	</span>
	          		</div>
          		</div>
			
				<input name="name" value="<?php echo $singleProduct->name; ?>" type="text">
				<input name="image" value="<?php echo $singleProduct->image; ?>" type="text">
				<input name="price" value="<?php echo $singleProduct->price; ?>" type="text">
				<input name="description" value="<?php echo $singleProduct->description; ?>" type="text">
          		<p><button name="submit" type="submit" class="btn btn-primary py-3 px-5">Add to Cart</button></p>
			</form>	
    			</div>
    		</div>
    	</div>
    </section>

    <section class="ftco-section">
    	<div class="container">
    		<div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-7 heading-section ftco-animate text-center">
          	<span class="subheading">Discover</span>
            <h2 class="mb-4">Related products</h2>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
          </div>
        </div>
        <div class="row">
			<?php foreach($allRelatedProducts as $allRelatedProduct) : ?>
        	<div class="col-md-3">
        		<div class="menu-entry">
    					<a href="<?php echo APPURL; ?>/products/product-single.php?id=<?php echo $allRelatedProduct->id; ?>" class="img" style="background-image: url(<?php echo APPURL; ?>/images/<?php echo $allRelatedProduct->image; ?>);"></a>
    					<div class="text text-center pt-4">
    						<h3><a href="<?php echo APPURL; ?>/products/product-single.php?id=<?php echo $allRelatedProduct->id; ?>"><?php echo $allRelatedProduct->name; ?></a></h3>
    						<p>
							<?php echo $allRelatedProduct->description; ?>
							</p>
    						<p class="price"><span>$<?php echo $allRelatedProduct->price; ?></span></p>
    						<p><a href="<?php echo APPURL; ?>/products/product-single.php?id=<?php echo $allRelatedProduct->id; ?>" class="btn btn-primary btn-outline-primary">Show</a></p>
    					</div>
    				</div>
			</div>
			<?php endforeach; ?>
        </div>
    	</div>
    </section>

<?php 
	require "../includes/footer.php";
?>