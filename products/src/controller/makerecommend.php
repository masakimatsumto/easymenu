<?php
$uid = $_SESSION['login_user_id'];

require_once("../../products/easymenu/config.php");
$link = mysqli_connect($sv, $user, $pass, $dbname);
mysqli_set_charset($link, "utf8");

$result = mysqli_query($link, "SELECT mydishes FROM users WHERE id = $uid");
$row = mysqli_fetch_assoc($result);
$mydishlist = explode("," , $row["mydishes"]);

$result = mysqli_query($link, "SELECT useddishes FROM users WHERE id = $uid");
$row = mysqli_fetch_assoc($result);
$useddishlist = explode("," , $row["useddishes"]);

foreach($useddishlist as $dellist){
	$d = array_search($dellist, $mydishlist);
	unset($mydishlist[$d]);
}

$reclist = array();

foreach($mydishlist as $dishId){
	$dishtagid = mysqli_query($link, "SELECT tag1 FROM dishes WHERE id = $dishId");
	$ans = mysqli_fetch_assoc($dishtagid);
	if($reclist[$ans["tag1"]]){
		$reclist[$ans["tag1"]] = $reclist[$ans["tag1"]].",".$dishId;
	}else{
		$reclist[$ans["tag1"]] = $dishId;
	}
}
$a = json_encode($reclist);
mysqli_query($link, "UPDATE users SET recommendeddishes = '$a' WHERE id = $uid");
exit();
