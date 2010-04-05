<?php
$base.="/touch";
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title><?php echo $title ?></title>
        <style type="text/css" media="screen">@import "<?php echo $base ?>/jqtouch/jqtouch.min.css";</style>
        <style type="text/css" media="screen">@import "<?php echo $base ?>/themes/<?php echo $theme ?>/theme.min.css";</style>
        <script src="<?php echo $base ?>/jqtouch/jquery.1.3.2.min.js" type="text/javascript" charset="utf-8"></script>
        <script src="<?php echo $base ?>/jqtouch/jqtouch.min.js" type="application/x-javascript" charset="utf-8"></script>
        <link rel="apple-touch-icon" href="<?php echo $base ?>/images/logo.png" />
        <link rel="apple-touch-startup-image" href="<?php echo $base ?>/images/startup.png" />
        <script src="<?php echo $base ?>/embed/cufon-yui.js" type="text/javascript"></script>
        <script src="<?php echo $base ?>/embed/Zawgyi-One_400.font.js" type="text/javascript"></script>
        <script type="text/javascript" charset="utf-8">
            var jQT = new $.jQTouch({
                statusBar: 'default',
                preloadImages: [
                    '<?php echo $base ?>/themes/<?php echo $theme ?>/img/backButton.png',
                    '<?php echo $base ?>/themes/<?php echo $theme ?>/img/back_button_clicked.png',
                    '<?php echo $base ?>/themes/<?php echo $theme ?>/img/button_clicked.png',
                    '<?php echo $base ?>/themes/<?php echo $theme ?>/img/grayButton.png',
                    '<?php echo $base ?>/themes/<?php echo $theme ?>/img/whiteButton.png',
                    '<?php echo $base ?>/themes/<?php echo $theme ?>/img/loading.gif'
                    ]
            });

	</script>
	</head>
	<body>