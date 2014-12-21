<?php

	$uid = $_SESSION['login_user_id'];

	// 買物メモの情報を取得
	$userText = User::getUserText($app, $uid);
	

	$app->render("usertext.tpl", array(
		'userText' => $userText
		));