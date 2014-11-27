<?php
	$uid = $_SESSION['login_user_id'];
	$text = $_POST['text'];

	// 料理情報の更新
	$userText = User::updateUserText($app, $uid, $text);
	
	header("location: /easymenu/selectdishes");
	exit;