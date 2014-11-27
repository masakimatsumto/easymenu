<?php

	$day = date("Y-m-d");
	$uid = $_SESSION['login_user_id'];

	// 選択されているレシピの取得
	$selectedlist = User::selectedList($app, $uid, $day);

	$userText = User::getUserText($app, $uid);


	$app->render("selectdishes.tpl",array(
		'uid' => $uid ,
		'userText' => $userText ,
		'selectedlist' => $selectedlist
		));
