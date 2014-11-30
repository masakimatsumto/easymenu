<?php

	$uid = $_SESSION['login_user_id'];
	$dishId = $_POST;

	// 自分の作れる献立に料理を追加
	$otherlist = User::insertMydishList($app, $uid, $dishId);

	if($dishId){
		$recdishes = Recommend::updateRecommenddishes($app, $uid);
		header("location: /easymenu/insertmydishes");
		exit();
	}

	$app->render("insertmydishes.tpl", array(
		"uid" => $uid, 
		"otherlist" =>$otherlist
		));
