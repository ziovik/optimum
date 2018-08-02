<!DOCTYPE html>
<?php include("inc/db.php");
 

 ?>
<html>
<head>
	<title>Inserting Products</title>
	<script type="text/javascript" src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
	<script >
		tinymce.init({selector:'textarea'});
	</script>
</head>
<body>

	<form action="insert_product.php" method="post" enctype="multipart/form-data">
		<table align="center" width="750" border="2" bgcolor="#F6F7F8">
			<tr align="center">
				<td colspan="8"><h2>Insert New Product here</h2></td>

			</tr>
			<tr>
				<td align="right"><b>Product Title:</b></td>
				<td><input type="text" name="product_title" size="80" required></td>
			</tr>
			<tr>
				<td align="right"><b>Product Category:</b></td>
				<td>
					<select name="product_cat" required>
						<option>Select category</option>
						<?php
                            $get_cats = "select * from categories";
	                        $run_cats = mysqli_query($con, $get_cats);

	                        while ($row_cats = mysqli_fetch_array($run_cats)){
		                       $cat_id = $row_cats['cat_id'];
		                       $cat_name = $row_cats['cat_name'];

		                       echo "<option value='$cat_id'>$cat_name</option>";
	                        }

						?>
					</select>
				</td>
			</tr>
			<tr>
				<td align="right"><b>Product Sub Categories:</b></td>
				<td>
					<select name="product_sub_cat">
						<option>Select  sub category</option>
						<?php
                            $get_sub_cats = "select * from sub_cat";
	                        $run_sub_cats = mysqli_query($con, $get_sub_cats);

	                        while ($row_sub_cats = mysqli_fetch_array($run_sub_cats)){
		                       $sub_cat_id = $row_sub_cats['sub_cat_id'];
		                       $sub_cat_name = $row_sub_cats['sub_cat_name'];

		                       echo "<option value='$sub_cat_id'>$sub_cat_name</option>";
	                        }

						?>
					</select>
				</td>
			</tr>
			<tr>
				<td align="right"><b>Product Brand:</b></td>
				<td>
					<select name="product_brand" required>
						<option>Select  Brands</option>
						<?php
                            $get_brands = "select * from brands";
	                        $run_brands = mysqli_query($con, $get_brands);

	                        while ($row_brands = mysqli_fetch_array($run_brands)){
		                       $brand_id = $row_brands['brand_id'];
		                       $brand_name = $row_brands['brand_name'];

		                       echo "<option value='$brand_id'>$brand_name</option>";
	                        }

						?>
					</select>
				</td>
			</tr>
			<tr>
				<td align="right"><b>Product Distributor:</b></td>
				<td>
					<select name="dist_id" required>
						<option>Select  Distributors</option>
						<?php
                            $get_dist = "select * from distributors";
	                        $run_dist = mysqli_query($con, $get_dist);

	                        while ($row_dist = mysqli_fetch_array($run_dist)){
		                       $dist_id = $row_dist['dist_id'];
		                       $dist_name = $row_dist['dist_name'];

		                       echo "<option value='$dist_id'>$dist_name</option>";
	                        }

						?>
					</select>
				</td>
			</tr>
			<tr>
				<td align="right"><b>Product Price:</b></td>
				<td><input type="text" name="product_price" required></td>
			</tr>
			<tr>
				<td align="right"><b>Product Description:</b></td>
				<td>
                    <textarea name="product_desc" cols="20" rows="10" ></textarea>
				</td>
			</tr>
			<tr>
				<td align="right"><b>Product Min Order:</b></td>
				<td><input type="text" name="min_order" size="80" required></td>
			</tr>
			<tr>
				<td align="right"><b>Product Manufacturer:</b></td>
				<td><input type="text" name="product_manu" size="80" required></td>
			</tr>
			<tr>
				<td align="right"><b>Product Keyword:</b></td>
				<td><input type="text" name="product_keyword" size="80" required></td>
			</tr>
			<tr>
				<td align="right"><b>Product Region:</b></td>
				<td>
					<select name="product_reg" required>
						<option>Select  Region</option>
						<?php
                            $get_reg = "select * from regions";
	                        $run_regs = mysqli_query($con, $get_reg);

	                        while ($row_regs = mysqli_fetch_array($run_regs)){
		                       $region_id = $row_regs['region_id'];
		                       $region_name = $row_regs['region_name'];

		                       echo "<option value='$region_id'>$region_name</option>";
	                        }

						?>
					</select>
				</td>
			</tr>
			
			
			<tr align="center">
				
				<td colspan="8"><input type="submit" name="insert_post" value="Insert Now"></td>
			</tr>
		</table>
	</form>

</body>
</html>

<?php

  if (isset($_POST['insert_post'])) {
  	
  	//geting text data from form fields
  	$product_title = $_POST['product_title'];
  	$product_cat = $_POST['product_cat'];
  	$product_sub_cat = $_POST['product_sub_cat'];
  	$product_brand = $_POST['product_brand'];
  	$product_price = $_POST['product_price'];
  	$product_desc = $_POST['product_desc'];
  	$product_min = $_POST['min_order'];
  	$product_manu = $_POST['product_manu'];
  	$product_keyword = $_POST['product_keyword'];
  	$product_reg = $_POST['product_reg'];
  	$dist_id = $_POST['dist_id'];
  	

    $insert_product = "insert into Products
  	(product_title,product_cat,product_sub_cat,product_brand,product_price,product_desc,min_order,product_manu,product_keyword,dist_id,region_id) values
  	('$product_title','$product_cat','$product_sub_cat','$product_brand','$product_price','$product_desc','$product_min','$product_manu','$product_keyword','$dist_id','$product_reg')";


  	//execute query

  	$insert_pro = mysqli_query($con, $insert_product);

  	if ($insert_pro) {
  		echo "<script>alert('Product has been added succesfully')</script>";
  		echo "<script>window.open('index.php?insert_product','_self')</script>";
  	}


  }

?>

