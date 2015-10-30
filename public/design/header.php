<?php
$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];
?>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="<?php echo $this->baseUrl() ?>/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src ="<?php echo $this->baseUrl() ?>/js/bootstrap.min.js"></script>
    </head>


    <nav class="navbar navbar-inverse">
        <div class="navbar-header">
            <a class="navbar-brand" >logo</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li class="active"><a href="<?php echo $this->baseUrl() ?>/user/home/">Home</a></li>
                <li><a href="<?php echo $this->baseUrl() ?>/Category/list"> Categories </a></li>
                <li><a href="<?php echo $this->baseUrl() ?>/Index/about"> About </a></li>
                <li><a href="<?php echo $this->baseUrl() ?>/user/add/"> Sign Up</a></li>
                <li><a href="<?php echo $this->baseUrl() ?>/user/login/"> Sign In </a></li>
            </ul>
        </div>
    </nav>
