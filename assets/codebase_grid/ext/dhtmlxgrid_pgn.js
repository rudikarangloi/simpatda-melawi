// JavaScript Document
//v.1.6 build 80512

/*
Copyright DHTMLX LTD. http://www.dhtmlx.com
To use this component please contact sales@dhtmlx.com to obtain license
*/

dhtmlXGridObject.prototype.enablePaging = function(fl,pageSize,pagesInGrp,parentObj,showRecInfo,recInfoParentObj){this._pgn_parentObj = typeof(parentObj)=="string" ? document.getElementById(parentObj) : parentObj;this._pgn_recInfoParentObj = typeof(recInfoParentObj)=="string" ? document.getElementById(recInfoParentObj) : recInfoParentObj;this.pagingOn = fl;this.showRecInfo = showRecInfo;this.rowsBufferOutSize = parseInt(pageSize);this.currentPage = 1;this.pagesInGroup = parseInt(pagesInGrp);this._init_pgn_events()
 this.setPagingSkin("default")};dhtmlXGridObject.prototype.setXMLAutoLoading = function(filePath,bufferSize){this.xmlFileUrl = filePath;this._dpref = bufferSize};dhtmlXGridObject.prototype.changePageRelative = function(ind){this.changePage(this.currentPage+ind)};dhtmlXGridObject.prototype.changePage = function(pageNum){if (arguments.length==0)pageNum=this.currentPage||0;pageNum=parseInt(pageNum);pageNum=Math.max(1,Math.min(pageNum,Math.ceil(this.rowsBuffer.length/this.rowsBufferOutSize)));if(!this.callEvent("onBeforePageChanged",[this.currentPage,pageNum]))
 return;this.currentPage = parseInt(pageNum);this._reset_view();this.callEvent("onPageChanged",this.getStateOfView())};dhtmlXGridObject.prototype.setPagingSkin = function(name){this._pgn_skin=this["_pgn_"+name]};dhtmlXGridObject.prototype.setPagingTemplates = function(a,b){this._pgn_templateA=this._pgn_template_compile(a);this._pgn_templateB=this._pgn_template_compile(b);this._page_skin_update()};dhtmlXGridObject.prototype._page_skin_update = function(name){if (!this.pagesInGroup)this.pagesInGroup=Math.ceil(Math.min(5,this.rowsBuffer.length/this.rowsBufferOutSize));var totalPages=Math.ceil(this.rowsBuffer.length/this.rowsBufferOutSize);if (totalPages && totalPages<this.currentPage)return this.changePage(totalPages);if (this.pagingOn && this._pgn_skin)this._pgn_skin.apply(this,this.getStateOfView())};dhtmlXGridObject.prototype._init_pgn_events = function(name){this.attachEvent("onXLE",this._page_skin_update)
 this.attachEvent("onClearAll",this._page_skin_update)
 this.attachEvent("onPageChanged",this._page_skin_update)
 this.attachEvent("onGridReconstructed",this._page_skin_update)
 
 this._init_pgn_events=function(){}};dhtmlXGridObject.prototype._pgn_default=function(page,start,end){if (!this.pagingBlock){this.pagingBlock = document.createElement("DIV");this.pagingBlock.className = "pagingBlock";this.recordInfoBlock = document.createElement("SPAN");this.recordInfoBlock.className = "recordsInfoBlock";if (!this._pgn_parentObj)return;this._pgn_parentObj.appendChild(this.pagingBlock)
 if(this._pgn_recInfoParentObj)this._pgn_recInfoParentObj.appendChild(this.recordInfoBlock)
 
 
 if (!this._pgn_templateA){this._pgn_templateA=this._pgn_template_compile("[prevpages:&lt:&nbsp;] [currentpages:,&nbsp;] [nextpages:&gt:&nbsp;]");this._pgn_templateB=this._pgn_template_compile("Results <b>[from]-[to]</b> of <b>[total]</b>")}};var details=this.getStateOfView();this.pagingBlock.innerHTML = this._pgn_templateA.apply(this,details);this.recordInfoBlock.innerHTML = this._pgn_templateB.apply(this,details);this._pgn_template_active(this.pagingBlock);this._pgn_template_active(this.recordInfoBlock);this.callEvent("onPaging",[])};dhtmlXGridObject.prototype._pgn_block=function(sep){var start=Math.floor((this.currentPage-1)/this.pagesInGroup)*this.pagesInGroup;var max=Math.min(Math.ceil(this.rowsBuffer.length/this.rowsBufferOutSize),start+this.pagesInGroup);var str=[];for (var i=start+1;i<=max;i++)str.push("<a href='#' onclick='this.grid.changePage("+i+")'>"+(i==this.currentPage?("<b>"+i+"</b>"):i)+"<a>");return str.join(sep)};dhtmlXGridObject.prototype._pgn_link=function(mode,ac,ds){if (mode=="prevpages" || mode=="prev"){if (this.currentPage==1)return ds;return '<a href=\'#\' onclick=\'this.grid.changePageRelative(-1*this.grid.pagesInGroup)\'>'+ac+'</a>'
 };if (mode=="nextpages" || mode=="next"){if (this.rowsBuffer.length/this.rowsBufferOutSize <= this.currentPage )return ds;return '<a href=\'#\' onclick=\'this.grid.changePageRelative(this.grid.pagesInGroup)\'>'+ac+'</a>'
 };if (mode=="current"){var i=this.currentPage+(ac?parseInt(ac):0);if (i<1 || Math.ceil(this.rowsBuffer.length/this.rowsBufferOutSize)< i ) return ds;return '<a href=\'#\' '+(i==this.currentPage?"class='dhx_active_page_link' ":"")+'onclick=\'this.grid.changePage('+i+')\'>'+i+'</a>'
 };return ac};dhtmlXGridObject.prototype._pgn_template_active=function(block){var tags=block.getElementsByTagName("A");if (tags)for (var i=0;i < tags.length;i++){tags[i].grid=this}};dhtmlXGridObject.prototype._pgn_template_compile=function(template){template=template.replace(/\[([^\]]*)\]/g,function(a,b){b=b.split(":");switch (b[0]){case "from": 
 return '"+(arguments[1]*1+1)+"';case "total":
 return '"+arguments[3]+"';case "to":
 return '"+arguments[2]+"';case "current":
 case "prev":
 case "next":
 case "prevpages":
 case "nextpages":
 return '"+this._pgn_link(\''+b[0]+'\',\''+b[1]+'\',\''+b[2]+'\')+"'
 case "currentpages":
 return '"+this._pgn_block(\''+b[1]+'\')+"'
 }})
 return new Function('return "'+template+'";')
};dhtmlXGridObject.prototype.i18n.paging={results:"Results",
 records:"Records from ",
 to:" to ",
 page:"Page ",
 perpage:"rows per page",
 first:"To first Page",
 previous:"Previous Page",
 found:"Found records",
 next:"Next Page",
 last:"To last Page",
 of:" of ",
 notfound:"No Records Found"
};dhtmlXGridObject.prototype._pgn_toolbar = function(page, start, end){if (!this.aToolBar)this.aToolBar=this._pgn_createAToolBar();var totalPages=Math.ceil(this.rowsBuffer.length/this.rowsBufferOutSize);if (this._WTDef[2]){this.aToolBar.enableItem("right");this.aToolBar.enableItem("rightabs");this.aToolBar.enableItem("left");this.aToolBar.enableItem("leftabs");if(this.currentPage==totalPages){this.aToolBar.disableItem("right");this.aToolBar.disableItem("rightabs")}else{if(this.currentPage==1){this.aToolBar.disableItem("left");this.aToolBar.disableItem("leftabs")}};var pButton = this.aToolBar.getItem("pages")
 pButton.clearOptions();for(var i=0;i<totalPages;i++){pButton.addOption((i+1),this.i18n.paging.page+(i+1))
 };pButton.setSelected(page.toString())
 };if (this._WTDef[1]){var iButton = this.aToolBar.getItem("results");if (!this.getRowsNum())
 iButton.setText(this.i18n.paging.notfound);else
 iButton.setText(this.i18n.paging.records+(start+1)+this.i18n.paging.to+end)};if (this._WTDef[3])this.aToolBar.getItem("perpagenum").setSelected(this.rowsBufferOutSize.toString())
 
};dhtmlXGridObject.prototype.setPagingWTMode = function(navButtons,navLabel,pageSelect,perPageSelect){this._WTDef=[navButtons,navLabel,pageSelect,perPageSelect]};dhtmlXGridObject.prototype._pgn_createAToolBar = function(){if (!this._WTDef)this.setPagingWTMode(true,true,true,true);this.aToolBar=new dhtmlXToolbarObject(this._pgn_parentObj,'100%',22,"Grid Output");var self=this;var f1=function(val){switch (this.id){case "leftabs":
 self.changePage(1);break;case "left":
 self.changePage(self.currentPage-1);break;case "rightabs":
 self.changePage(99999);break;case "right":
 self.changePage(self.currentPage+1);break;case "perpagenum":
 self.rowsBufferOutSize = val;self.changePage();break;case "pages":
 self.changePage(val);break}};this.aToolBar.showBar();if (this._WTDef[0]){this.aToolBar.addItem(new dhtmlXImageButtonObject(this.imgURL+'ar_left_abs.gif',"18px","18px",f1,'leftabs',this.i18n.paging.first))
 this.aToolBar.addItem(new dhtmlXImageButtonObject(this.imgURL+'ar_left.gif',"18px","18px",f1,'left',this.i18n.paging.previous))
 };if (this._WTDef[1])this.aToolBar.addItem(new dhtmlXImageTextButtonObject(this.imgURL+'results.gif',this.i18n.paging.results,150,18,0,'results',this.i18n.paging.results))
 if (this._WTDef[0]){this.aToolBar.addItem(new dhtmlXImageButtonObject(this.imgURL+'ar_right.gif',"18px","18px",f1,'right',this.i18n.paging.next))
 this.aToolBar.addItem(new dhtmlXImageButtonObject(this.imgURL+'ar_right_abs.gif',"18px","18px",f1,'rightabs',this.i18n.paging.last))
 };if (this._WTDef[2])this.aToolBar.addItem(new dhtmlXSelectButtonObject("pages"," "," ",f1,"120px","18px","toolbar_select"));if (this._WTDef[3])this.aToolBar.addItem(new dhtmlXSelectButtonObject("perpagenum","5,10,15,20,25,30","5"+this.i18n.paging.perpage+",10"+this.i18n.paging.perpage+",15"+this.i18n.paging.perpage+",20"+this.i18n.paging.perpage+",25"+this.i18n.paging.perpage+",30"+this.i18n.paging.perpage+"",f1,"120px","18px","toolbar_select"));this.aToolBar.disableItem("results");return this.aToolBar};dhtmlXGridObject.prototype._pgn_bricks = function(page, start, end){var tmpAr = this.entBox.className.split("_");var sfx = "";var tmp = tmpAr[tmpAr.length-1]
 if(tmpAr.length>1 && (tmp=="light" || tmp=="modern"))
 sfx = "_"+tmp;this.pagerElAr = new Array();this.pagerElAr["pagerCont"] = document.createElement("DIV");this.pagerElAr["pagerBord"] = document.createElement("DIV");this.pagerElAr["pagerLine"] = document.createElement("DIV");this.pagerElAr["pagerBox"] = document.createElement("DIV");this.pagerElAr["pagerInfo"] = document.createElement("DIV");this.pagerElAr["pagerInfoBox"] = document.createElement("DIV");this.pagerElAr["pagerCont"].style.width = this.objBox.offsetWidth;this.pagerElAr["pagerCont"].style.clear = "both";this.pagerElAr["pagerBord"].className = "dhx_pbox"+sfx;this.pagerElAr["pagerLine"].className = "dhx_pline"+sfx;this.pagerElAr["pagerBox"].style.clear = "both";this.pagerElAr["pagerInfo"].className = "dhx_pager_info"+sfx;this.pagerElAr["pagerCont"].appendChild(this.pagerElAr["pagerBord"]);this.pagerElAr["pagerCont"].appendChild(this.pagerElAr["pagerLine"]);this.pagerElAr["pagerCont"].appendChild(this.pagerElAr["pagerInfo"]);this.pagerElAr["pagerLine"].appendChild(this.pagerElAr["pagerBox"]);this.pagerElAr["pagerInfo"].appendChild(this.pagerElAr["pagerInfoBox"]);this._pgn_parentObj.innerHTML = "";this._pgn_parentObj.appendChild(this.pagerElAr["pagerCont"]);if(this.rowsBuffer.length>0){var lineWidth = 20;var lineWidthInc = 22;if(page>this.pagesInGroup){var pageCont = document.createElement("DIV");var pageBox = document.createElement("DIV");pageCont.className = "dhx_page"+sfx;pageBox.innerHTML = "&larr;";pageCont.appendChild(pageBox);this.pagerElAr["pagerBox"].appendChild(pageCont);var self = this;pageCont.pgnum = (Math.ceil(page/this.pagesInGroup)-1)*this.pagesInGroup;pageCont.onclick = function(){self.changePage(this.pgnum)};lineWidth +=lineWidthInc};for(var i=1;i<=this.pagesInGroup;i++){var pageCont = document.createElement("DIV");var pageBox = document.createElement("DIV");pageCont.className = "dhx_page"+sfx;pageNumber = ((Math.ceil(page/this.pagesInGroup)-1)*this.pagesInGroup)+i;if(pageNumber>Math.ceil(this.rowsBuffer.length/this.rowsBufferOutSize))
 break;pageBox.innerHTML = pageNumber;pageCont.appendChild(pageBox);if(page==pageNumber){pageCont.className += " dhx_page_active"+sfx;pageBox.className = "dhx_page_active"+sfx}else{var self = this;pageCont.pgnum = pageNumber;pageCont.onclick = function(){self.changePage(this.pgnum)}};lineWidth +=(parseInt(lineWidthInc/3)*pageNumber.toString().length)+15;pageBox.style.width = (parseInt(lineWidthInc/3)*pageNumber.toString().length)+8+"px";this.pagerElAr["pagerBox"].appendChild(pageCont)};if(Math.ceil(page/this.pagesInGroup)*this.pagesInGroup<Math.ceil(this.rowsBuffer.length/this.rowsBufferOutSize)){var pageCont = document.createElement("DIV");var pageBox = document.createElement("DIV");pageCont.className = "dhx_page"+sfx;pageBox.innerHTML = "&rarr;";pageCont.appendChild(pageBox);this.pagerElAr["pagerBox"].appendChild(pageCont);var self = this;pageCont.pgnum = (Math.ceil(page/this.pagesInGroup)*this.pagesInGroup)+1;pageCont.onclick = function(){self.changePage(this.pgnum)};lineWidth +=lineWidthInc};this.pagerElAr["pagerLine"].style.width = lineWidth+"px"};if(this.rowsBuffer.length>0 && this.showRecInfo==true)this.pagerElAr["pagerInfoBox"].innerHTML = this.i18n.paging.records+(start+1)+this.i18n.paging.to+end+this.i18n.paging.of+this.rowsBuffer.length;else if(this.rowsBuffer.length==0){this.pagerElAr["pagerLine"].parentNode.removeChild(this.pagerElAr["pagerLine"]);this.pagerElAr["pagerInfoBox"].innerHTML = this.i18n.paging.notfound};this.pagerElAr["pagerBox"].appendChild(document.createElement("SPAN")).innerHTML = "&nbsp;";this.pagerElAr["pagerBord"].appendChild(document.createElement("SPAN")).innerHTML = "&nbsp;";this.pagerElAr["pagerCont"].appendChild(document.createElement("SPAN")).innerHTML = "&nbsp;"};
//v.1.6 build 80512

/*
Copyright DHTMLX LTD. http://www.dhtmlx.com
To use this component please contact sales@dhtmlx.com to obtain license
*/