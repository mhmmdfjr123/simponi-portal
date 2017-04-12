!function(e,t){if("function"==typeof define&&define.amd)define(["module","exports","jquery","px/util","px-bootstrap/tab"],t);else if("undefined"!=typeof exports)t(module,exports,require("jquery"),require("px/util"),require("px-bootstrap/tab"));else{var n={exports:{}};t(n,n.exports,e.jquery,e.util,e.tab),e.pxTabResize=n.exports}}(this,function(e,t,n,o){"use strict";function i(e){return e&&e.__esModule?e:{default:e}}function r(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}Object.defineProperty(t,"__esModule",{value:!0});var s=i(n),a=i(o),u="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e},f=function(){function e(e,t){for(var n=0;n<t.length;n++){var o=t[n];o.enumerable=o.enumerable||!1,o.configurable=!0,"value"in o&&(o.writable=!0),Object.defineProperty(e,o.key,o)}}return function(t,n,o){return n&&e(t.prototype,n),o&&e(t,o),t}}(),l=function(e){var t="pxTabResize",n="px.tab-resize",o=e.fn[t],i={template:'\n<li class="dropdown">\n  <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>\n  <ul class="dropdown-menu"></ul>\n</li>',content:'<span class="tab-resize-icon"></span>'},s={TAB_RESIZE:"tab-resize",TAB_RESIZE_NAV:"tab-resize-nav",SHOW:"show",ACTIVE:"active"},l={NAV_ITEMS:"> li:not(.tab-resize)",NAV_LINK:"> a",DROPDOWN_TOGGLE:"> .dropdown-toggle",DROPDOWN_MENU:"> .dropdown-menu",DROPDOWN_ITEMS:"> li"},d={RESIZE:"resize."+n,CLICK:"click."+n},c=function(){function o(t,n){r(this,o),this.uniqueId=a.default.generateUniqueId(),this.config=this._getConfig(n),this.element=e(t).find("> .nav")[0]||t,a.default.addClass(t,s.TAB_RESIZE_NAV),this.navItem=this._createNavItemElement(),this.navLink=this._getNavLinkElement(),this.dropdown=this._getDropdownElement(),this._setListeners(),this.placeTabs()}return f(o,[{key:"placeTabs",value:function(){this._resetDropdown();var t=e(this.element).find(l.NAV_ITEMS),n=t.length-1,o=t[n],i=o?t[0].offsetTop:0;if(!o||o.offsetTop<=i)return void a.default.removeClass(this.navItem,s.SHOW);for(a.default.addClass(this.navItem,s.SHOW);o&&!(o.offsetTop<=i);)this._moveItemToDropdown(o),o=t[--n]}},{key:"destroy",value:function(){this._unsetListeners(),this._resetDropdown(),e(this.navItem).remove(),a.default.removeClass(this.element,s.TAB_RESIZE_NAV),e(this.element).removeData(n)}},{key:"_createNavItemElement",value:function(){var t=e(this.config.template).addClass(s.TAB_RESIZE)[0];return this.element.insertBefore(t,this.element.firstChild),t}},{key:"_getNavLinkElement",value:function(){return e(this.navItem).find(l.DROPDOWN_TOGGLE).html(this.config.content)[0]}},{key:"_getDropdownElement",value:function(){return e(this.navItem).find(l.DROPDOWN_MENU)[0]}},{key:"_moveItemToDropdown",value:function(t){e(this.dropdown).prepend(t),a.default.hasClass(t,s.ACTIVE)&&(a.default.addClass(this.navItem,s.ACTIVE),this.navLink.innerHTML=e(t).find(l.NAV_LINK)[0].innerHTML)}},{key:"_resetDropdown",value:function(){a.default.removeClass(this.navItem,s.ACTIVE),this.navLink.innerHTML=this.config.content,e(this.element).append(e(this.dropdown).find(l.DROPDOWN_ITEMS))}},{key:"_setListeners",value:function(){var t=this;e(window).on(this.constructor.Event.RESIZE+"."+this.uniqueId,e.proxy(this.placeTabs,this)),e(this.element).on(this.constructor.Event.CLICK,l.NAV_ITEMS+", > ."+s.TAB_RESIZE+" li",function(){return setTimeout(e.proxy(t.placeTabs,t,10))})}},{key:"_unsetListeners",value:function(){e(window).off(this.constructor.Event.RESIZE+"."+this.uniqueId),e(this.element).off("."+n)}},{key:"_getConfig",value:function(t){return e.extend({},this.constructor.Default,t)}}],[{key:"_jQueryInterface",value:function(t){return this.each(function(){var i=e(this).data(n),r="object"===(void 0===t?"undefined":u(t))?t:null;if(i||(i=new o(this,r),e(this).data(n,i)),"string"==typeof t){if(!i[t])throw new Error('No method named "'+t+'"');i[t]()}})}},{key:"Default",get:function(){return i}},{key:"NAME",get:function(){return t}},{key:"DATA_KEY",get:function(){return n}},{key:"Event",get:function(){return d}},{key:"EVENT_KEY",get:function(){return"."+n}}]),o}();return e.fn[t]=c._jQueryInterface,e.fn[t].Constructor=c,e.fn[t].noConflict=function(){return e.fn[t]=o,c._jQueryInterface},c}(s.default);t.default=l,e.exports=t.default});