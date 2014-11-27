<?php
	
	require("/home/masao-masao/products/easymenu/config.php");
	
	$facebook = new Facebook(array(
	  'appId'  => $fbappid,
	  'secret' => $fbsecret,
	));

	// Get User ID
	$user = $facebook->getUser();

	if($user){
		$stmt = $app->db->prepare('SELECT id FROM users WHERE user_id = :userId');
		$stmt ->execute(array(':userId' => $user));
		$item = $stmt->fetch(PDO::FETCH_ASSOC);

		if(isset($item['id'])){
			$_SESSION['login_user_id'] = $item['id'];
			header("location: /easymenu/");
			exit();
		} else {
			$stmt = $app->db->prepare('INSERT INTO users (user_id) VALUES (:user)');
			$stmt ->execute(array(':user' => $user));

			$stmt = $app->db->prepare('SELECT id FROM users WHERE user_id = :userId');
			$stmt ->execute(array(':userId' => $user));
			$item = $stmt->fetch(PDO::FETCH_ASSOC);
			
			$_SESSION['login_user_id'] = $item['id'];
			header("location: /easymenu/");
			exit();
		}

	} else {
		//ログインURLを生成
		$loginUrl = $facebook->getLoginUrl();
	}

	$app->render("login.tpl", array("loginUrl" => $loginUrl));