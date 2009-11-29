<?php
$data['title']=$title;
$data['base']=$base;
$this->load->view("adminheader_view",$data);
echo "<table width='100%'>";
echo "<tr>";
echo "<td>Username</td>";
echo "<td>Email</td>";
echo "<td>Join Date</td>";
echo "<td>Ban</td>";
echo "<td>Action</td>";
foreach ($userlist as $user)
{
    echo "<tr>";
    echo "<td>";
    echo $user->username;
    echo "</td>";
    echo "<td>";
    echo $user->email;
    echo "</td>";
    echo "<td>";
    echo $user->join_date;
    echo "</td>";
    echo "<td>";
    echo $user->ban;
    echo "</td>";
     echo "<td>";
    echo  "<a href='{$base}/index.php/admin/usr_edit/{$user->id}' >Edit</a> | ";
    if($user->ban==0) echo  "<a href='{$base}/index.php/admin/usr_ban/{$user->id}' >Ban </a> | ";
    else echo "<a href='{$base}/index.php/admin/usr_ban/{$user->id}' >Unban </a> | ";
    echo  "<a href='{$base}/index.php/admin/usr_del/{$user->id}' >Delete</a>";
    echo "</td>";
    echo "</tr>";
}
echo "</table>";

echo $paging;
?>
