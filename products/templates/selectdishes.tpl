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

		<section id="weeklydisheslist">
				{foreach from=$selectedlist item=dishes key=day}
					<h3>{$day|date_format:"%m"}月{$day|date_format:"%e"}日({$day|date_format:"%a"})</h3>
					{if ! empty($dishes)}
						{foreach from=$dishes item=dish}
							<p>
								{if $dish.tag == '1'}
									<span>主</span>
									{else}
									<span>副</span>
								{/if}
								{$dish.dishname}
								<a href="/easymenu/deleteselectdishes/{$day}/{$dish.id}" class="btn btn-xs glyphicon glyphicon-remove"></a>
							</p>
						{/foreach}
					<p>
						<span>主</span> <a href="/easymenu/updateselectdishes/{$day}/main" class="btn btn-warning btn-xs">追加する</a>
					</p>
					<p>
						<span>副</span> <a href="/easymenu/updateselectdishes/{$day}/sub" class="btn btn-warning btn-xs">追加する</a>
					</p>
					{else}
					<p>
						<span>主</span> <a href="/easymenu/updateselectdishes/{$day}/main" class="btn btn-warning btn-xs">決める</a>
					</p>
					<p>
						<span>副</span> <a href="/easymenu/updateselectdishes/{$day}/sub" class="btn btn-warning btn-xs">決める</a>
					</p>
					{/if}
				{/foreach}
		</section>

		<section id="userText">
			<h3>買い物メモ</h3>
			{if $userText}
			<div>
				{$userText|nl2br}
			</div>
			{/if}
			<form action="/easymenu/updateusertext" method="post">
				<textarea class="form-control" rows="6" name="text">{$userText}</textarea>
			<button type="submit" class="btn btn-default">保存</button>
			</form>
		</section>
		
		<section id ="footerNavi">
			<a href="/easymenu/" class="btn btn-default">HOME</a>
			<a href="/easymenu/updatemydishes" class="btn btn-default">レパートリーの追加 / 削除</a>
		</section>
		
		<section id="footer">
			<a href=https://twitter.com/masakiMatsumoto>@masakiMatsumoto</a>
		</section>
		
	</body>
</html>