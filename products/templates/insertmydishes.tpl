<!DOCTYPE html>
<html lang-"ja">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<meta name="language" content="ja">
		<!-- Loading Bootstrap -->
		<link rel="stylesheet" type="text/css" href="/easymenu/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="/easymenu/css/main.css">
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
	
		<section id="insertdishes">
			<div class="title">
				<h3>レパートリーの編集</h3>
			</div>
			
			<div id="navBotton" class="btn-group" role="group">
				<a href="" class="btn btn-default" disabled="disabled">料理の追加</a>
				<a href="/easymenu/deletemydishes" class="btn btn-default">料理の削除</a>
			</div>
			<form action="/easymenu/insertmydishes" method="post" id="insertForm">
				{foreach from=$otherlist item=dishinfo}
					<div class="checkbox">
						<label class="">
							<input type="checkbox" name ="{$dishinfo.id}" value="{$dishinfo.id}" id="ids">
							{$dishinfo.dishname}</label>
					</div>
				{/foreach}
				<button id="insertButton" class="btn btn-default" value="追加する" type="submit">追加</button>
			</form>
<ul>
<li class="">
<input id="ingredient_ids_" name="ingredient_ids[]" type="checkbox" value="22120315">
骨付きもも肉
<input id="recipe_id" name="recipe_id" type="hidden" value="1638999">
</li>
<li class="">
<input id="ingredient_ids_" name="ingredient_ids[]" type="checkbox" value="22120317">
しょうゆ
<input id="recipe_id" name="recipe_id" type="hidden" value="1638999">
</li>
</ul>




		</sectison>

		<section id ="footerNavi">
			<a href="/easymenu/" class="btn btn-default glyphicon glyphicon-home"></a>
			<a href="/easymenu/makedish" class="btn btn-default">新しい料理を登録</a>
		</section>

		{if ($message == "completion")}
		<section id="insertMessage">
			<div>登録完了！</div>
		</section>
		{/if}

		<section id="footer">
			<a href=https://twitter.com/masakiMatsumoto>@masakiMatsumoto</a>
		</section>

		<script type="text/javascript">
			$(function(){
				$("#insertButton").hide();
				
				$('label').click(function(){
					$('#insertButton').css('display','block');
				});
			});
		</script>
		
		<script type="text/javascript">
			$(function(){
				$("#insertMessage").fadeOut(2000);
			});
		</script>


		
	</body>
</html>