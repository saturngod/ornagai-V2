<?php
$base.="/touch";
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title><?= $title ?></title>
        <style type="text/css" media="screen">@import "<?= $base ?>/jqtouch/jqtouch.min.css";</style>
        <style type="text/css" media="screen">@import "<?= $base ?>/themes/apple/theme.min.css";</style>
        <script src="<?= $base ?>/jqtouch/jquery.1.3.2.min.js" type="text/javascript" charset="utf-8"></script>
        <script src="<?= $base ?>/jqtouch/jqtouch.min.js" type="application/x-javascript" charset="utf-8"></script>
        <link rel="apple-touch-icon" href="<?= $base ?>/images/logo.png" />
        <link rel="apple-touch-startup-image" href="<?= $base ?>/images/startup.png" />
        <script src="<?= $base ?>/embed/cufon-yui.js" type="text/javascript"></script>
        <script src="<?= $base ?>/embed/Zawgyi-One_400.font.js" type="text/javascript"></script>
        <script type="text/javascript" charset="utf-8">
            var jQT = new $.jQTouch({
                statusBar: 'black',
                preloadImages: [
                    '<?= $base ?>/themes/apple/img/backButton.png',
                    '<?= $base ?>/themes/apple/img/back_button_clicked.png',
                    '<?= $base ?>/themes/apple/img/button_clicked.png',
                    '<?= $base ?>/themes/apple/img/grayButton.png',
                    '<?= $base ?>/themes/apple/img/whiteButton.png',
                    '<?= $base ?>/themes/apple/img/loading.gif'
                    ]
            });

	</script>
	</head>
	<body>