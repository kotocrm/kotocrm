<?php
function active_class($url)
{
    if (preg_match('/' . $url . '/', $_SERVER['REQUEST_URI'])) {
        return 'active';
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>CRM</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="assets/css/bootstrap-theme.min.css">

        <!-- Latest compiled and minified JavaScript -->
        <script src="assets/js/bootstrap.min.js"></script>

        <style>
            body {
                padding-top: 50px;
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php">CRM</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="<?php echo active_class('index.php') ?>">
                            <a href="index.php">
                                <span class="glyphicon glyphicon-heart-empty">&nbsp;</span>Contas
                            </a>
                        </li>
                        <li class="<?php echo active_class('contacts.php') ?>">
                            <a href="contacts.php">
                                <span class="glyphicon glyphicon-user">&nbsp;</span>Contatos
                            </a>
                        </li>
                        <li class="<?php echo active_class('opportunities.php') ?>">
                            <a href="opportunities.php">
                                <span class="glyphicon glyphicon-usd">&nbsp;</span>Oportunidades
                            </a>
                        </li>
                        <li class="<?php echo active_class('leads.php') ?>">
                            <a href="leads.php">
                                <span class="glyphicon glyphicon-eye-open">&nbsp;</span>Leads
                            </a>
                        </li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </nav>
        <div class="container">
