<input type="hidden" id="userid" value="<?= $userinfo->id?>" />
<label>Username</label>
<input type="text" id="username" value="<?= $userinfo->username ?>">
<label>Email</label>
<input type="email" id="email" value="<?= $userinfo->email ?>" />
<label>JoinDate</label>
<input type="text" id="date" value="<?= $userinfo->join_date ?>" />
<label>Ban</label>
<input type="checkbox" id="ban" <?= ($userinfo->ban==1) ? "checked":"" ?> />
