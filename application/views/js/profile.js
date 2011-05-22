
    Ext.onReady(function() {
    
         reloadAjaxParams();  
    
    });
    
    function SavePassword()
    {
      var xmlhttp;
      var p1 = document.getElementById("new_password1").value;
      var p2 = document.getElementById("new_password2").value;
      
      
      if (p1 != p2)
      {
        Ext.MessageBox.alert('Error', 'Passwords do not match!!');
        //alert("Error: Passwords do not match!!!");
        return;
      }
      if (p1 == "" || p2 == "")
      {
        Ext.MessageBox.alert('Error', 'Password fields are blank');
        // alert("Error: password fields are blank");
        return; 
      }
      
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
      xmlhttp.open("POST", $("#base-url").html() + "index.php/members/save_password_ajax", true);  
      xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
      
      xmlhttp.send("new_password=" + document.getElementById("new_password1").value);
   }
   
    function SaveName()
    {
      var xmlhttp;
      
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
      xmlhttp.open("POST", $("#base-url").html() + "index.php/members/save_name_ajax", true);  
      xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
      
      xmlhttp.send("name=" + document.getElementById("name").value);
   }
   
    function SaveAddress()
    {
      var xmlhttp;
      var street1 =  document.getElementById("street1").value;
      var street2 =  document.getElementById("street2").value;
      var state =  document.getElementById("state").value;
      var city =  document.getElementById("city").value;
      var zip =  document.getElementById("zip").value;
      var country =  document.getElementById("country").value;
      var residential_phone = document.getElementById("residential_phone").value;
      var business_phone = document.getElementById("business_phone").value;
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
          //$.showMessage(xmlhttp.responseText);
          }
        }
      xmlhttp.open("POST", $("#base-url").html() + "index.php/members/save_address_ajax", true);  
      xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
      args = "street1=" + street1;
      args = args + "&street2="  + street2;
      args = args + "&state="  + state;
      args = args + "&city="  + city;
      args = args + "&zip="  + zip;
      args = args + "&country="  + country;
      args = args + "&residential_phone="  + residential_phone;
      args = args + "&business_phone="  + business_phone;      
      // alert("args = " + args);
      
      
      
      xmlhttp.send(args);
   }
   
   function SaveAnswers()
   {
      var q_books = document.getElementById("q_books").value;;
      var q_community = document.getElementById("q_community").value;;
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
      xmlhttp.open("POST", $("#base-url").html() + "index.php/members/save_answers_ajax", true);  
      xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
   
      args = "q_books=" + q_books;
      args = args + "&q_community="  + q_community;
      
      
      xmlhttp.send(args);
   
   }
