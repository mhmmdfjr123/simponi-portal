!function(e,t){"function"==typeof define&&define.amd?define(["jquery"],t):"object"==typeof exports?module.exports=t(require("jquery")):e.Jquery_facebox=t(e.jQuery)}(this,function(e){!function(e){function t(t,o){this.elem=o,this.settings=e.extend({},e.fn.facebox.defaults,t),this.init()}var o=!1;t.prototype={init:function(){if(o)return!0;o=!0,e(document).trigger("facebox.init"),e("body").append(this.settings.faceboxHtml),e(document).on("close.facebox",function(){e("body").removeClass("facebox-open"),e.facebox.jqXHR&&(e.facebox.jqXHR.abort(),e.facebox.jqXHR=null),e("#facebox-wrapper").fadeOut(function(){e("#facebox .facebox-content").empty()})})},loadFacebox:function(){if(1===e("#facebox .loader").length)return!0;this.setupOverlay(),e("#facebox .facebox-content").empty().append(this.settings.loaderElement),e("#facebox-wrapper").show(),e("#facebox").css({top:n()/6,left:e(window).width()/2-e("#facebox .facebox-content").outerWidth()/2}),e(document).trigger("load.facebox")},revealFacebox:function(t){e(document).trigger("beforeReveal.facebox"),e("#facebox .facebox-content").empty().append(t),e("#facebox").css("left",e(window).width()/2-e("#facebox .facebox-content").outerWidth()/2),e(document).trigger("afterReveal.facebox")},fillFacebox:function(e){if(e.match(/#/)){var t=window.location.href.split("#")[0],o=e.replace(t,"");if("#"===o)return void alert("Something wrong, Check your href value");this.fillFaceboxFromElement(o)}else this.fillFaceboxFromAjax(e)},fillFaceboxFromElement:function(t){this.revealFacebox(e(t).html())},fillFaceboxFromAjax:function(t){var o=this;e.facebox.jqXHR=e.get(t,function(e){o.revealFacebox(e)})},setupOverlay:function(){var t=this;return e("#facebox-wrapper").css("background","rgba(0, 0, 0, "+this.settings.opacity+")").fadeIn(200).animate({scrollTop:0},"fast"),t.settings.modal||e(document).mouseup(function(t){var o=e("#facebox");o.is(t.target)||0!==o.has(t.target).length||e(document).trigger("close.facebox")}),e("body").hasClass("facebox-open")||e("body").addClass("facebox-open"),!1}},e.facebox=function(e){var o=new t;o.loadFacebox(),e.ajax?o.fillFaceboxFromAjax(e.ajax):e.div?o.fillFaceboxFromElement(e.div):o.revealFacebox(e)},e.facebox.confirm=function(o,n,a){a||(a=new t(o,n)),a.loadFacebox();var c=null!=n&&e(n).data("fbox-title")?e(n).data("fbox-title"):a.settings.title,i=null!=n&&e(n).data("fbox-text")?e(n).data("fbox-text"):a.settings.text,f='<div class="fbox-header"><h4>'+c+'</h4></div><div class="fbox-container"><div class="fbox-content">'+i+'</div><div class="fbox-footer"><div class="btn-group">';return e.each(a.settings.button,function(e,t){var o=null==t.href?"#":t.href;f+='<a name="'+e+'" class="facebox-button '+t.class+'" href="'+o+'">'+t.text+"</a>"}),f+="</div></div></div>",a.revealFacebox(f),e("a.facebox-button").on("click",function(t){e.isFunction(a.settings.button[e(this).attr("name")].callback)&&a.settings.button[e(this).attr("name")].callback.call(this,n,a.settings),"#"===e(this).attr("href")&&t.preventDefault()}),n},e.facebox.close=function(){return e(document).trigger("close.facebox"),!1},e.fn.facebox=function(o){var n=this;return n.each(function(){if(0!==e(this).length){var a=new t(o,this);n.on("click.facebox",function(t){"default"===a.settings.type?(a.loadFacebox(),a.fillFacebox(this.href)):"confirm"===a.settings.type?e.facebox.confirm(o,this,a):alert("type = "+a.settings.type+" is unkonown"),t.preventDefault()})}})},e.fn.facebox.defaults={type:"default",opacity:.3,modal:!0,loaderElement:'<div class="loader">Loading...</div>',faceboxHtml:'<div id="facebox-wrapper" style="display:none;"><div id="facebox"><div class="facebox-content"></div></div></div>',title:"",text:"",button:{yes:{text:"Yes",class:"btn btn-primary btn-sm",href:"#",callback:function(e,t){t.onClickYesButton.call(this,e)}},no:{text:"No",class:"btn btn-default btn-sm",href:"#",callback:function(){e.facebox.close()}}},onClickYesButton:function(){}};var n=function(){var e;return self.innerHeight?e=self.innerHeight:document.documentElement&&document.documentElement.clientHeight?e=document.documentElement.clientHeight:document.body&&(e=document.body.clientHeight),e};e(window).resize(function(){e(window).width()>=768&&e("#facebox").css("left",e(window).width()/2-e("#facebox .facebox-content").outerWidth()/2)})}(e)});