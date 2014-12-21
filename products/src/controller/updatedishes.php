<?php
	$uid = $_SESSION['login_user_id'];

	$comment = $_POST['text'];
	$dishId = $_POST['id'];
	$url = $_POST['url'];

	// 料理情報の更新
	$updateDishInfo = Dish::updateDishInfo($app, $uid, $comment, $dishId, $url);
	
	header("location: /easymenu/");
	exit;