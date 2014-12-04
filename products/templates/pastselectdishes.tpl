<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
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

		<section id="pastdisheslist">
				{foreach from=$pastselectedlist item=dishes key=day}
					<h3>{$day|date_format:"%m"}月{$day|date_format:"%e"}日({$day|date_format:"%a"})</h3>
						{foreach from=$dishes item=dish}
							<p>
								{if $dish.tag == '1'}
									<span>主</span>
									{else}
									<span>副</span>
								{/if}
								{$dish.dishname}
							</p>
						{/foreach}
				{/foreach}
		</section>
		
		<section id ="footerNavi">
			<a href="/easymenu/" class="btn btn-default glyphicon glyphicon-home"></a>
			<a href="/easymenu/insertmydishes" class="btn btn-default">レパートリー編集</a>
		</section>
		
		<section id="footer">
			<a href=https://twitter.com/masakiMatsumoto>@masakiMatsumoto</a>
		</section>

	</body>
</html>