<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="language" content="ja">
		<!-- Loading Bootstrap -->
        <link rel="stylesheet" type="text/css" href="/easymenu/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="/easymenu/css/main.css">
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	    <!--[if lt IE 9]>
	    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	    <![endif]-->
	</head>
	<body>
		<section id="makedish">
			<div class="title">
				<h3>新しい料理を登録</h3>
			</div>
			<form action="/easymenu/makedish" method="post">
				<h4>料理名</h4>
				<textarea class="form-control" rows="1" name="dishName"></textarea>
				<h4>カテゴリ</h4>
				<input type="radio" name="tag1" value="1" checked> <span>主菜</span>
				<input type="radio" name="tag1" value="2"> <span>副菜</span>
				{if isset($day)}
				<br>
				<input type="checkbox" name="day" value="{$day}" checked>{$day}の献立にも追加
				{/if}
				<button type="submit" class="btn btn-default">登録</button>
			</form>
			<p>
				新しく登録した料理は、レパートリーに自動で追加されるので、
				献立で選べるようになっています。
			</p>
		</section>

		<section id ="footerNavi">
			<a href="/easymenu/" class="btn btn-default glyphicon glyphicon-home"></a>
			<a href="/easymenu/selectdishes" class="btn btn-default">献立を作る</a>
		</section>
		{if !empty($dishName)}
		<section id ="message">
			{$dishName}を</br>
			レパートリーに追加しました
		</section>
		{/if}

		<section id="footer">
			<a href=https://twitter.com/masakiMatsumoto>@masakiMatsumoto</a>
		</section>

	</body>
</html>