<?php
require_once 'db.php';

$post_order = isset($_POST["post_order_ids"]) ? $_POST["post_order_ids"] : [];
if(count($post_order)>0){
for($order_no= 0; $order_no < count($post_order); $order_no++)
{
 $query = "UPDATE listitems SET orderID = '".($order_no+1)."' WHERE id = '".$post_order[$order_no]."'";
 //echo $query;
 mysqli_query($con, $query);
}
//echo true; 
}else{
echo false; 
}

?>