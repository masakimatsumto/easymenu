<?php

	$uid = $_SESSION['login_user_id'];
	$day = $id1;
	
	// 新しい料理を作成
	if(!isset($_POST['dishName']) || $_POST['dishName']===''){
		$dishName = "";
	}else{
		$dishName = $_POST['dishName'];
		$tag1 = $_POST['tag1'];
		$dishId = Dish::makeDish($app, $uid, $dishName, $tag1);
		$goRec = Recommend::updateRecommenddishes($app, $uid);
		
		// 日付を持っていたら献立に追加
		if(isset($_POST['day'])){
			$day = $_POST['day'];
			
			// select のデータを更新
			$selectdishes = Dish::updateSelecteddishes($app, $uid, $day, $dishId);

			// useddishes のにデータを更新
			$useddishes = Dish::updateUseddishes($app, $uid, $dishId);
			
			// レコメンドを更新
			$recdishes = Recommend::updateRecommenddishes($app, $uid);
			
			// メッセージをセット
			$_SESSION['message'] = $dishId;
			
			header("location: /easymenu/selectdishes#$day");
			exit();
		}
		
	}

	$app->render("makedish.tpl", array(
		"uid" => $uid,
		"day" => $day,
		"dishName" => $dishName
		));