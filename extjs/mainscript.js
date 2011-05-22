var DataStore;
var ColumnModel;
var ListingEditorGrid;
var ListingWindow;

Ext.onReady(function(){

  Ext.QuickTips.init();

  DataStore = new Ext.data.Store({
      id: 'DataStore',
      proxy: new Ext.data.HttpProxy({
                url: <?php echo base_url();?>'/scores/getjson, 
                method: 'POST'
            }),
            baseParams:{task: "LISTING"}, // this parameter is passed for any HTTP request
      reader: new Ext.data.JsonReader({
        root: 'results',
        totalProperty: 'total',
        id: 'id'
      },[ 
        {name: 'BookName', type: 'string', mapping: 'book_name'},
        {name: 'ReportDate', type: 'date', mapping: 'report_date'},
        {name: 'Count', type: 'int', mapping: 'count'},
      ]),
      sortInfo:{field: 'ReportDate', direction: "DESC"}
    });
    
  ColumnModel = new Ext.grid.ColumnModel(
    [
      {
        header: 'Book Name',
        dataIndex: 'BookName',
        width: 60,
        readOnly: true
      }
      ,
      {
				header: 'Report Date',
				dataIndex: 'ReportDate',
				width: 80,
				renderer: Ext.util.Format.dateRenderer('m/d/Y'),
				hidden: false,
				readOnly: true
		},{
        header: "Count",
        dataIndex: 'Count',
        width: 11,
        readOnly: true,
       editor: new Ext.form.NumberField({
          allowBlank: false,
          decimalSeparator : ',',
          allowDecimals: false,
          allowNegative: false,
          blankText: '0',
          maxLength: 11
          })         
        
      }
     ]
    );
    ColumnModel.defaultSortable= true;
    
    
  ListingWindow = new Ext.Window({
      id: 'ListingWindow',
      title: 'The  of the USA',
      closable:true,
      width:700,
      height:350,
      plain:true,
      layout: 'fit',
      items: ListingEditorGrid
    });
    
    
  ListingEditorGrid =  new Ext.grid.EditorGridPanel({
      id: 'ListingEditorGrid',
      store: DataStore,     // the datastore is defined here
      cm: ColumnModel,      // the columnmodel is defined here
      enableColLock:false,
      clicksToEdit:1,
      selModel: new Ext.grid.RowSelectionModel({singleSelect:false})
    });
    
  ListingWindow = new Ext.Window({
      id: 'ListingWindow',
      title: 'Score Update',
      closable:true,
      width:700,
      height:350,
      plain:true,
      layout: 'fit',
      items: ListingEditorGrid  // We'll just put the grid in for now...
    });  
  
  DataStore.load();
  ListingWindow.show();
  
});