ID, Name, email_address, books_distributed, username, Last_Logged_in , Time_Registered <br>
<?php

foreach ($user_recs as $row)
{
      echo "";                             
      echo "" . $row['id'] . "";
      echo "," . $row['name'] . "";
      echo "," . $row['email_address'] . "";
      echo "," . $row['my_score'] . "";
      echo "," . $row['username'] . "";
      //echo "<td>" . base_url() . "index.php/one_click_score/report/" . $row['id'] . "/". $row['value'] . "/1</td>";
      echo "," . $row['last_logged_in'] . "";
      echo "," . $row['time_registered'] . "";
      echo "<br>";
}
?>
</table> 