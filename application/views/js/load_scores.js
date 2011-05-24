  function reloadAjaxParams()
  {
          reloadMyScore();
          reloadTeamScore();
        //  reloadMyTotalScore();
        //  reloadTotalTeamScore();
          reloadNumTeamMembers();
          reloadTeamLeader();
          reloadRank();                   
  }


function reloadMyScore()
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
            document.getElementById("myscore_eventid").innerHTML=xmlhttp.responseText;
            }
          }
        xmlhttp.open("GET", $("#base-url").html() + "index.php/scores/get_my_score_ajax",true);
        xmlhttp.send();
     }
     function reloadMyTotalScore()
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
            document.getElementById("myscore_total").innerHTML=xmlhttp.responseText;
            }
          }
        xmlhttp.open("GET", $("#base-url").html() + "index.php/scores/get_my_total_score_ajax",true);
        xmlhttp.send();
     }
     
     function reloadTeamScore()
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
            document.getElementById("teamscore_eventid").innerHTML=xmlhttp.responseText;
            }
          }
        xmlhttp.open("GET", $("#base-url").html() + "index.php/scores/get_team_score_ajax",true);
        xmlhttp.send();
     }
     
      function reloadTotalTeamScore()
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
            document.getElementById("totalscore_total").innerHTML=xmlhttp.responseText;
            }
          }
        xmlhttp.open("GET", $("#base-url").html() + "index.php/scores/get_total_team_score_ajax",true);
        xmlhttp.send();
     }
     
      function reloadRank()
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
            document.getElementById("rank").className='rank_'+ xmlhttp.responseText;
            }
          }
        xmlhttp.open("GET", $("#base-url").html() + "index.php/scores/get_rank_ajax",true);
        xmlhttp.send();
     }
     
      function reloadNumTeamMembers()
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
            document.getElementById("teammembers_eventid").innerHTML=xmlhttp.responseText;
            }
          }
        xmlhttp.open("GET", $("#base-url").html() + "index.php/teams/get_num_team_members_ajax",true);
        xmlhttp.send();
     }
     
     function reloadTeamLeader()
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
            document.getElementById("teamleader").innerHTML=xmlhttp.responseText;
            }
          }
        xmlhttp.open("GET", $("#base-url").html() + "index.php/teams/get_team_leader_ajax",true);
        xmlhttp.send();
     
     }
     
 