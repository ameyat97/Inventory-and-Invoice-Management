<?php
$bill = "myButtons";
$logout = "myButtons";
$menuLinkid1 = basename($_SERVER['PHP_SELF'],".php");
if($menuLinkid1 == "bill"){
	$bill = 'myActiveButton';
}
else if($menuLinkid1 == "logout"){
	$logout = 'myActiveButton';
}
?>
<li><a class="<?php echo $bill;?>" href="bill.php">Bill</a></li>
<li><a class="<?php echo $logout;?>" href="stafflogout.php">Logout</a></li>