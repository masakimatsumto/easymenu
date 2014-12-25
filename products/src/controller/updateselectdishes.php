<?php

	$uid = $_SESSION['login_user_id'];
	$day = $id1;
	$dishId = $id2;

	if($id2 == "main" or $id2 == "sub"){
		// レコメンドを取得
		$cat = $id2;
		$reclist = Recommend::getRecList($app, $uid, $cat);

	}else{

		// select のデータを更新
		$selectdishes = Dish::updateSelecteddishes($app, $uid, $day, $dishId);

		// useddishes のにデータを更新
		$useddishes = Dish::updateUseddishes($app, $uid, $dishId);
		
		// レコメンドを更新
		$recdishes = Recommend::updateRecommenddishes($app, $uid);
		
		$_SESSION['message'] = $day."_".$dishId;
		
		header("location: /easymenu/selectdishes#$day");
		exit();
	}

	
	$app->render("updateselectdishes.tpl",array(
		'uid' => $uid ,
		'cat' => $cat ,
		'day' => $day ,
		'reclist' => $reclist
		));
