<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Debate</title>
		<meta name="description" content="A new bootstrap theme">
		<meta name="author" content="Damian Sowers">
		<link href="css/bootstrap.css" rel="stylesheet">
		<link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:700,600' rel='stylesheet' type='text/css'>
		<link href='css/boxer.css' rel='stylesheet' type='text/css'>
	</head>
<body id="top">
<div class="navbar navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
					<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="brand" href="/">Debate</a>

					<ul class="nav boxer_nav">
						<li><a href="/">Home</a></li>
						<?php if(isset($_SESSION['id'])) : ?>
						<li><a href="/debates">Debates</a></li>
						<li><a href="/new-debate">New debate</a></li>
						<li><a href="/account">My account</a></li>
						<?php endif; ?>
					</ul>
					<ul class="nav boxer_nav pull-right">
						<?php if(!isset($_SESSION['id'])) : ?>
							<li><a href="/login">Login</a></li>
							<li><a href="/register">Register</a></li>
						<?php endif; ?>
						<?php if(isset($_SESSION['id'])) : ?>
							<li><a href="/logout">Logout</a></li>
						<?php endif; ?>
					</ul>
				</div>
			</div>
		</div>