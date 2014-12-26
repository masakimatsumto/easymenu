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
		$reclist = Recommend::getRecdish($app, $uid, $dishId);
		if(empty($reclist)){
			$reclist = Recommend::makeRecList($app, $uid);
		}
		foreach($reclist as $cat => $dishes){
			$reclist[$cat] = array_slice($dishes,0,1, true);
		}
	}else{
		// おすすめを取得
		$reclist = Recommend::makeRecList($app, $uid);
		if(!empty($reclist)){
			foreach($reclist as $cat => $dishes){
				$reclist[$cat] = array_slice($dishes,0,1, true);
			}
		}
	}


	// 選択されているレシピの取得
	$selectedlist = User::selectedList($app, $uid, $day);

	$userText = User::getUserText($app, $uid);


	
	$app->render("selectdishes.tpl",array(
		'uid' => $uid ,
		'userText' => $userText ,
		'selectedlist' => $selectedlist,
		'message' => $message,
		'reclist' => $reclist
		));
