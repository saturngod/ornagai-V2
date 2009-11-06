<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>reCaptcha</title>
</head>
<body>
<?= form_open("recaptchademo") ?>
<?= form_error('recaptcha_response_field') ?>
<?= $recaptcha ?>
<?= form_submit('recaptchasubmit','Check Recaptcha') ?>
<?= form_close() ?>
</body>
</html>