<?php

	$uid = $_SESSION['login_user_id'];
	
	
	// 新しい料理を作成
	if(isset($_POST['dishName'])){
		$dishName = $_POST['dishName'];
		$tag1 = $_POST['tag1'];
		$makedish = Dish::makeDish($app, $uid, $dishName, $tag1);
		$goRec = Recommend::updateRecommenddishes($app, $uid);
	}

	$app->render("makedish.tpl", array(
		"uid" => $uid,
		));