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
	
		<section id="selecteddishes">
			<div class="title">
				<h3>{$day|date_format:"%m"}月{$day|date_format:"%e"}日({$day|date_format:"%a"})の献立</h3>
			</div>
			<div class="list">
				{if $selectdish}
					{foreach from=$selectdish item=dishData}
						<div>
							{if $dishData.tag == 1}
								<span class="category">主</span>
								{else}
								<span class="category">副</span>
							{/if}
							<span class="dishname" id="{$dishData.id}" title="{$dishData.dishname}">
								{$dishData.dishname}
							</span>
							<span class="delete">
								<a href="/easymenu/dishes/{$dishData.id}" class="btn btn-xs">メモ</a>
							</span>
						</div>
					{/foreach}
				{else}
					<h4>
						まだ選ばれていません。
					</h4>
				{/if}
			</div>
		</section>
		
		<section id="promotion">
			<img src="https://s3-ap-northeast-1.amazonaws.com/data.oceans-nadia.com/images/user_data/sponsor/banner_kadoya1_300x250.jpg">
		</section>
		
		<section id ="footerNavi">
			<a href="/easymenu/selectdishes/{$day}" class="btn btn-default">献立を決める</a>
			<a href="/easymenu/insertmydishes" class="btn btn-default">レパートリーの編集</a>
		</section>
		
		<section id="footer">
			<a href=https://twitter.com/masakiMatsumoto>@masakiMatsumoto</a>
		</section>
		
		<script type="text/javascript">
			$(function(){
				var str = "{$dishData.dishname}";
				if((str.length)>15) {
					$('#{$dishData.id}').css('font-size','14px');
				}
			});
		</script>
		
		
	</body>
</html>