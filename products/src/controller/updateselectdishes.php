<?php

	$uid = $_SESSION['login_user_id'];
	$day = $id1;
	$dishId = $id2;

	if($id2 == "main" or $id2 == "sub"){
		$cat = $id2;
		if($id2 == "main"){
			$catId = 1;
		}else{
			$catId = 2;
		}
		$reclist = Recommend::makeRecList($app, $uid);
	}else{

		// select のデータを更新
		$selectdishes = Dish::updateSelecteddishes($app, $uid, $day, $dishId);

		// useddishes のにデータを更新
		$useddishes = Dish::updateUseddishes($app, $uid, $dishId);
		
		$_SESSION['message'] = $day."_".$dishId;
		$_SESSION['dishId'] = $dishId;
		
		header("location: /easymenu/selectdishes#$day");
		exit();
	}

	
	$app->render("updateselectdishes.tpl",array(
		'uid' => $uid ,
		'catId' => $catId,
		'cat' => $cat ,
		'day' => $day ,
		'reclist' => $reclist
		));
