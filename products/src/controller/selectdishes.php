<?php

	$day = date("Y-m-d");
	$uid = $_SESSION['login_user_id'];
	
	$reclist = Recommend::getRecommendeddishes($app, $uid);
	
	// 選択されているレシピの取得
	$selectedlist = User::selectedList($app, $uid, $day);

	$userText = User::getUserText($app, $uid);

	// メッセージを取得
	if(!empty($_SESSION['message'])){
		$message = $_SESSION['message'];
		unset($_SESSION['message']);
	}else{
		$message = "";
	}
	
	$app->render("selectdishes.tpl",array(
		'uid' => $uid ,
		'userText' => $userText ,
		'selectedlist' => $selectedlist,
		'message' => $message,
		'reclist' => $reclist
		));
