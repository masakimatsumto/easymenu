<?php

	$uid = $_SESSION['login_user_id'];
	$dishId = $id1;

	// 自分の作れる料理から削除
	$mydishes = User::deleteMydishList($app, $uid, $dishId);

	if($dishId){
		$recdishes = Recommend::updateRecommenddishes($app, $uid);
		header("location: /easymenu/deletemydishes");
		exit();
	}

	$app->render("deletemydishes.tpl", array(
		"uid" => $uid, 
		"mydishes" =>$mydishes
		));
