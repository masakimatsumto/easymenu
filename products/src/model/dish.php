<?php

class Dish{
	
	// useddishes のデータを更新
	static public function updateUseddishes($app, $uid, $dishId){
		
		$stmt = $app->db->prepare('SELECT useddishes FROM users WHERE id = :userId');
		$stmt ->execute(array(':userId' => $uid));
		$item = $stmt->fetch(PDO::FETCH_ASSOC);
		
		if(!empty($item['useddishes'])){
			$arr = json_decode($item['useddishes'], true);
		}
		$arr[] = $dishId;
		$q = json_encode($arr);
		
		$stmt = $app->db->prepare('UPDATE users SET useddishes = :q WHERE id = :userId');
		$stmt ->execute(array(':q' => $q, ':userId' => $uid));
	}
	
	
	// selecteddishes のテーブルのデータを更新
	static public function updateSelecteddishes($app, $uid, $day, $dishId){
		
		$stmt = $app->db->prepare('SELECT dishids FROM selecteddishes WHERE user_id = :userId AND date = :day');
		$stmt ->execute(array(':userId' => $uid, ':day' => $day));
		$item = $stmt->fetch(PDO::FETCH_ASSOC);
		$arr = json_decode($item['dishids'], true);

		if(empty($arr)){
			$arr[] = $dishId;
			$q = json_encode($arr);
			
			$stmt = $app->db->prepare('INSERT INTO selecteddishes (user_id,date,dishids) VALUES (:userId, :day, :q)');
			$stmt ->execute(array(':userId' => $uid, ':day' => $day, ':q' => $q));
			
		}else{
			$arr[] = $dishId;
			$q = json_encode($arr);
			
			$stmt = $app->db->prepare('UPDATE selecteddishes SET dishids = :q WHERE user_id = :userId AND date = :day');
			$stmt ->execute(array(':userId' => $uid, ':day' => $day, ':q' => $q));
		}
	}
	
	
	// 料理のメモ情報を取得
	static public function getDishinfo($app, $uid, $dishId){

		$dishData = Dish::getDishData($app, $dishId);
		$dishName = $dishData['dishname'];

		$stmt = $app->db->prepare('SELECT memo,URL FROM memos WHERE dish_id = :dish_id AND user_id = :userId');
		$stmt ->execute(array(':userId' => $uid, ':dish_id' => $dishId));
		$item = $stmt->fetch(PDO::FETCH_ASSOC);

		$dishMemo = $item["memo"];
		$dishUrl = $item["URL"];		

		$dishinfo[] = $dishName;
		$dishinfo[] = $dishMemo;
		$dishinfo[] = $dishUrl;
		
		return $dishinfo;
	}
	

	// 料理のメモ情報を更新
	static public function updateDishInfo($app, $uid, $comment, $dishId, $url){

		$stmt = $app->db->prepare('SELECT id FROM memos WHERE dish_id = :dish_id AND user_id = :userId');
		$stmt ->execute(array(':userId' => $uid, ':dish_id' => $dishId));
		$item = $stmt->fetch(PDO::FETCH_ASSOC);
		$q = $item['id'];

		if($q){
			$stmt = $app->db->prepare('UPDATE memos SET memo = :comment , URL = :url WHERE dish_id = :dishId AND user_id = :userId');
			$stmt ->execute(array(':userId' => $uid, ':comment' => $comment, ':url' => $url, ':dishId' => $dishId));
		}else{
			$stmt = $app->db->prepare('INSERT INTO memos(user_id,dish_id,memo,URL) VALUES (:userId, :dishId, :comment, :url)');
			$stmt ->execute(array(':userId' => $uid, ':comment' => $comment, ':url' => $url, ':dishId' => $dishId));
		}
		
		return ;
	}


	// 新しい料理名を登録し、ユーザーのレパートリーにも登録
	static public function makeDish($app, $uid, $dishName, $tag1){

		$stmt = $app->db->prepare('INSERT INTO dishes (name, tag1) VALUES (:name, :tag1)');
		$stmt ->execute(array(':name' => $dishName, ':tag1' => $tag1));

		$stmt = $app->db->prepare('SELECT id FROM dishes WHERE name = :name');
		$stmt ->execute(array(':name' => $dishName));
		$item = $stmt->fetch(PDO::FETCH_ASSOC);
		$dishId = $item['id'];

		$stmt = $app->db->prepare('SELECT mydishes FROM users WHERE id = :userId');
		$stmt ->execute(array(':userId' => $uid));
		$item = $stmt->fetch(PDO::FETCH_ASSOC);
		$mydishlist = json_decode($item['mydishes'], true);

		$mydishlist[] = $dishId;

		$a = json_encode($mydishlist);

		$stmt = $app->db->prepare('UPDATE users SET mydishes = :a WHERE id = :userId');
		$stmt ->execute(array(':userId' => $uid, ':a' => $a));
		
		return $dishId;
	}
	
	
	// 料理情報（name, tag1）を取得
	static public function getDishData($app, $dishId){
		
		$stmt = $app->db->prepare('SELECT name , tag1 FROM dishes WHERE id = :dishId');
		$stmt ->execute(array(':dishId' => $dishId));
		$item = $stmt->fetch(PDO::FETCH_ASSOC);
		$dishData = array('id' => $dishId, 'dishname' => $item['name'], 'tag' => $item['tag1']);
		
		return $dishData;
	}
	
	
	// useddishes から、前日分までのデータを削除
	static public function deletePastUsedDishes($app, $uid, $day){
		
		$stmt = $app->db->prepare('SELECT dishids FROM selecteddishes WHERE user_id = :userId AND date < :day');
		$stmt ->execute(array(':userId' => $uid, ':day' => $day));
		$item = $stmt->fetch(PDO::FETCH_ASSOC);
		
		if(empty($item['dishids'])) return;
		
		$stmt = $app->db->prepare('SELECT dishids FROM selecteddishes WHERE user_id = :userId AND date < :day');
		$stmt ->execute(array(':userId' => $uid, ':day' => $day));
		
		while($item = $stmt->fetch(PDO::FETCH_ASSOC)){
			$a = json_decode($item['dishids'], true);
			foreach ($a as $value) {
				$deleteDishIds[] = intval($value);
			}
		}
		
		$stmt = $app->db->prepare('SELECT useddishes FROM users WHERE id = :userId');
		$stmt ->execute(array(':userId' => $uid));
		$item = $stmt->fetch(PDO::FETCH_ASSOC);
		$usedDishIds = json_decode($item['useddishes'], true);
		
		if(isset($deleteDishIds) && isset($usedDishIds)){
			foreach($deleteDishIds as $deleteId){
				$d = array_search($deleteId, $usedDishIds);
				unset($usedDishIds[$d]);
			}

			$q = json_encode($usedDishIds);
			
			$stmt = $app->db->prepare('UPDATE users SET useddishes = :q WHERE id = :userId');
			$stmt ->execute(array(':q' => $q, ':userId' => $uid));
			
		}
	}
	
	
	// selecteddishes のテーブルのデータを削除
	static public function deleteSelecteddishes($app, $uid, $day, $dishId){
		$stmt = $app->db->prepare('SELECT dishids FROM selecteddishes WHERE user_id = :userId AND date = :day');
		$stmt ->execute(array(':userId' => $uid, ':day' => $day));
		$item = $stmt->fetch(PDO::FETCH_ASSOC);
		$arr = json_decode($item['dishids'], true);
		
		$d = array_search($dishId, $arr);
		unset($arr[$d]);
				
		if (empty($arr)){
			$stmt = $app->db->prepare('DELETE FROM selecteddishes WHERE user_id = :userId AND date = :day');
			$stmt ->execute(array(':userId' => $uid, ':day' => $day));
		}
		
		$q = json_encode($arr);
		
		$stmt = $app->db->prepare('UPDATE selecteddishes SET dishids = :q WHERE user_id = :userId AND date = :day');
		$stmt ->execute(array(':userId' => $uid, ':day' => $day, ':q' => $q));
	}
	

	// 献立検索の結果を取得
	static public function searchRecommenddishes($app, $uid, $cat, $keyword){
		$searchResult = array();
		
		if($cat == "main"){
			$cat = 1;
		}else{
			$cat = 2;
		}
		
		$reclist = Recommend::makeRecList($app, $uid);
		if(isset($reclist)){
			foreach ($reclist[$cat] as $dishId => $dishName) {
				if(mb_strpos($dishName, $keyword)!==FALSE){
					$searchResult[$cat][$dishId] = $dishName;
				}
			}
		}
		
		return $searchResult;

	}

}