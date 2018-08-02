
         
          $get_pro = "select
                            p.product_title,
                            p.product_price,
                            c.qty as qty,
                            d.dist_name, 
                            c.cart_status 
                      from 
                             products p 
                             join distributors d on p.dist_id = d.dist_id 
                             join cart c on c.p_id = p.product_id 
                             join customers cc where cc.customer_email = c.customer_email
                             order by c.cart_status  
                             
                             "  ;