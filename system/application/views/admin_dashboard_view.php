<?php
$data['title']=$title;
$data['base']=$base;
$this->load->view("adminheader_view",$data);
?>
<body>
    <div class="statics">
        <div class="left">
        <ul>
            <li><a href="<?= $base ?>/index.php/admin/users">Users</a></li>
            <li>Unapprove</li>
            <li>Approve</li>
            <li>Total</li>
        </ul>
        </div>
        
        <div class="right">
        <ul>
            <li><?= $total_users ?></li>
            <li>Unapprove</li>
            <li>Approve</li>
            <li>Total</li>
        </ul>
        </div>
    </div>
</body>