  xinha_editors = null;

  xinha_init    = null;

  xinha_config  = null;

  xinha_plugins = null;

  



  xinha_init = xinha_init ? xinha_init : function()

  {



  

	  xinha_plugins = xinha_plugins ? xinha_plugins :

	  [

	  'ImageManager',

	  'Linker'

	  ];

	  

	  // THIS BIT OF JAVASCRIPT LOADS THE PLUGINS, NO TOUCHING  :)

	  if(!Xinha.loadPlugins(xinha_plugins, xinha_init)) return;

	  

	  xinha_editors = xinha_editors ? xinha_editors :

	  [

	  'txt_descripcion_1','txt_descripcion_2','txt_descripcion_3'

	  ];

	  

	  //,'txt_ubicacion','txt_tipologia','txt_pago','txt_informacion'

	  

	  xinha_config = xinha_config ? xinha_config : new Xinha.Config();

	  

	

	  xinha_config.toolbar =

	  [

	    ["fontname","fontsize","bold","italic","underline","strikethrough","htmlmode"],

		["separator","forecolor","hilitecolor"],

		["separator","subscript","superscript"],

		["linebreak","separator","justifyleft","justifycenter","justifyright","justifyfull"],

		["separator","insertorderedlist","insertunorderedlist","outdent","indent"],

		["separator","inserthorizontalrule","createlink","insertimage","inserttable","separator","killword"]
		


	  ];

	  

	  xinha_config.showLoading = false; //MUESTA EL MENSAJE DE CARGA

	  xinha_config.statusBar = false;

	  xinha_config.stripBaseHref = true;

	  xinha_config.baseHref = "http://www.whitesandresorts.es/";

	  xinha_config.killWordOnPaste  = true;

	  //xinha_config.autofocus=true;

	  xinha_config.pageStyle ='p { margin-top:0px; margin-bottom:0px; }';

	  xinha_config.mozParaHandler = 'built-in';

	 

	  xinha_editors   = Xinha.makeEditors(xinha_editors, xinha_config, xinha_plugins);

	  

	  Xinha.startEditors(xinha_editors);

	

  }

  

  //Xinha._addEvent(window,"load",xinha_init);