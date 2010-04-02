<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>
            <?= (isset($title)) ? $title : "Ornagai :: English &lt;&gt; Myanmar Dictionary" ?> </title>
        <link rel="stylesheet" href="<?= $base ?>/css/admin.css">
        <link rel="stylesheet" href="<?= $base ?>/css/jq_style.css" type="text/css" />
        <script src="<?= $base ?>/js/jquery.js" type="text/javascript"></script>
        <script src="<?= $base ?>/js/jq_box.js" type="text/javascript"></script>
    </head>
    <body>
    <div class="popup" id="loading">
    	<p><br/><br/><br/><br/><img src="<?= $base ?>/images/load.gif"></p>
    </div>
    <!-- need to implement admin menu -->
    <div class="admin_menu_wrapper">
    <ul class="admin_menu">
    	<li><a href="<?= $base?>/index.php/admin">Home</a></li>
    	<li><a href="<?= $base?>/index.php/admin/users">User List</a></li>
    	<li><a href="<?= $base?>/index.php/admin/enunapprove">En Unapprove</a></li>
    	<li><a href="<?= $base?>/index.php/admin/myunapprove">MM Unapprove</a></li>
    </ul>
    </div>