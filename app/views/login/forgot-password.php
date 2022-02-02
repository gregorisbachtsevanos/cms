<!DOCTYPE html>
<html lang="el">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="<?php echo $appName; ?>" />
	<meta name="author" content="Global Concept" />
	<base href="<?php echo $appDir; ?>">
	<link rel="icon" href="assets/images/favicon.ico">

	<title><?php slang('TITLE'); ?> | <?php echo $appName; ?></title>

	<link rel="stylesheet" href="assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
	<link rel="stylesheet" href="assets/css/font-icons/entypo/css/entypo.css">
	<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
	<link rel="stylesheet" href="assets/css/bootstrap.css">
	<link rel="stylesheet" href="assets/css/neon-core.css">
	<link rel="stylesheet" href="assets/css/neon-theme.css">
	<link rel="stylesheet" href="assets/css/neon-forms.css">
	<link rel="stylesheet" href="assets/css/custom.css">

	<script src="assets/js/jquery-1.11.3.min.js"></script>

	<!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
	
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->


</head>
<body class="page-body login-page login-form-fall" data-url="<?php echo $appURL; ?>">
<script type="text/javascript">
var baseurl = '<?php echo $appURL; ?>';
</script>
	<div class="login-container">
	
		<div class="login-header login-caret">
			
			<div class="login-content">
				
				<a href="<?php echo $appURL; ?>" class="logo">
					<img src="assets/images/logo@2x.png" width="120" alt="" />
				</a>
				
				<p class="description"><?php slang('login_intro'); ?></p>
				
				<!-- progress bar indicator -->
				<div class="login-progressbar-indicator">
					<h3>43%</h3>
					<span><?php slang('connecting'); ?></span>
				</div>
			</div>
			
		</div>
		
		<div class="login-progressbar">
			<div></div>
		</div>
		
		<div class="login-form">
			
			<div class="login-content">
				
				<div class="form-login-error">
					<h3><?php slang('wrong_login'); ?></h3>
					<p><?php slang('wrong_login_text', 'https://globalconcept.gr/contact'); ?></p>
				</div>
				
				<form method="post" role="form" id="form_forgot">
					
					<div class="form-group">
						
						<div class="input-group">
							<div class="input-group-addon">
								<i class="entypo-user"></i>
							</div>
							
							<input type="text" class="form-control" name="vat" id="forgot_vat" placeholder="<?php slang('login_field'); ?>" autocomplete="off" />
						</div>
						
					</div>
					
					<div class="form-group">
						<button type="submit" class="btn btn-primary btn-block btn-login">
							<i class="entypo-login"></i>
							<?php slang('continue'); ?>
						</button>
					</div>
					
					
				</form>
				
				
				<div class="login-bottom-links">
					
					<a href="<?php echo $appURL; ?>login" class="link"><?php slang('login'); ?></a>
					
					
					
				</div>
				
			</div>
			
		</div>
		
	</div>
<script src="assets/js/gsap/TweenMax.min.js"></script>
<script src="assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
<script src="assets/js/bootstrap.js"></script>
<script src="assets/js/joinable.js"></script>
<script src="assets/js/resizeable.js"></script>
<script src="assets/js/neon-api.js"></script>
<script src="assets/js/jquery.validate.min.js"></script>
<script src="assets/js/neon-forgot.js"></script>
</html>
