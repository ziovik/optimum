<?php

session_start();

function addToCart(){

	if (empty($_SESSION['product_name']) {
		
		$_SESSION['product_id'] = array();
		$_SESSION['product'] = array();
		$_SESSION['quantity'] = array();
		$_SESSION['price'] = array();
	}

	array_push($_SESSION['product_name'], $_POST['name']);  // get the name of the one clicked and put it in session

	array_push($_SESSION['quantity'], $_POST['quantity']);  // getting the quantity input and put in session

	array_push($_SESSION['price'], $_POST['price']); 
}


function writeCart($cnum){
    if (!empty($_SESSION['product_name'])){
    	$product_name = $_SESSION['product_name'];
    	$product_id = $_SESSION['product_id'];
    	$quantity = $_SESSION['quantity'];
    	$price = $_SESSION['price'];

    	// write the table headings
    	echo'
    	<table class="listTable " style="font-size: .917em;" cellpadding=2>
              <thead>
                 <tr>
                    <th>
                        Product_id
                    </th>
                     <th>
                        product_name
                    </th>
                     <th>
                        Price
                    </th>
                     <th>
                        	Quantity
                    </th>

                 </tr>
              </thead>
    	</table>';

    	//loop to write each row in the cart

    	$total = 0;

    	for ($i=0; $i < count($product_name); $i++)
    	 { 
    		echo ('<tr>');
	    		echo ('<td>'  .  $product_id[$i] . '</td>');
	    		echo ('<td>'  .  $product_name[$i] . '</td>');
	    		echo ('<td class = "right">rub.'  .  $price[$i] . '</td>');

	    		if($cnum < 0) 
	    			echo ('<td><input type="text" name= "quantity[]" size="7" value = "'.$quantity[$i].'" /></td>');
	    		else
	    			echo('<td class="right">'.$quantity[$i].'</td>');
	    		    echo ('<td class="right">rub. '.number_format($price[$i]*$quantity[$i], 2).'</td>');

    		 echo ('</tr>');

    		 $total = $total + $price[$i] * $quantity[$i];
    	 }

        echo ('<tr>
        	        <td colspan = "5" class ="right">

        	            <strong>
                             SubTotal: &nbsp; 
        	            </strong>
        	        </td>
        	        <td class="right">
                        rub.'.number_format($total, 2).'
        	        </td>    

        	</tr>');
        if ($cnum < 0) {
        	echo ('<tr><td colspan = "6" align= "center">');
        	echo ('<input type ="submit "  name="update"  value="update_cart"  />');
        	echo('<input type="button" name="clear" value="Clear Cart" onclick="window.location.href=\'cart.php?clear=1\';"  />');
        	echo ('<input type="button" name="checkout" value="check out" onclick="window.open.href=\'checkout.php\';" />');	
        	echo ('</td></tr>')  ;    
    	 
        }


    }else {
    	echo ("<h2>yOUR cart IS EMPTY</h2>");
    }
}
?>