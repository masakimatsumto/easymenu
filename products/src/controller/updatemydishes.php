<?php

	$uid = $_SESSION['login_user_id'];
	$dishId = $id1;

	// 自分の作れる献立に料理を追加
	$otherlist = User::updateMydishList($app, $uid, $dishId);

	if($dishId){
		$recdishes = Recommend::updateRecommenddishes($app, $uid);
		header("location: /easymenu/updatemydishes");
		exit();
	}

	$app->render("updatemydishes.tpl", array(
		"uid" => $uid, 
		"otherlist" =>$otherlist
		));
