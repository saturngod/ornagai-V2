<?php
$data['title']=$title;
$data['base']=$base;
$this->load->view("adminheader_view",$data);
?>
    <div class="statics">
        <div class="left">
        <ul>
            <li><a href="<?= $base ?>/index.php/admin/users">Users</a></li>
            <li><a href="<?= $base ?>/index.php/admin/enunapprove">Unapprove English Word</a></li>
            <li><a href="<?= $base ?>/index.php/admin/myunapprove">Unapprove Myanmar Word</a></li>
            <li>EN Approve</li>
            <li>EN Total</li>
            <li>EN Approve</li>
            <li>EN Total</li>
        </ul>
        </div>
        
        <div class="right">
        <ul>
            <li><?= $total_users ?></li>
            <li><?= $en_unapprove ?></li>
            <li><?= $my_unapprove ?></li>
            <li>EN Approve</li>
            <li>EN Total</li>
            <li>MM Approve</li>
            <li>MM Total</li>
        </ul>
        </div>
    </div>
<?php
$data['title']=$title;
$data['base']=$base;
$this->load->view("adminfooter_view",$data);
?>