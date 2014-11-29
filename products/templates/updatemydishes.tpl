<!DOCTYPE html>
<html lang-"ja">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
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
	
		<section id="otherdishes">
			<div class="title">
				<h3>料理の編集</h3>
			</div>
			
			<div id="navBotton" class="btn-group" role="group">
				<a href="" class="btn btn-default" disabled="disabled">料理の追加</a>
				<a href="/easymenu/deletemydishes" class="btn btn-default">料理の削除</a>
			</div>
			
			{foreach from=$otherlist item=dishinfo}
				<div class="list">
					<h4>
						<a href="/easymenu/updatemydishes/{$dishinfo.id}" class="btn btn-warning btn-xs">追加</a>
						{$dishinfo.dishname}
					</h4>
				</div>
			{/foreach}
		</sectison>

		<section id ="footerNavi">
			<a href="/easymenu/" class="btn btn-default glyphicon glyphicon-home"></a>
			<a href="/easymenu/makedish" class="btn btn-default">新しい料理を登録</a>
		</section>

		<section id="footer">
			<a href=https://twitter.com/masakiMatsumoto>@masakiMatsumoto</a>
		</section>

	</body>
</html>