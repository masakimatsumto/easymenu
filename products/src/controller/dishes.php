<?php

	$uid = $_SESSION['login_user_id'];
	$day = date("Y-m-d");
	$dishId = $id1;

	// 料理の情報を取得
	$dishinfo = Dish::getDishinfo($app, $uid, $dishId);


	$app->render("dishes.tpl", array(
		"date" => $day, 
		"dishName" => $dishinfo[0],
		"dishMemo" => $dishinfo[1],
		"dishUrl" => $dishinfo[2],
		"dishid" => $id1
		));