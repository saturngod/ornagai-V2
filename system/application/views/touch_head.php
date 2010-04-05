<?php
$base.="/touch";
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title><?= $title ?></title>
        <style type="text/css" media="screen">@import "<?= $base ?>/jqtouch/jqtouch.min.css";</style>
        <style type="text/css" media="screen">@import "<?= $base ?>/themes/<?= $theme ?>/theme.min.css";</style>
        <link type="text/css" rel="stylesheet" media="only screen and (max-device-width: 480px)" href="<?= $base ?>/themes/embed.css" />
        <script src="<?= $base ?>/jqtouch/jquery.1.3.2.min.js" type="text/javascript" charset="utf-8"></script>
        <script src="<?= $base ?>/jqtouch/jqtouch.min.js" type="application/x-javascript" charset="utf-8"></script>
        <link rel="apple-touch-icon" href="<?= $base ?>/images/logo.png" />
        <link rel="apple-touch-startup-image" href="<?= $base ?>/images/startup.png" />
        <script type="text/javascript" charset="utf-8">
            var jQT = new $.jQTouch({
                statusBar: 'default',
                preloadImages: [
                    '<?= $base ?>/themes/<?= $theme ?>/img/backButton.png',
                    '<?= $base ?>/themes/<?= $theme ?>/img/back_button_clicked.png',
                    '<?= $base ?>/themes/<?= $theme ?>/img/button_clicked.png',
                    '<?= $base ?>/themes/<?= $theme ?>/img/grayButton.png',
                    '<?= $base ?>/themes/<?= $theme ?>/img/whiteButton.png',
                    '<?= $base ?>/themes/<?= $theme ?>/img/loading.gif'
                    ]
            });

	</script>
	<style>
	ul li a.active
	{
		background: none;
		<?php
		if($theme=="apple")
		{
			echo "color: #333";
		}
		else
		{
			echo "color: #FFF";
		}
		?>
	}
	</style>
	</head>
	<body>