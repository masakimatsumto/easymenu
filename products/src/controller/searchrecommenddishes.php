<?php

	$uid = $_SESSION['login_user_id'];
	$cat = $_POST['cat'];
	$day = $_POST['day'];
	$keyword = $_POST['keyword'];


	// select のデータを更新
	if (!empty($keyword)){
		$searchResult = Dish::searchRecommenddishes($app, $uid, $cat, $keyword);
	}else{
		header("location: /easymenu/updateselectdishes/".$day."/".$cat);
		exit();
	}

	$app->render("updateselectdishes.tpl",array(
		'uid' => $uid ,
		'cat' => $cat ,
		'day' => $day ,
		'keyword' => $keyword ,
		'reclist' => $searchResult
		));
