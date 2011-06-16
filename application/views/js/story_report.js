  function SendPost()
   {
      
      var subject = document.getElementById("subject").value; 
      var story = document.getElementById("post_mail").value;
      var name = document.getElementById("name").value;
      var location = document.getElementById("location").value;
      var args;
      
      if (window.XMLHttpRequest)
        {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
        }
      else
        {// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
      xmlhttp.onreadystatechange=function()
        {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
          {
          //document.getElementById("error_msg").innerHTML=xmlhttp.responseText;
          Ext.MessageBox.alert('Result', xmlhttp.responseText);
          //alert(xmlhttp.responseText);
          }
        }
      xmlhttp.open("POST", $("#base-url").html() + "index.php/story_report/post_story_ajax", true);  
      xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
   
      args = "subject=" + subject;
      args = args + "name=" + name;
      args = args + "location=" + location;      
      args = args + "&story="  + story;
      
      
      xmlhttp.send(args);
   
   }


    Ext.onReady(function() {
    
         reloadAjaxParams();  
    
    });