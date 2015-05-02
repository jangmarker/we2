<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="static/card.css" />
    <link rel="stylesheet" type="text/css" href="static/header.css" />
    <link rel="stylesheet" type="text/css" href="static/bubbles.css" />
    <link rel="stylesheet" type="text/css" href="static/common.css" />
    <link rel="stylesheet" type="text/css" href="static/<?= $this->templateName ?>.css"/>
    <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <script type="text/javascript" src="static/card.js"></script>
    <script type="text/javascript" src="static/bubbles.js"></script>
    <title></title>
</head>
<body>
<header>
    <div id="top">
        <div id="logo">
            <a href="index.php?resourceName=main">
                <span id="logo_icon" class="fa fa-lightbulb-o fa-2x"></span>
                <span id="logo_text">Ideas</span>
            </a>
        </div>
        <div id="search">
            <form method="get" action="index.php">
                <input name="resourceName" type="hidden" value="search">
                <input id="search_input" type="id" name="id" placeholder="Search..." />
                <button id="search_button"><span class="fa fa-search"></span></button>
            </form>
        </div>
        <div id="account">
            <?= $data['user']['name'] ?>
        </div>
    </div>
    <div id="navigation">
        <div id="menu_button">
            Menu
        </div>
        <div id="action">

        </div>
    </div>
</header>