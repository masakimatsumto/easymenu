<?php

class User{
	
	// 決まった献立を1週間分取得
	static public function selectedList($app, $uid, $day){
		
		$stmt = $app->db->prepare('SELECT date , dishids FROM selecteddishes WHERE user_id = :userId AND date >= :day ORDER BY date ASC');
		$stmt ->execute(array(':userId' => $uid, ':day' => $day));
		while($item = $stmt->fetch(PDO::FETCH_ASSOC)){
			$arr[$item['date']] = json_decode($item['dishids'], true);
		}
		
		for ($i = 0; $i < 7; $i++) {
			$day = date("Y-m-d" ,strtotime("+" . $i ." day"));
			$selectedlist[$day] = array();
		}
		
		if (isset($arr)){
			foreach($arr as $key => $dishids){
				foreach($dishids as $dishId){
					$dishData = Dish::getDishData($app, $dishId);
					$selectedlist[$key][] = $dishData;
				}
			}
		}

		return $selectedlist;
	
	}
	
	
	// 本日の献立を取得
	static public function selectedDayList($app, $uid, $day){
		
		$stmt = $app->db->prepare('SELECT dishids FROM selecteddishes WHERE user_id = :userId AND date = :day');
		$stmt ->execute(array(':userId' => $uid, ':day' => $day));
		$item = $stmt->fetch(PDO::FETCH_ASSOC);

		$selectdish = array();

		$arr = json_decode($item['dishids'], true);
		if ($arr) {
			foreach($arr as $dishId){
				$dishData = Dish::getDishData($app, $dishId);
				$selectdish[] = $dishData;
			}
		}
		
		return $selectdish;
	}


	// User Text を更新
	static public function updateUserText($app, $uid, $text){
		
		$stmt = $app->db->prepare('UPDATE users SET text = :text WHERE id = :userId');
		$stmt ->execute(array(':text' => $text, ':userId' => $uid));

		return ;
	
	}


	// User Text を取得
	static public function getUserText($app, $uid){

		$stmt = $app->db->prepare('SELECT text FROM users WHERE id = :userId');
		$stmt ->execute(array(':userId' => $uid));
		$item = $stmt->fetch(PDO::FETCH_ASSOC);
		$userText = $item['text'];

		return $userText;
	}

	// 自分の作れる料理から削除
	static public function deleteMydishList($app, $uid, $dishId){
		
		$stmt = $app->db->prepare('SELECT mydishes FROM users WHERE id = :userId');
		$stmt ->execute(array(':userId' => $uid));
		$item = $stmt->fetch(PDO::FETCH_ASSOC);
		$mydishlist = json_decode($item['mydishes'], true);

		if(isset($mydishlist)){
				$d = array_search($dishId, $mydishlist);
			unset($mydishlist[$d]);
		}		

		$a = json_encode($mydishlist);
		
		$stmt = $app->db->prepare('UPDATE users SET mydishes = :a WHERE id = :userId');
		$stmt ->execute(array(':a' => $a, ':userId' => $uid));

		$mydishes = array();

		foreach($mydishlist as $dishIds){
			$dishData = Dish::getDishData($app, $dishIds);
			$mydishes[] = $dishData;
		}
	
		return $mydishes;
	}


	// 過去の献立を取得
	static public function pastSelectedList($app, $uid){
		
		$stmt = $app->db->prepare('SELECT date , dishids FROM selecteddishes WHERE user_id = :userId  ORDER BY date ASC');
		$stmt ->execute(array(':userId' => $uid));
		while($item = $stmt->fetch(PDO::FETCH_ASSOC)){
			$arr[$item['date']] = json_decode($item['dishids'], true);
		}
		
		
		if (isset($arr)){
			foreach($arr as $key => $dishids){
				foreach($dishids as $dishId){
					$dishData = Dish::getDishData($app, $dishId);
					$pastselectedlist[$key][] = $dishData;
				}
			}
		}

		return $pastselectedlist;
	
	}


	// 自分の作れる献立に料理を追加
	static public function insertMydishList($app, $uid, $dishId){
		
		$stmt = $app->db->prepare('SELECT mydishes FROM users WHERE id = :userId');
		$stmt ->execute(array(':userId' => $uid));
		$item = $stmt->fetch(PDO::FETCH_ASSOC);
		$mydishlist = json_decode($item['mydishes'], true);
		
		if($dishId){
			foreach ($dishId as $value) {
				$mydishlist[] = $value;
			}

			$a = json_encode($mydishlist);
			$stmt = $app->db->prepare('UPDATE users SET mydishes = :a WHERE id = :userId');
			$stmt ->execute(array(':a' => $a, ':userId' => $uid));
			
			return;

		}
			// 未登録の料理をすべて出す
			
			$stmt = $app->db->prepare('SELECT id FROM dishes');
			$stmt ->execute();
			while($item = $stmt->fetch(PDO::FETCH_ASSOC)){
				$alldishlist[] = $item["id"];
			}

			if(isset($mydishlist)){
				foreach($mydishlist as $dellist){
					$d = array_search($dellist, $alldishlist);
				unset($alldishlist[$d]);
				}
			}

			$otherlist = array();

			foreach($alldishlist as $dishIds){
				$dishData = Dish::getDishData($app, $dishIds);
				$otherlist[] = $dishData;
			}

		return $otherlist;
	}


}
