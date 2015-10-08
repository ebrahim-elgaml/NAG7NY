<li class="list-group-item" style="text-align: -webkit-center;" id = "cart-<?php echo $cart['cart_id'];?>">
	<?php echo $cart['name']." (".$cart['price']."$)";?>
	<a href="#" class= "add" id = "add-<?php echo $cart['id'];?>"><span class="glyphicon glyphicon-plus-sign pull-left" aria-hidden="true"></span></a>
	<a href="#" class= "minus"><span class="glyphicon glyphicon-minus-sign pull-left" aria-hidden="true"></span></a>
	<span class="badge pull-left number-items"> 1 </span>
	<div class="btn-group pull-right" style="margin-top: -1%;">
	    <button class="btn btn-success btn-sm buy-cart">BUY</button>
	    <button class="btn btn-danger btn-sm remove-cart">REMOVE</button>
	</div><!-- /.btn-group -->
</li>