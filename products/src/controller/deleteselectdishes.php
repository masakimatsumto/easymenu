<?php

	$uid = $_SESSION['login_user_id'];
	$day = $id1;
	$dishId = $id2;

		// select のデータを更新
		$selectdishes = Dish::deleteSelecteddishes($app, $uid, $day, $dishId, $id3);

		header("location: /easymenu/selectdishes");
		exit();