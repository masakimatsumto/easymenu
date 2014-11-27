<?php

	$day = date("Y-m-d");
	$uid = $_SESSION['login_user_id'];
	
	// 本日分のメニューを取得
	$selectdish = User::selectedDayList($app, $uid, $day);
	
	// 前日分までのuseddishes を削除
	$useddishes = Dish::deletePastUsedDishes($app, $uid, $day);

	$app->render("top.tpl", array(
		"uid" => $uid, 
		"day" => $day,
		"selectdish" => $selectdish
		));