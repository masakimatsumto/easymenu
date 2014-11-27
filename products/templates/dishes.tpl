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

		<section id="dishdetail">
			<div class="title">
				<h3>{$dishName}</h3>
			</div>
			<div class="dishinfo">
				{if $dishUrl}
					<a href="{$dishUrl}" target="_blank">{$dishUrl}</a>
				{/if}
				<p>
					<h4>{$dishMemo}</h4>
				</p>
			</div>

			<form action="/easymenu/updatedishes" method="post">
				<input type="hidden" name="id" value="{$dishid}">
				<h4>レシピ</h4>
				<textarea class="form-control" rows="1" name="url" placeholder="クックパッドのURLとか">{$dishUrl}</textarea>
				<h4>メモ</h4>
				<textarea class="form-control" rows="3" name="text">{$dishMemo}</textarea>
				<button type="submit" class="btn btn-default">保存</button>
			</form>
		</section>

		<section id="footerNavi">
			<a href="/easymenu/" class="btn btn-default">HOME</a>
		</section>

		<section id="footer">
			<a href=https://twitter.com/masakiMatsumoto>@masakiMatsumoto</a>
		</section>
		
	</body>
</html>