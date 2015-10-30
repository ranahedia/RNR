<?php
$userInfo = Zend_Auth::getInstance()->getStorage()->read();
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
                <li><a href="<?php echo $this->baseUrl() ?>/Category/list/"> Categories </a></li>
                <li><a href="<?php echo $this->baseUrl() ?>/chatroom/index/"> Chat </a></li>

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?php echo $this->baseUrl() . "/User/display/id/" . $userInfo->id; ?>"><?php echo $userInfo->userName; ?></a></li>
                <li><img class="img-circle" src='<?php echo $this->baseUrl() . '/images/user/profilePicture/' . $userInfo->profilePicture; ?>' width="50px" height="50px"/></li>
                <li><a href="<?php echo $this->baseUrl() ?>/user/logout/">Log out <span class="glyphicon glyphicon-log-out"></span></a></li>
            </ul>
        </div>
    </nav>
