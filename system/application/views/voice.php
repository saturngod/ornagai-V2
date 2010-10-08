<?php
if($mp3)
{
?>
<audio controls autobuffer autoplay>
<source  src="<?php echo urldecode($sound) ?>" ?>
</audio>
<?php
}
else
{
?>
<object type="application/x-shockwave-flash" data="<?php echo $base ?>/medias/player_mp3.swf" width="200" height="20">
    <param name="movie" value="<?php echo $base ?>/medias/player_mp3.swf" />
    <param name="bgcolor" value="#ffffff" />
    <param name="FlashVars" value="mp3=<?php echo $sound ?>" />
</object>


<?php
}
?>