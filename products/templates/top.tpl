<!DOCTYPE html>
<html>
	<head>
		<title>かんたん献立</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<meta name="language" content="ja">
		<!-- Loading Bootstrap -->
		<link rel="stylesheet" type="text/css" href="/easymenu/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="/easymenu/css/main.css">
		<link rel="apple-touch-icon-precomposed" href="/easymenu/img/icon.png">
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
				{if isset($selectdish)}
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
							<span class="memo">
								<a href="/easymenu/dishes/{$dishData.id}" class="btn btn-xs">メモ</a>
							</span>
						</div>
					{/foreach}
					<div>
						<span class="category">主</span>
						<a href="/easymenu/updateselectdishes/{$day}/main" class="btn btn-warning btn-xs">
							レパートリーから追加する
						</a>
					</div>
					<div>
						<span class="category">副</span>
						<a href="/easymenu/updateselectdishes/{$day}/sub" class="btn btn-warning btn-xs">
							レパートリーから追加する
						</a>
					</div>
				{else}
					<h4>
						まだ選ばれていません。
					</h4>
				{/if}
			</div>
		</section>
		
		<section id="promotion">
		</section>
		
		<section id ="footerNavi">
			<a href="/easymenu/selectdishes/{$day}" class="btn btn-default">献立一覧</a>
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