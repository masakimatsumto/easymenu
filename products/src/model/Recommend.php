<?php

class Recommend{
	
	// レコメンドのリストを取得
	static public function getRecList($app, $uid, $cat){

		if($cat == "main"){
			$b = 1;
		}else{
			$b = 2;
		}

		$stmt = $app->db->prepare('SELECT recommendeddishes FROM users WHERE id = :userId');
		$stmt ->execute(array(':userId' => $uid));
		$item = $stmt->fetch(PDO::FETCH_ASSOC);
		$recDisheslist = json_decode($item["recommendeddishes"], true);

		if(empty($recDisheslist[$b])) return;

		$reclist = array();

		foreach($recDisheslist[$b] as $dishId){
			$dishData = Dish::getDishData($app, $dishId);
			$reclist[$dishId] = $dishData['dishname'];
		}
		
		return $reclist;
	}
	
	
	// useddishes と mydishes を比較してrecommend を更新
	static public function updateRecommenddishes($app, $uid){
		
		//$stmt = $app->db->prepare('SELECT useddishes FROM users WHERE id = :userId');
		//$stmt ->execute(array(':userId' => $uid));
		//$item = $stmt->fetch(PDO::FETCH_ASSOC);
		//$useddishlist = json_decode($item['useddishes'], true);
		
		$stmt = $app->db->prepare('SELECT mydishes FROM users WHERE id = :userId');
		$stmt ->execute(array(':userId' => $uid));
		$item = $stmt->fetch(PDO::FETCH_ASSOC);
		$mydishlist = json_decode($item['mydishes'], true);
		
		if(!isset($mydishlist)) return;
		
		shuffle($mydishlist);
		
		$reclist = array();
		
		foreach($mydishlist as $dishId){
			
			$stmt = $app->db->prepare('SELECT tag1 FROM dishes WHERE id = :dishId');
			$stmt ->execute(array(':dishId' => $dishId));
			$item = $stmt->fetch(PDO::FETCH_ASSOC);
			$reclist[$item['tag1']][] = $dishId;
			
		}
		$a = json_encode($reclist);
		
		$stmt = $app->db->prepare('UPDATE users SET recommendeddishes = :a WHERE id = :userId');
		$stmt ->execute(array(':a' => $a, ':userId' => $uid));
		
	}
	
	
	// レコメンドの料理を返す
	static public function getRecommendeddishes($app, $uid){

		$stmt = $app->db->prepare('SELECT recommendeddishes FROM users WHERE id = :userId');
		$stmt ->execute(array(':userId' => $uid));
		$item = $stmt->fetch(PDO::FETCH_ASSOC);
		$recDisheslist = json_decode($item["recommendeddishes"], true);

		if(empty($recDisheslist)) return;

		$reclist = array();
		foreach($recDisheslist as $cat => $dishes){
			$dishData = Dish::getDishData($app, $dishes[0]);
			$reclist[$cat][$dishData['id']] = $dishData['dishname'];
		}
		
		return $reclist;
	}
}