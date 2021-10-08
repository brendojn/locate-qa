<html>
    <head>
        <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <title>Location QA</title>
	    <link href="<?php echo BASE_URL; ?>assets/css/bootstrap.min.css" rel="stylesheet">
	    <link href="<?php echo BASE_URL; ?>assets/css/template.css" rel="stylesheet">
	    <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery.min.js"></script>
	    <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/bootstrap.min.js"></script>
	    <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/script.js"></script>
        <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
        <link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
    </head>
    <body>
		<nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a href="<?php echo BASE_URL; ?>" class="navbar-brand">123Milhas - Sistema de locação QA</a>
                </div>
                <ul class="nav navbar-nav navbar-right">
                    <?php if (isset($_SESSION['logged']) && !empty($_SESSION['logged'])): ?>
                        <li><a href="<?php echo BASE_URL; ?>locates">Locações</a></li>
<!--                        <li><a href="--><?php //echo BASE_URL; ?><!--employees">QA's</a></li>-->
                        <li><a href="<?php echo BASE_URL; ?>login/sair">Sair</a></li>
                    <?php else: ?>
                        <li><a href="<?php echo BASE_URL; ?>add">Cadastre-se</a></li>
                        <li><a href="<?php echo BASE_URL; ?>login">Login</a></li>
                    <?php endif; ?>
                </ul>
            </div>
		</nav>
		<div class="container">
	        <?php
	        $this->loadViewInTemplate($viewName, $viewData);
	        ?>
	    </div>
    </body>
</html>
