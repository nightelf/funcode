<!doctype html>  
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
	<div id="header" class="navbar">
		<div class="innernav">
			<div class="nav-left">
				<h1><?php echo $companyName; ?></h1>
			</div>
			<div class="nav-right">
				<div class="search-group">
					<input id="search" class="search" type="text" placeholder="Search..." />
				</div>
			</div>
		</div>
	</div>
	<div class="content">
		<ul id="list"></ul>
	</div>
	<ul id="rowTemplate">
		<li>
			<h2><span class="restaurant"></span></h2>
			<p>Cuisine type: <span class="cuisine"></span></p>.
		</li>
	</ul>
	<!-- scripts -->
	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="//code.jquery.com/ui/1.10.4/jquery-ui.min.js"></script>
	<script src="<?php echo $baseUrl; ?>index.js"></script>
	<script type="text/javascript">
		restaurant.listData('');
		$('#search').keyup(function(e) {
			restaurant.listData(this.value);
		});
		restaurant.getData();
	</script>
</body>
</html>