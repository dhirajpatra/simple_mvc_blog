<style>
	ul {
		list-style-type: none;
		margin: 0;
		padding: 0;
		overflow: hidden;
		background-color: #333333;
	}

	li {
		float: left;
	}

	li a {
		display: block;
		color: white;
		text-align: center;
		padding: 16px;
		text-decoration: none;
	}

	li a:hover {
		background-color: #111111;
	}
</style>
<div class="header">
	<img src="/logo.png">
</div>
<nav>
	<ul id="menu">
		<li><a href="<?php echo ROOT; ?>/">Home</a></li>
		<li><a href="<?php echo ROOT; ?>/index/add">Add Entry</a></li>
		<li><a href="<?php echo ROOT; ?>/user/logout">Logout</a></li>
		<small style="color:white; text-align: right;"><?php echo isset($_SESSION['user_name'])?$_SESSION['user_name']:null; ?></small>
	</ul>

</nav>