<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>
            <?= (isset($title)) ? $title : "Ornagai :: English <> Myanmar Dictionary" ?> </title>
        <link rel="stylesheet" href="<?= $base ?>/css/admin.css">
        <script src="<?= $base ?>/js/jquery.js" type="text/javascript"></script>
        <script src="<?= $base ?>/js/jq_box.min.js" type="text/javascript"></script>
    </head>
    <body>
    <div class="popup" id="loading">
    	<p><br/><br/><br/><br/><img src="<?= $base ?>/images/load.gif"></p>
    </div>
    <!-- need to implement admin menu -->
    <ul>
    	<li><a href="<?= $base?>/index.php/admin">Home</a></li>
    </ul>