<?php
	$uid = $_SESSION['login_user_id'];


	if(!isset($_POST['text']) || $_POST['text']===''){
		$text = "";
	} else {
		$text = $_POST['text'];
	}

	// 料理情報の更新
	$userText = User::updateUserText($app, $uid, $text);
	
	header("location: /easymenu/selectdishes");
	exit;