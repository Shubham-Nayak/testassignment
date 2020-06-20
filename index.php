<?php 
session_start();

$session_id=session_id();
$connect = mysqli_connect("localhost", "root", "", "product");

if(isset($_POST["add_to_cart"]))
{
	if(isset($_SESSION["shopping_cart"]))
	{
		$item_array_id = array_column($_SESSION["shopping_cart"], "product_id");
		if(!in_array($_GET["id"], $item_array_id))
		{
			$count = count($_SESSION["shopping_cart"]);
			$item_array = array(
				'product_id'			=>	$_GET["id"],
				'product_name'			=>	$_POST["product_name"],
				'product_price'			=>	$_POST["product_price"],

			);
			if(!empty($_POST["color"]))
			{
				$item_array['color']=	$_POST["color"];

			}
			$_SESSION["shopping_cart"][$count] = $item_array;
		}
		else
		{
			echo '<script>alert("Item Already Added")</script>';
		}
	}
	else
	{
		$item_array = array(
			'product_id'			=>	$_GET["id"],
			'product_name'			=>	$_POST["product_name"],
			'product_price'			=>	$_POST["product_price"],
			'colors'			=>	$_POST["color"],



		);
		$_SESSION["shopping_cart"][0] = $item_array;
	}
}

if(isset($_GET["action"]))
{
	if($_GET["action"] == "delete")
	{
		foreach($_SESSION["shopping_cart"] as $keys => $values)
		{
			if($values["product_id"] == $_GET["id"])
			{
				unset($_SESSION["shopping_cart"][$keys]);
				echo '<script>alert("Item Removed")</script>';
				echo '<script>window.location="index.php"</script>';
			}
		}
	}
}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Easypairs</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	</head>
	<body>
		<!-- Image and text -->

<!-- Button trigger modal -->
<nav class="navbar navbar-light bg-light justify-content-between">
  <form class="form-inline">
  <button type="button" class="btn btn-primary mr-sm-2 " data-toggle="modal" data-target="#exampleModal">
  <?php if(!empty($_SESSION["shopping_cart"]))
  {
 echo "cart (".count($_SESSION["shopping_cart"]).")";

  }
  else{
 echo "Cart";
  }?>
</button>
  </form>
</nav>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

	
	  <h3>Order Details</h3>
			<div class="table-responsive">

				<table class="table table-bordered">
					<tr>
						<th width="40%">Item Name</th>
						<th width="5%">Action</th>
						
					</tr>
					<?php
					if(!empty($_SESSION["shopping_cart"]))
					{
						$total = 0;
						foreach($_SESSION["shopping_cart"] as $keys => $values)
						{
					?>
					<tr>
						<td><?php echo $values["product_name"]; ?></td>
						
						<td><a href="index.php?action=delete&id=<?php echo $values["product_id"]; ?>"><span class="text-danger"> Remove</span></a></td>
					</tr>
					<?php
							$total = $total + ((int)$values["product_price"]);
						}
					?>
					 <tr>
						<td colspan="" align="right">Total</td>
						<td align="right">RS. <?php echo number_format($total, 2); ?></td>
						
					</tr> 
			<form method="post" action="index.php">

					<tr>
						<input type="hidden"  name="product_id" value="<?php $_SESSION["product_id"];?>">
						<input type="hidden"  name="session" value="<?php $_SESSION["shopping_cart"];?>">

						<td align="right"><input type="submit" class="btn btn-success" name="submit" value="Buy Now"></td>

					</tr> 
			</form>

					<?php
					}
					?>
						
				</table>
			</div>
		</div>
	</div>
      </div>
  
    </div>
  </div>
</div>
		<br />
		<div class="container">
			<br />
			<br />
			<br />
			<h3 align="center">Created By <a href="http://easypairs.herokuapp.com/" >Easypair</a></h3><br />
			<br /><br />
			<?php
				$query = "SELECT * FROM product_commonmaster ORDER BY product_id ASC";
				$result = mysqli_query($connect, $query);
				if(mysqli_num_rows($result) > 0)
				{
					while($row = mysqli_fetch_array($result))
					{
						$query = "SELECT * FROM product_colors ORDER BY colors_id ASC";
				$color = mysqli_query($connect, $query);
				?>
			<div class="col-md-4">
				<form method="post" action="index.php?action=add&id=<?php echo $row["product_id"]; ?>">

					<div class="card" style="width: 18rem;">
  <img class="card-img-top" src="images/<?php echo $row["image"]; ?>" alt="Card image cap" style="max-width:150px;max-height:100px;">
  <div class="card-body">
  <h4 class="text-info"><?php echo $row["product_name"]; ?></h4>

	<?php $i=1; foreach($color as $keys ):?>
     				 <input class="form-check-input" type="checkbox" id="gridCheck" name="color[]" value="<?php echo $keys["color_name"]; ?>" <?php if($i==1){ echo "required";}?>><?php echo $keys["color_name"]; ?>
						<?php $i+=1; endforeach;?>
	<input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />
	
	<p>Rs. <?php echo $row["product_price"]; ?></p>

<input type="hidden" name="product_name" value="<?php echo $row["product_name"]; ?>" />
<input type="hidden" name="product_price" value="<?php echo $row["product_price"]; ?>" />
  </div>
</div>
				</form>
			</div>
			<?php
					}
				}
			?>
			<div style="clear:both"></div>
			<br />

	<br />
	<div class="footer">
<p>Copyright © <a href="http://easypairs.herokuapp.com/" >Easypair</a> Created By: <a href="http://shubhamnayak.herokuapp.com/" >Shubham Nayak</a></p>

</div>
			</body>
</html>


<?php

if(isset($_POST['submit']))
{
	$data=array();
foreach($_SESSION["shopping_cart"] as $info)
{
	$data[]=$info;


}

$items = array();

// $size = count($names);

foreach($data as $d){

	$colors="";
	if(!empty($d['colors'])){
foreach($d['colors'] as $c)  
{  
  $colors .= $c.",";  
} 
}
  $items[] = array(
	 "product_id"     => $d['product_id'], 
	"colors"     => $colors, 


	 "session_id"=>$session_id,
  );
}

$values = array();
foreach($items as $item){
  $values[] = "('{$item['product_id']}','{$item['session_id']}','{$item['colors']}')";
}

$values = implode(", ", $values);

$sql = "
  INSERT INTO product_orders (product_id,session_id,colors) VALUES {$values} ;
" ;

$query=mysqli_query($connect,$sql);
unset($_SESSION["shopping_cart"]);

session_unset();
if($query)
{?>

<script>



swal({
    title: "Wow Order Has Benn Placed!",
    text: "Message!",
    type: "success",
	icon: "success",

}).then(function() {
    window.location = "index.php";
});

</script>
<?php	
}
// 
}
?>

