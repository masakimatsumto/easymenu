<?php

class Recommend{
	
	// レコメンドリストの作成
	static public function makeRecList($app, $uid, $cat){

		if($cat == "main"){
			$b = 1;
		}else{
			$b = 2;
		}

		$stmt = $app->db->prepare('SELECT mydishes FROM users WHERE id = :userId');
		$stmt ->execute(array(':userId' => $uid));
		$item = $stmt->fetch(PDO::FETCH_ASSOC);
		$mydishlist = json_decode($item['mydishes'], true);
		
		if(!isset($mydishlist)) return;

		shuffle($mydishlist);
		
		$reclist = array();

		foreach ($mydishlist as $value) {
			$dishData = Dish::getDishData($app, $value);
			$reclist[$dishData['tag']][$dishData['id']] = $dishData['dishname'];
		}

		if(empty($reclist[$b])) return;

		return $reclist[$b];
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

	
	// 決定した料理を元にレコメンドを作成＆抽出
	static public function getRecdish($app, $uid, $dishId){
		$dishId = "%\"".$dishId."\"%";

		$stmt = $app->db->prepare('SELECT date FROM selecteddishes WHERE user_id = :userId AND  dishids LIKE :dishId');
		$stmt ->execute(array(':userId' => $uid, ':dishId' => $dishId));
		while($item = $stmt->fetch(PDO::FETCH_ASSOC)){
			$date[] = $item['date'];
		}

		$recdish = array();
		foreach ($date as $day) {
			$day = date("Y-m-d", strtotime("$day +1 day"));

			$stmt = $app->db->prepare('SELECT dishids FROM selecteddishes WHERE user_id = :userId AND date = :date');
			$stmt ->execute(array(':userId' => $uid, ':date' => $day));
			$item = $stmt->fetch(PDO::FETCH_ASSOC);		

			if($item){
				$item = json_decode($item['dishids'], true);
				foreach ($item as $value) {
					$dishData = Dish::getDishData($app, $value);
					$recdish[$dishData['tag']][$dishData['id']] = $dishData['dishname'];
				}
			}else{
				break;
			}
		}
		return $recdish;

	}


}