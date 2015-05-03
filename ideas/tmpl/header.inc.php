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
    <script type="text/javascript" src="static/common.js"></script>
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
            <?php if (is_array($data) && array_key_exists('user', $data)
                        && is_array($data['user']) && array_key_exists('name', $data['user'])) { ?>
                <?= $data['user']['name'] ?> <a href="javascript:logout()">(Logout)</a>
            <?php } else { ?>
                <a href="index.php?resourceName=login">Login</a>
            <?php }?>
        </div>
    </div>
    <div id="navigation">
        <div id="actions_left" >
            <a class="action" href="index.php?resourceName=main">Main page</a>
        </div>
        <div id="actions_right">
            <a class="action" href="index.php?resourceName=new_idea"><span class="fa fa-plus"></span> New Idea</a>
        </div>
    </div>
</header>