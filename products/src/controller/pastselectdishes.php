<?php

	$day = date("Y-m-d");
	$uid = $_SESSION['login_user_id'];

	// 過去に選択された献立の取得
	$pastselectedlist = User::pastSelectedList($app, $uid, $day);

	$app->render("pastselectdishes.tpl",array(
		'uid' => $uid ,
		'pastselectedlist' => $pastselectedlist
		));
