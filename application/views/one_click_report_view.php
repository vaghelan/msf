<html>

<head>
       <title>Scores Report!</title>
        <link rel="stylesheet" href="<?php echo base_url();?>css/style.css" type="text/css" media="screen" />
<style>
a {
color: #00aeff;
}
.form_{
width: 400px !important;
}
.form_ h1{
	margin-top: 0px;
}
</style>

</head>

<body>
<div id="one_click_report_view" class="form_">
<div class="img_sign"></div>
<?php
if ($num == 0)
{
  echo "<h1>Congrats!! You are now counted.</h1> <p>Thank you very much.</p>";
}
else

  echo "<h1>You are already counted.</h1>"; 

echo "If you want to report more books, please <a href=\"http://7thgoswami.com/account/?login\">login</a> and add books.";
?> 

</div>
</body>

</html>
