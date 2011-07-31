<input type="hidden" id="userid" value="<?php echo $userinfo->id?>" />
<label>Username</label>
<input type="text" id="username" value="<?php echo $userinfo->username ?>">
<label>Email</label>
<input type="email" id="email" value="<?php echo $userinfo->email ?>" />
<label>JoinDate</label>
<input type="text" id="date" value="<?php echo $userinfo->join_date ?>" />
<label>Ban</label>
<input type="checkbox" id="ban" <?php echo ($userinfo->ban==1) ? "checked":"" ?> />
