  var DataStore;
  var BooksListingDataStore;
  var ColumnModel;
  var ListingEditorGrid;
  var ListingWindow;
  
  var AddFormBookField;
  var AddFormCountField;
 // var AddFormDateField;
  var AddScoreForm;
  var AddScoreFormWindow;
  var PageSize = 10;
  

  function saveScore(oGrid_event)
  {      
     Ext.MessageBox.show({
       msg: 'Saving the score, please wait...',
       wait:true
   });     
    Ext.Ajax.request({   
    waitMsg: 'Please wait...',
    url: $("#base-url").html() + 'index.php/scores/save_score_ajax',
    params: {
       task: "SAVESCORE",
       ID: oGrid_event.record.data.ID,
       BID: oGrid_event.record.data.BID,
       BookName: oGrid_event.record.data.BookName,
       ReportDate: oGrid_event.record.data.ReportDate.format('Y-m-d'), // this time we'll format it thanks to ext
       Count: oGrid_event.record.data.Count
    }, 
    success: function(response){							
       var result=eval(response.responseText);
       switch(result){
       case 1:
          Ext.MessageBox.alert('Result', 'Scores Updated!!');
          DataStore.commitChanges();   // changes successful, get rid of the red triangles
          DataStore.reload({params: {start: 0, limit: PageSize}});          // reload our datastore.
          reloadAjaxParams();
          break;					
       default:
          Ext.MessageBox.alert('Result', 'Score Update Failed');
          break;
       }
    },
   failure: function(response) {
       var result=response.responseText;
       Ext.MessageBox.alert('error','could not connect to the database. retry later');		
    }								    
    
    });
    
   }

    // reset the Form before opening it
  function resetAddScoreForm() 
  {
    var currentTime = new Date();
    var month = currentTime.getMonth() + 1;
    var day = currentTime.getDate();
    var year = currentTime.getFullYear();
    var todays_date = year + "/" + month + "/" + day;
    
    AddFormBookField.setValue('');
  //  AddFormDateField.setValue(todays_date);
    AddFormCountField.setValue('1');  
  }
  
  // check if the form is valid
  function isAddScoreFormValid()
  {
    return(AddFormBookField.isValid() && 
   // AddFormDateField.isValid() && 
    AddFormCountField.isValid() ); 
  }
  
  // display or bring forth the form
  function displayFormWindow() 
  {
      if(!AddScoreFormWindow.isVisible())
      {
        resetAddScoreForm();
        AddScoreFormWindow.show();
      } else 
      {
        AddScoreFormWindow.toFront();
      }
  }

  function addBookScore()
  {
     if(isAddScoreFormValid())
     {
      Ext.MessageBox.show({
       msg: 'Adding the score, please wait...',
       wait:true
      });  
      Ext.Ajax.request({   
        waitMsg: 'Please wait...',
        url: $("#base-url").html() + 'index.php/scores/add_score_ajax',
        params: {
          task: "CREATE_SCORE",
          book_name:              AddFormBookField.getValue(),
       //   distribution_date:     AddFormDateField.getValue().format('Y-m-d'),
          book_count:               AddFormCountField.getValue()
        }, 
        success: function(response){              
          var result=eval(response.responseText);
          switch(result){
          case 1:
            Ext.MessageBox.alert('Creation OK',
            'The book score was created successfully.');
            DataStore.reload({params: {start: 0, limit: PageSize}});
            AddScoreFormWindow.hide();
            reloadAjaxParams();
            break;
          default:
            Ext.MessageBox.alert('Warning',
            'Could not add book score.');
            break;
          }        
        },
        failure: function(response){
          var result=response.responseText;
          Ext.MessageBox.alert('error', 'could not connect to the database. retry later');          
        }                      
      });
    } else {
      Ext.MessageBox.alert('Warning', 'Book name or count is not valid!');
    }
  }

   // Delete Scores
   
   function deleteScores(btn)
   {
    if(btn == 'yes')
    {
         var selections = ListingEditorGrid.selModel.getSelections();
         var prez = [];
         for(i = 0; i< ListingEditorGrid.selModel.getCount(); i++)
         {
          
          prez.push(selections[i].json.id);
         }
         var encoded_array = Ext.encode(prez);
        Ext.MessageBox.show({
          msg: 'Deleting the score, please wait...',
          wait:true
         });  
         Ext.Ajax.request({  
            waitMsg: 'Please Wait',
            url: $("#base-url").html() + 'index.php/scores/delete_scores', 
            params: { 
               task: "DELETEPRES", 
               ids:  encoded_array
              }, 
            success: function(response){
              var result=eval(response.responseText);
              switch(result){
              case 1:  // Success : simply reload
                Ext.MessageBox.alert('Result', 'Scores Deleted!!');
                DataStore.reload({params: {start: 0, limit: PageSize}});
                reloadAjaxParams();
                break;
              default:
                Ext.MessageBox.alert('Warning','Could not delete the entire selection.');
                break;
              }
            },
            failure: function(response){
              var result=response.responseText;
              Ext.MessageBox.alert('error','could not connect to the database. retry later');      
              }
            });
      }  
  } 
  
   function confirmDeleteScores()
   {
    if(ListingEditorGrid.selModel.getCount() == 1) // only one president is selected here
    {
      Ext.MessageBox.confirm('Confirmation','Do you really want to delete scores ?', deleteScores);
    } else if(ListingEditorGrid.selModel.getCount() > 1){
      Ext.MessageBox.confirm('Confirmation','Do you want to delete multiple scores ?', deleteScores);
    } else {
      Ext.MessageBox.alert('Hari bol','You haven\'t selected any score?');
    }
   }

  Ext.onReady(function() {
    
    reloadAjaxParams();    
    // Initalize
    Ext.QuickTips.init();
  
     // Define the Datastore for Listing
    DataStore = new Ext.data.Store({
        id: 'DataStore',
        proxy: new Ext.data.HttpProxy({
                  url: $("#base-url").html() + 'index.php/scores/get_books_scored', 
                  method: 'POST'
              }),
              baseParams:{task: "LISTING"}, // this parameter is passed for any HTTP request
        reader: new Ext.data.JsonReader({
          root: 'results',
          totalProperty: 'total',
          id: 'id'
        },[ 
          {name: 'ID', type: 'int', mapping: 'id'},
          {name: 'BID', type: 'int', mapping: 'bid'},
          {name: 'BookName', type: 'string', mapping: 'name'},
          {name: 'ReportDate', type: 'date', mapping: 'report_date'},
          {name: 'Count', type: 'int', mapping: 'count'}
        ]),
        sortInfo:{field: 'ID', direction: "ASC"}
      });
      
    // Datastore for books  
    BooksListingDataStore = new Ext.data.Store({
       id: 'BooksListingDataStore',
       proxy: new Ext.data.HttpProxy({
                  url: $("#base-url").html() + 'index.php/books/get_books_listing', 
                  method: 'POST'
              }),
              baseParams:{task: "LISTING"}, // this parameter is passed for any HTTP request
        reader: new Ext.data.JsonReader({
          root: 'results',
          totalProperty: 'total',
          id: 'id'
        },
        [ 
          {name: 'ID', type: 'date', mapping: 'id'},
          {name: 'BookName', type: 'string', mapping: 'name'}
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
          header: 'Book Name',
          dataIndex: 'BookName',
          width: 250,
         
          editor: new Ext.form.ComboBox({
            store: BooksListingDataStore,  // or whatever you've called it
            fields: ['ID', 'BookName'],
            displayField:'BookName',         // we have two indexes, ID and Name
            //valueField: 'ID',
            typeAhead: true,
            mode: 'remote',
            editable: false,
            triggerAction: 'all',
            selectOnFocus:true})
        },
        {
  				header: 'Report Date',
  				dataIndex: 'ReportDate',
  				width: 100,
  				renderer: Ext.util.Format.dateRenderer('Y-m-d'),
  				hidden: false,
  				readOnly: true
  		  },
        {
          header: "Count",
          dataIndex: 'Count',
          width: 100,
          readOnly: true,
          editor: new Ext.form.NumberField({
            allowBlank: false,
            decimalSeparator : ',',
            allowDecimals: false,
            allowNegative: false,
            blankText: '0',
            maxLength: 20,
            minValue: 1,
            allowBlank: false
            })         
          
        }
       ]
      );
    ColumnModel.defaultSortable= true;      

    DataStore.load({params: {start: 0, limit: PageSize}});
    BooksListingDataStore.load();      
      
    ListingEditorGrid =  new Ext.grid.EditorGridPanel({
       // width    : 700,
        height   : 500,
        id: 'ListingEditorGrid',
        store: DataStore,     // the datastore is defined here
        cm: ColumnModel,      // the columnmodel is defined here
        enableColLock:false,
        clicksToEdit:1,
        selModel: new Ext.grid.RowSelectionModel({singleSelect:false}) ,
         tbar: [
         {
         text: 'Report Book Score',
	       tooltip: 'Great Tooltip',
         iconCls:'add',    // this is defined in our styles.css
         handler: displayFormWindow
         }, 
         '-',
         {
         text: 'Delete score',
         tooltip: 'Are you sure ?',
         handler: confirmDeleteScores,   // Confirm before deleting
         iconCls:'remove'
         }],
         bbar: new Ext.PagingToolbar({
                pageSize: PageSize,
                store: DataStore,
                displayInfo: true
            })      ,
        renderTo: 'scores-form'

      });
      
    ListingEditorGrid.on('afteredit', saveScore);
    
    // Add Entry
    
    // Define Fields on the Form
    
    AddFormBookField = new Ext.form.ComboBox({
 
     id:'AddFormBookField',
     fieldLabel: 'BookName',
     store: BooksListingDataStore, 
     mode: 'local',
     emptyText: 'Select a book...',
     displayField: 'BookName',
     allowBlank: false,
     editable: false,
     //hiddenName: 'AddFormBookField',
     //valueField: 'id',
     anchor:'95%',
     triggerAction: 'all'
      });
  /*  
    AddFormDateField = new Ext.form.DateField({
    id:'AddFormDateField',
    fieldLabel: 'Distributed On',
    format : 'Y-m-d',
    allowBlank: false,
    anchor:'95%',
    width: 120
    });
  */  
    
    AddFormCountField = new Ext.form.NumberField({
    id:'AddFormCountField',
    fieldLabel: 'Count',
    allowNegative: false,
    allowBlank: false,
    allowDecimals: false,
    anchor:'95%',
    minValue: 1
    });
    
    AddScoreForm = new Ext.FormPanel({
        labelAlign: 'top',
        bodyStyle:'padding:5px',
        width: 600, 
        heigth:300,       
        items: [{
            layout:'column',
            border:false,
            items:[{
                columnWidth:0.5,
                layout: 'form',
                border:false,
                items: [AddFormBookField, AddFormCountField]
            }]
        }],
        buttons: [{
            text: 'Save and Close',
            handler: addBookScore
          },
          {
            text: 'Cancel',
            handler: function(){
            // because of the global vars, we can only 
            // instantiate one window... so let's just hide it.
            AddScoreFormWindow.hide();
          }  
        }]
    });
  
    AddScoreFormWindow= new Ext.Window({
      id: 'CreateWindow',
      title: 'Add a New Score',
      closable:true,
      width: 610,
      height: 250,
      plain:true,
      layout: 'fit',
      items: AddScoreForm
    });
    
    
    
    
  }); // end of OnReady function
  
  
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
     
    
