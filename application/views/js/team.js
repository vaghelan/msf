  var  DataStore;
  var PageSize = 10;
  var ColumnModel;
  var ListingEditorGrid;
   
  function SendInvite()
   {
      // $('textarea[name="ta"]').val();
      var email_list = document.getElementById("email_list").value; 
      var message = document.getElementById("message").value;
      var args;
      var i;
      
      
      var email_array=email_list.split(",");
      
      for (i = 0; i < email_array.length; i++)
      {
          var e = email_array[i];
          var atpos=e.indexOf("@");
          var dotpos=e.lastIndexOf(".");
          if (atpos<1 || dotpos<atpos+2 || dotpos+2>=e.length)
          {
            Ext.MessageBox.alert('Error:', "Not a valid e-mail address: " + e);
            return;
          }
      }   
      
      if (message == "Enter your message....")
      {
          Ext.MessageBox.alert('Error:', 'Please enter your message or blank out');
          // alert("Please enter your message or blank out");
          return;
      
      }

      Ext.MessageBox.show({
           msg: 'Sending Invite, please wait...',
           wait:true
       });   
      
      Ext.Ajax.request({  
      waitMsg: 'Please Wait',
      url: $("#base-url").html() + 'index.php/invite/send_invite_ajax',
      params: { 
         email_list: email_list, 
         message:  message
        }, 
      success: function(response){
        var result=eval(response.responseText);
        switch(result){
        case 1:  // Success : simply reload
          
          Ext.MessageBox.alert('Result', 'Your friends invited!!');
          document.getElementById("email_list").value="Type a list of invitee email addresses...";
          document.getElementById("message").value="Enter your message...";
          break;
        default:
          Ext.MessageBox.alert('Warning','Your friends could not be invited');
          break;
        }
      },
      failure: function(response){
        var result=response.responseText;
        Ext.MessageBox.alert('error','could not connect to the server. retry later');      
        }
      });
  }
  
  Ext.onReady(function() {
  
  
   reloadAjaxParams();
      
    // Initalize
    Ext.QuickTips.init();
  
     // Define the Datastore for Listing
    DataStore = new Ext.data.Store({
        id: 'DataStore',
        proxy: new Ext.data.HttpProxy({
                  url: $("#base-url").html() + 'index.php/teams/get_team_members_ajax', 
                  method: 'POST'
              }),
              baseParams:{task: "LISTING"}, // this parameter is passed for any HTTP request
        reader: new Ext.data.JsonReader({
          root: 'results',
          totalProperty: 'total',
          id: 'id'
        },
        [ 
          {name: 'ID', type: 'int', mapping: 'id'},
          {name: 'Name', type: 'string', mapping: 'name'},
          {name: 'Email', type: 'string', mapping: 'email_address'},
          {name: 'MyCount', type: 'int', mapping: 'my_count'},
          {name: 'TotalCount', type: 'int', mapping: 'total_count'},
          {name: 'TotalTeamMembers', type: 'int', mapping: 'total_members'}
          
        ]),
        sortInfo:{field: 'ID', direction: "ASC"}
      });
      
      
       ColumnModel = new Ext.grid.ColumnModel(
       [
       {
          header: 'ID',
          dataIndex: 'ID',
          width: 50,
          hidden: true,
          readOnly: true
  		  },   
        {
          header: 'Name',
          dataIndex: 'Name',
          width: 300,
          hidden: false,
          readOnly: true
  		  },   
  		  {
          header: 'Books Distributed (Current Event)',
          dataIndex: 'MyCount',
          width: 100,
          hidden: false,
          readOnly: true
  		  },
        {
          header: 'Total Books Distributed',
          dataIndex: 'TotalCount',
          width: 100,
          hidden: false,
          readOnly: true
  		  },
        {
          header: 'Num Team Members',
          dataIndex: 'TotalTeamMembers',
          width: 100,
          hidden: false,
          readOnly: true
  		  },
  		  {
          header: 'E-Mail',
          dataIndex: 'Email',
          width: 150,
          hidden: true,
          readOnly: true
  		  }
                       
              
              
        ]); 
      ColumnModel.defaultSortable= true;

          
      DataStore.load({params: {start: 0, limit: PageSize}});
      
      ListingEditorGrid =  new Ext.grid.EditorGridPanel({
       // width    : 700,
        height   : 300,
        id: 'ListingEditorGrid',
        store: DataStore,     // the datastore is defined here
        cm: ColumnModel,      // the columnmodel is defined here
        enableColLock:false,
      //  clicksToEdit:1,
        selModel: new Ext.grid.RowSelectionModel({singleSelect:false}) ,
        renderTo: 'teams-form',
        bbar: new Ext.PagingToolbar({
                pageSize: PageSize,
                store: DataStore,
                displayInfo: true
            })    

      });
       
      
      
   }
   
      
  );