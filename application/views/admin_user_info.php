<table> <tr> <th> ID </th> <th> Name </th> <th> email_address </th> <th> books_distributed </th> <th> username </th> <th> URL </th></tr>
<?php
foreach ($user_recs as $row)
{
      echo "<tr>";                             
      echo "<td>" . $row['id'] . "</td>";
      echo "<td>" . $row['name'] . "</td>";
      echo "<td>" . $row['email_address'] . "</td>";
      echo "<td>" . $row['my_score'] . "</td>";
      echo "<td>" . $row['username'] . "</td>";
      echo "<td>" . base_url() . "index.php/one_click_score/report/" . $row['id'] . "/". $row['value'] . "/1</td>";
      echo "</tr>";
}
?>
</table> 