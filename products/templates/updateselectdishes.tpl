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

		<section id="recdishlist">
			<div class="title">
				<h3>{$day|date_format:"%m"}月{$day|date_format:"%e"}日({$day|date_format:"%a"})のおすすめ</h3>
			</div>
			<form action="/easymenu/searchrecommenddishes" method="post" >
				<input class="form-control" name="keyword" placeholder="{if isset($keyword)}{$keyword}{else}検索{/if}" id="search">
				<input type="hidden" name="day" value="{$day}">
				<input type="hidden" name="cat" value="{$cat}">
			</form>
			{if is_array($reclist)}
				{foreach from=$reclist item=dishname key=recid}
					<div class="dishlist">
						<h4>
							<a href="/easymenu/updateselectdishes/{$day}/{$recid}" class="btn btn-warning make btn-xs">作る</a>
							{$dishname}
						</h4>
					</div>
				{/foreach}
			{else}
				<div class="noitem">
					<h4>
						選べるレパートリーがありません<br>
					</h4>
						<a href="/easymenu/insertmydishes" class="btn btn-default">レパートリーに料理を追加する</a>
				</div>
			{/if}
		</section>
		
		<section id ="footerNavi">
			<a href="/easymenu/" class="btn btn-default glyphicon glyphicon-home"></a>
			<a href="/easymenu/selectdishes" class="btn btn-default">献立を作る</a>
		</section>

		<section id="footer">
			<a href=https://twitter.com/masakiMatsumoto>@masakiMatsumoto</a>
		</section>

		<script type="text/javascript">
			$('#search').click(function(){
				$('#search').attr('placeholder','');
			});
		</script>

	</body>
</html>