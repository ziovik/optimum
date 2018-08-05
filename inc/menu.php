<span class="category-header">Категории <i class="fa fa-list"></i></span>

<ul class="category-list">
	<?php
	$categories = get_all_categories();

	foreach ($categories as $category) {
		?>
		<li class="dropdown side-dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><?php echo $category->name ?>
				<i class="fa fa-angle-right"></i>
			</a>
			<div class="custom-menu">
				<div class="row">
					<div class="col-md-4">
						<ul class="list-links">
							<li>
								<h3 class="list-links-title">
									<a href="products/products_by_category.php?category_id=<?php echo $category->id ?>">
										<?php echo $category->name ?>
									</a>
								</h3>
							</li>
							<?php

							$sub_categories = get_sub_categories_by_category_id($category->id);

							foreach ($sub_categories as $sub_category) {
								echo
								"<li style='width:300px;'>
									<a href='products/products_by_sub_category.php?sub_category_id=$sub_category->id'>
									$sub_category->name</a>
								</li>";
							}

							?>
						</ul>
						<hr class="hidden-md hidden-lg">
					</div>
				</div>
		</li>
		<?php

	}

	?>


	<li><a href="all_products.php?all_products">Все продукты</a></li>
</ul>

</div>
<!-- menu nav -->
<div class="menu-nav">
	<span class="menu-header">Menu <i class="fa fa-bars"></i></span>
	<ul class="menu-list">

		<li id="center1"><a href="../all_products.php?all_products" title="живой пойск"></a></li>
	</ul>
</div>
<!-- menu nav -->