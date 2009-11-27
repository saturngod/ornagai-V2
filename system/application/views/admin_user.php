<?php
$data['title']=$title;
$data['base']=$base;
$this->load->view("adminheader_view",$data);
echo "<table width='100%'>";
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
    echo  "Edit";
    echo "</td>";
     echo "<td>";
    echo "Delete";
    echo "</td>";
    echo "</tr>";
}
echo "</table>"
?>
