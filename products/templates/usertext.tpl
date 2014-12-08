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

		<section id="userTextAll">
				<h3>買物メモ</h3>
				<form action="/easymenu/updateusertext" method="post">
					<textarea class="form-control" rows="15" name="text">{$userText}</textarea>
					<button type="submit" class="btn btn-default">保存</button>
					<a href="/easymenu/updateusertext" class="btn btn-default">消す</a>
				</form>
			</div>
		</section>

		<section id="footerNavi">
			<a href="/easymenu/" class="btn btn-default glyphicon glyphicon-home"></a>
			<a href="/easymenu/selectdishes" class="btn btn-default">献立を作る</a>
		</section>

		<section id="footer">
			<a href=https://twitter.com/masakiMatsumoto>@masakiMatsumoto</a>
		</section>
		
	</body>
</html>