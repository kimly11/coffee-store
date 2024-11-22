<?php 
require "../includes/header.php"; 
require "../configs/config.php"; 
//session_start(); // Start the session at the beginning

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare a statement to fetch the main product
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->bind_param("i", $id); // Assuming id is an integer
    $stmt->execute();
    $result = $stmt->get_result();
    $singleProduct = $result->fetch_object();

    // Check if the product was found
    if ($singleProduct) {
        // Fetch related products
        $relatedStmt = $conn->prepare("SELECT * FROM products WHERE type = ? AND id != ?");
        $relatedStmt->bind_param("si", $singleProduct->type, $singleProduct->id); // Assuming type is a string and id is an integer
        $relatedStmt->execute();
        $relatedResult = $relatedStmt->get_result();

        // Fetch all related products as an array of objects
        $allRelatedProducts = [];
        while ($relatedProduct = $relatedResult->fetch_object()) {
            $allRelatedProducts[] = $relatedProduct;
        }

        // Add to cart logic
        if (isset($_POST['submit'])) {
            // Use the product details directly
            $name = $singleProduct->name; // Get product name from fetched product
            $image = $singleProduct->image; // Assuming this is the image URL/path
            $price = $singleProduct->price; // Get product price
            $description = $singleProduct->description; // Get product description
            $quantity = $_POST['quantity'];    
            $user_id = $_SESSION['user_id'];

            // Prepare the statement to insert into cart
            $insert_cart = $conn->prepare("INSERT INTO cart (name, image, price, pro_id, description, quantity, user_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
        
            // Bind the parameters
            $insert_cart->bind_param("ssdsiis", $name, $image, $price, $id, $description, $quantity, $user_id);
            // Execute the statement
            if ($insert_cart->execute()) {
                echo "<p>Item added to cart successfully!</p>";
            } else {
                echo "<p>Error adding item to cart: " . $conn->error . "</p>";
            }
        }

        // Validate if the product is already in the cart
        if (isset($_SESSION['user_id'])) {
            // Prepare the statement for cart validation
            $validateCart = $conn->prepare("SELECT * FROM cart WHERE pro_id = ? AND user_id = ?");
            $validateCart->bind_param("ii", $id, $_SESSION['user_id']); // Assuming both are integers
            $validateCart->execute();
            $validateResult = $validateCart->get_result();

            $rowCount = $validateResult->num_rows; // Correct way to get the number of rows
            if ($rowCount > 0) {
                echo "<p>This product is already in your cart.</p>";
            }
        }

    } else {
        echo "<p>Product not found.</p>";
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
				<form method="POST" action="product-single.php?id=<?php echo $id; ?>">

						<div class="row mt-4">
							<!-- <div class="col-md-6">
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
		            		</div> -->
						</div>
					<div class="w-100"></div>
					<div class="input-group col-md-6 d-flex mb-3">
	             	<span class="input-group-btn mr-2">
	                	<button type="button" class="quantity-left-minus btn"  data-type="minus" data-field="">
	                   		<i class="icon-minus"></i>
	                	</button>
	            	</span>

	             	<input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="100">
	             	<span class="input-group-btn ml-2">
	                		<button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
	                     	<i class="icon-plus"></i>
	                 	</button>
	             	</span>
	          		</div>
          		</div>
			
				<input name="name" value="<?php echo $singleProduct->name; ?>" type="hidden">
				<input name="image" value="<?php echo $singleProduct->image; ?>" type="hidden">
				<input name="price" value="<?php echo $singleProduct->price; ?>" type="hidden">
				<input name="pro_id" value="<?php echo $singleProduct->id; ?>" type="hidden">
				<input name="description" value="<?php echo $singleProduct->description; ?>" type="hidden">
				<?php if($rowCount > 0) : ?>
					<button name="submit" type="submit" class="btn btn-primary py-3 px-5" disabled>Added to Cart</button>
				<?php else : ?>
          			<button name="submit" type="submit" class="btn btn-primary py-3 px-5">Add to Cart</button>
				<?php endif; ?>
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