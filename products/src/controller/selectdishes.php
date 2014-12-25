<?php

	$day = date("Y-m-d");
	$uid = $_SESSION['login_user_id'];

	// メッセージを取得
	if(!empty($_SESSION['message'])){
		$message = $_SESSION['message'];
		$dishId = $_SESSION['dishId'];
		unset($_SESSION['message'], $_SESSION['dishId']);
	}else{
		$message = "";
		$dishId = "";
	}

	if(!empty($dishId)){
		$recdish = Recommend::getRecdish($app, $uid, $dishId);
	}else{
		$recdish = "";
	}

	$reclist = Recommend::getRecommendeddishes($app, $uid);

	// 選択されているレシピの取得
	$selectedlist = User::selectedList($app, $uid, $day);

	$userText = User::getUserText($app, $uid);


	
	$app->render("selectdishes.tpl",array(
		'uid' => $uid ,
		'userText' => $userText ,
		'selectedlist' => $selectedlist,
		'message' => $message,
		'reclist' => $reclist,
		'recdish' => $recdish
		));
