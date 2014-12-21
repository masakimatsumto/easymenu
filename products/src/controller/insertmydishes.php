<?php

	$uid = $_SESSION['login_user_id'];
	$dishId = $_POST;

	// 自分の作れる献立に料理を追加
	$otherlist = User::insertMydishList($app, $uid, $dishId);

	// メッセージを取得
	if(!empty($_SESSION['message'])){
		$message = $_SESSION['message'];
		unset($_SESSION['message']);
	}else{
		$message = "";
	}

	if($dishId){
		$recdishes = Recommend::updateRecommenddishes($app, $uid);
		
		$_SESSION['message'] = "completion";
		header("location: /easymenu/insertmydishes");
		exit();
	}

	$app->render("insertmydishes.tpl", array(
		"uid" => $uid, 
		"otherlist" =>$otherlist,
		"message" => $message
		));
