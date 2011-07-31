<?php
$data['title']=$title;
$data['base']=$base;
$this->load->view("adminheader_view",$data);
?>
<script>
<?php $this->load->view("jquery_start") ?>
$(".left ul li:even").css("background-color", "#D4DDE6");
$(".right ul li:even").css("background-color", "#D4DDE6");
<?php $this->load->view("jquery_end") ?>
</script>
    <div class="statics">
        <div class="left">
        <ul>
            <li><a href="<?php echo $base ?>/index.php/admin/users">Users</a></li>
            <li><a href="<?php echo $base ?>/index.php/admin/enunapprove">Unapprove English Word</a></li>
            <li><a href="<?php echo $base ?>/index.php/admin/myunapprove">Unapprove Myanmar Word</a></li>
            <li>EN Approve</li>
            <li>EN Total</li>
            <li>EN Approve</li>
            <li>EN Total</li>
        </ul>
        </div>
        
        <div class="right">
        <ul>
            <li><?php echo $total_users ?></li>
            <li><?php echo $en_unapprove ?></li>
            <li><?php echo $my_unapprove ?></li>
            <li><?php echo $en_total-$en_unapprove ?></li>
            <li><?php echo $en_total ?></li>
            <li><?php echo $my_total - $my_unapprove  ?></li>
            <li><?php echo $my_total ?></li>
        </ul>
        </div>
    </div>
<?php
$data['title']=$title;
$data['base']=$base;
$this->load->view("adminfooter_view",$data);
?>