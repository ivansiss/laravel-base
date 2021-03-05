/*!
 * AdminLTE v3.1.0-rc (https://adminlte.io)
 * Copyright 2014-2020 Colorlib <https://colorlib.com>
 * Licensed under MIT (https://github.com/ColorlibHQ/AdminLTE/blob/master/LICENSE)
 */
!function(e,t){"object"==typeof exports&&"undefined"!=typeof module?t(exports,require("jquery")):"function"==typeof define&&define.amd?define(["exports","jquery"],t):t((e="undefined"!=typeof globalThis?globalThis:e||self).adminlte={},e.jQuery)}(this,(function(e,t){"use strict";function a(e){return e&&"object"==typeof e&&"default"in e?e:{default:e}}var n=a(t),i="CardRefresh",o="lte.cardrefresh",s=n.default.fn[i],l="card",r='[data-card-widget="card-refresh"]',d={source:"",sourceSelector:"",params:{},trigger:r,content:".card-body",loadInContent:!0,loadOnInit:!0,responseType:"",overlayTemplate:'<div class="overlay"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>',onLoadStart:function(){},onLoadDone:function(e){return e}},f=function(){function e(e,t){if(this._element=e,this._parent=e.parents(".card").first(),this._settings=n.default.extend({},d,t),this._overlay=n.default(this._settings.overlayTemplate),e.hasClass(l)&&(this._parent=e),""===this._settings.source)throw new Error("Source url was not defined. Please specify a url in your CardRefresh source option.")}var t=e.prototype;return t.load=function(){var e=this;this._addOverlay(),this._settings.onLoadStart.call(n.default(this)),n.default.get(this._settings.source,this._settings.params,(function(t){e._settings.loadInContent&&(""!==e._settings.sourceSelector&&(t=n.default(t).find(e._settings.sourceSelector).html()),e._parent.find(e._settings.content).html(t)),e._settings.onLoadDone.call(n.default(e),t),e._removeOverlay()}),""!==this._settings.responseType&&this._settings.responseType),n.default(this._element).trigger(n.default.Event("loaded.lte.cardrefresh"))},t._addOverlay=function(){this._parent.append(this._overlay),n.default(this._element).trigger(n.default.Event("overlay.added.lte.cardrefresh"))},t._removeOverlay=function(){this._parent.find(this._overlay).remove(),n.default(this._element).trigger(n.default.Event("overlay.removed.lte.cardrefresh"))},t._init=function(){var e=this;n.default(this).find(this._settings.trigger).on("click",(function(){e.load()})),this._settings.loadOnInit&&this.load()},e._jQueryInterface=function(t){var a=n.default(this).data(o),i=n.default.extend({},d,n.default(this).data());a||(a=new e(n.default(this),i),n.default(this).data(o,"string"==typeof t?a:t)),"string"==typeof t&&t.match(/load/)?a[t]():a._init(n.default(this))},e}();n.default(document).on("click",r,(function(e){e&&e.preventDefault(),f._jQueryInterface.call(n.default(this),"load")})),n.default((function(){n.default(r).each((function(){f._jQueryInterface.call(n.default(this))}))})),n.default.fn[i]=f._jQueryInterface,n.default.fn[i].Constructor=f,n.default.fn[i].noConflict=function(){return n.default.fn[i]=s,f._jQueryInterface};var u="CardWidget",c="lte.cardwidget",h=n.default.fn[u],g="card",p="collapsed-card",m="collapsing-card",v="expanding-card",_="was-collapsed",b="maximized-card",C='[data-card-widget="remove"]',w='[data-card-widget="collapse"]',y='[data-card-widget="maximize"]',x={animationSpeed:"normal",collapseTrigger:w,removeTrigger:C,maximizeTrigger:y,collapseIcon:"fa-minus",expandIcon:"fa-plus",maximizeIcon:"fa-expand",minimizeIcon:"fa-compress"},I=function(){function e(e,t){this._element=e,this._parent=e.parents(".card").first(),e.hasClass(g)&&(this._parent=e),this._settings=n.default.extend({},x,t)}var t=e.prototype;return t.collapse=function(){var e=this;this._parent.addClass(m).children(".card-body, .card-footer").slideUp(this._settings.animationSpeed,(function(){e._parent.addClass(p).removeClass(m)})),this._parent.find("> .card-header "+this._settings.collapseTrigger+" ."+this._settings.collapseIcon).addClass(this._settings.expandIcon).removeClass(this._settings.collapseIcon),this._element.trigger(n.default.Event("collapsed.lte.cardwidget"),this._parent)},t.expand=function(){var e=this;this._parent.addClass(v).children(".card-body, .card-footer").slideDown(this._settings.animationSpeed,(function(){e._parent.removeClass(p).removeClass(v)})),this._parent.find("> .card-header "+this._settings.collapseTrigger+" ."+this._settings.expandIcon).addClass(this._settings.collapseIcon).removeClass(this._settings.expandIcon),this._element.trigger(n.default.Event("expanded.lte.cardwidget"),this._parent)},t.remove=function(){this._parent.slideUp(),this._element.trigger(n.default.Event("removed.lte.cardwidget"),this._parent)},t.toggle=function(){this._parent.hasClass(p)?this.expand():this.collapse()},t.maximize=function(){this._parent.find(this._settings.maximizeTrigger+" ."+this._settings.maximizeIcon).addClass(this._settings.minimizeIcon).removeClass(this._settings.maximizeIcon),this._parent.css({height:this._parent.height(),width:this._parent.width(),transition:"all .15s"}).delay(150).queue((function(){var e=n.default(this);e.addClass(b),n.default("html").addClass(b),e.hasClass(p)&&e.addClass(_),e.dequeue()})),this._element.trigger(n.default.Event("maximized.lte.cardwidget"),this._parent)},t.minimize=function(){this._parent.find(this._settings.maximizeTrigger+" ."+this._settings.minimizeIcon).addClass(this._settings.maximizeIcon).removeClass(this._settings.minimizeIcon),this._parent.css("cssText","height: "+this._parent[0].style.height+" !important; width: "+this._parent[0].style.width+" !important; transition: all .15s;").delay(10).queue((function(){var e=n.default(this);e.removeClass(b),n.default("html").removeClass(b),e.css({height:"inherit",width:"inherit"}),e.hasClass(_)&&e.removeClass(_),e.dequeue()})),this._element.trigger(n.default.Event("minimized.lte.cardwidget"),this._parent)},t.toggleMaximize=function(){this._parent.hasClass(b)?this.minimize():this.maximize()},t._init=function(e){var t=this;this._parent=e,n.default(this).find(this._settings.collapseTrigger).click((function(){t.toggle()})),n.default(this).find(this._settings.maximizeTrigger).click((function(){t.toggleMaximize()})),n.default(this).find(this._settings.removeTrigger).click((function(){t.remove()}))},e._jQueryInterface=function(t){var a=n.default(this).data(c),i=n.default.extend({},x,n.default(this).data());a||(a=new e(n.default(this),i),n.default(this).data(c,"string"==typeof t?a:t)),"string"==typeof t&&t.match(/collapse|expand|remove|toggle|maximize|minimize|toggleMaximize/)?a[t]():"object"==typeof t&&a._init(n.default(this))},e}();n.default(document).on("click",w,(function(e){e&&e.preventDefault(),I._jQueryInterface.call(n.default(this),"toggle")})),n.default(document).on("click",C,(function(e){e&&e.preventDefault(),I._jQueryInterface.call(n.default(this),"remove")})),n.default(document).on("click",y,(function(e){e&&e.preventDefault(),I._jQueryInterface.call(n.default(this),"toggleMaximize")})),n.default.fn[u]=I._jQueryInterface,n.default.fn[u].Constructor=I,n.default.fn[u].noConflict=function(){return n.default.fn[u]=h,I._jQueryInterface};var T="ControlSidebar",j="lte.controlsidebar",S=n.default.fn[T],Q=".control-sidebar",k=".main-header",H=".main-footer",z="control-sidebar-animate",E="control-sidebar-open",L="control-sidebar-slide-open",A="layout-fixed",F="layout-footer-fixed",R="layout-sm-footer-fixed",D="layout-md-footer-fixed",M="layout-lg-footer-fixed",q="layout-xl-footer-fixed",O={controlsidebarSlide:!0,scrollbarTheme:"os-theme-light",scrollbarAutoHide:"l"},N=function(){function e(e,t){this._element=e,this._config=t,this._init()}var t=e.prototype;return t.collapse=function(){var e=n.default("body"),t=n.default("html");this._config.controlsidebarSlide?(t.addClass(z),e.removeClass(L).delay(300).queue((function(){n.default(Q).hide(),t.removeClass(z),n.default(this).dequeue()}))):e.removeClass(E),n.default(this._element).trigger(n.default.Event("collapsed.lte.controlsidebar"))},t.show=function(){var e=n.default("body"),t=n.default("html");this._config.controlsidebarSlide?(t.addClass(z),n.default(Q).show().delay(10).queue((function(){e.addClass(L).delay(300).queue((function(){t.removeClass(z),n.default(this).dequeue()})),n.default(this).dequeue()}))):e.addClass(E),this._fixHeight(),this._fixScrollHeight(),n.default(this._element).trigger(n.default.Event("expanded.lte.controlsidebar"))},t.toggle=function(){var e=n.default("body");e.hasClass(E)||e.hasClass(L)?this.collapse():this.show()},t._init=function(){var e=this;this._fixHeight(),this._fixScrollHeight(),n.default(window).resize((function(){e._fixHeight(),e._fixScrollHeight()})),n.default(window).scroll((function(){var t=n.default("body");(t.hasClass(E)||t.hasClass(L))&&e._fixScrollHeight()}))},t._fixScrollHeight=function(){var e=n.default("body");if(e.hasClass(A)){var t={scroll:n.default(document).height(),window:n.default(window).height(),header:n.default(k).outerHeight(),footer:n.default(H).outerHeight()},a=Math.abs(t.window+n.default(window).scrollTop()-t.scroll),i=n.default(window).scrollTop(),o=(e.hasClass("layout-navbar-fixed")||e.hasClass("layout-sm-navbar-fixed")||e.hasClass("layout-md-navbar-fixed")||e.hasClass("layout-lg-navbar-fixed")||e.hasClass("layout-xl-navbar-fixed"))&&"fixed"===n.default(k).css("position"),s=(e.hasClass(F)||e.hasClass(R)||e.hasClass(D)||e.hasClass(M)||e.hasClass(q))&&"fixed"===n.default(H).css("position"),l=n.default(Q),r=n.default(".control-sidebar, .control-sidebar .control-sidebar-content");if(0===i&&0===a)l.css({bottom:t.footer,top:t.header}),r.css("height",t.window-(t.header+t.footer));else if(a<=t.footer)if(!1===s){var d=t.header-i;l.css("bottom",t.footer-a).css("top",d>=0?d:0),r.css("height",t.window-(t.footer-a))}else l.css("bottom",t.footer);else i<=t.header?!1===o?(l.css("top",t.header-i),r.css("height",t.window-(t.header-i))):l.css("top",t.header):!1===o?(l.css("top",0),r.css("height",t.window)):l.css("top",t.header)}},t._fixHeight=function(){var e=n.default("body");if(e.hasClass(A)){var t=n.default(window).height(),a=n.default(k).outerHeight(),i=n.default(H).outerHeight(),o=t-a;(e.hasClass(F)||e.hasClass(R)||e.hasClass(D)||e.hasClass(M)||e.hasClass(q))&&"fixed"===n.default(H).css("position")&&(o=t-a-i);var s=n.default(".control-sidebar .control-sidebar-content");s.css("height",o),"undefined"!=typeof n.default.fn.overlayScrollbars&&s.overlayScrollbars({className:this._config.scrollbarTheme,sizeAutoCapable:!0,scrollbars:{autoHide:this._config.scrollbarAutoHide,clickScrolling:!0}})}},e._jQueryInterface=function(t){return this.each((function(){var a=n.default(this).data(j),i=n.default.extend({},O,n.default(this).data());if(a||(a=new e(this,i),n.default(this).data(j,a)),"undefined"===a[t])throw new Error(t+" is not a function");a[t]()}))},e}();n.default(document).on("click",'[data-widget="control-sidebar"]',(function(e){e.preventDefault(),N._jQueryInterface.call(n.default(this),"toggle")})),n.default.fn[T]=N._jQueryInterface,n.default.fn[T].Constructor=N,n.default.fn[T].noConflict=function(){return n.default.fn[T]=S,N._jQueryInterface};var P="DirectChat",B="lte.directchat",U=n.default.fn[P],$=function(){function e(e){this._element=e}return e.prototype.toggle=function(){n.default(this._element).parents(".direct-chat").first().toggleClass("direct-chat-contacts-open"),n.default(this._element).trigger(n.default.Event("toggled.lte.directchat"))},e._jQueryInterface=function(t){return this.each((function(){var a=n.default(this).data(B);a||(a=new e(n.default(this)),n.default(this).data(B,a)),a[t]()}))},e}();n.default(document).on("click",'[data-widget="chat-pane-toggle"]',(function(e){e&&e.preventDefault(),$._jQueryInterface.call(n.default(this),"toggle")})),n.default.fn[P]=$._jQueryInterface,n.default.fn[P].Constructor=$,n.default.fn[P].noConflict=function(){return n.default.fn[P]=U,$._jQueryInterface};var W="Dropdown",G="lte.dropdown",J=n.default.fn[W],K=".dropdown-menu",V={},X=function(){function e(e,t){this._config=t,this._element=e}var t=e.prototype;return t.toggleSubmenu=function(){this._element.siblings().show().toggleClass("show"),this._element.next().hasClass("show")||this._element.parents(K).first().find(".show").removeClass("show").hide(),this._element.parents("li.nav-item.dropdown.show").on("hidden.bs.dropdown",(function(){n.default(".dropdown-submenu .show").removeClass("show").hide()}))},t.fixPosition=function(){var e=n.default(".dropdown-menu.show");if(0!==e.length){e.hasClass("dropdown-menu-right")?e.css({left:"inherit",right:0}):e.css({left:0,right:"inherit"});var t=e.offset(),a=e.width(),i=n.default(window).width()-t.left;t.left<0?e.css({left:"inherit",right:t.left-5}):i<a&&e.css({left:"inherit",right:0})}},e._jQueryInterface=function(t){return this.each((function(){var a=n.default(this).data(G),i=n.default.extend({},V,n.default(this).data());a||(a=new e(n.default(this),i),n.default(this).data(G,a)),"toggleSubmenu"!==t&&"fixPosition"!==t||a[t]()}))},e}();n.default('.dropdown-menu [data-toggle="dropdown"]').on("click",(function(e){e.preventDefault(),e.stopPropagation(),X._jQueryInterface.call(n.default(this),"toggleSubmenu")})),n.default('.navbar [data-toggle="dropdown"]').on("click",(function(e){e.preventDefault(),n.default(e.target).parent().hasClass("dropdown-submenu")||setTimeout((function(){X._jQueryInterface.call(n.default(this),"fixPosition")}),1)})),n.default.fn[W]=X._jQueryInterface,n.default.fn[W].Constructor=X,n.default.fn[W].noConflict=function(){return n.default.fn[W]=J,X._jQueryInterface};var Y="ExpandableTable",Z="lte.expandableTable",ee=n.default.fn[Y],te='[data-widget="expandable-table"]',ae="aria-expanded",ne=function(){function e(e,t){this._options=t,this._element=e}var t=e.prototype;return t.init=function(){n.default(te).each((function(e,t){var a=n.default(t).attr(ae),i=n.default(t).next().children().first().children();"true"===a?i.show():"false"===a&&(i.hide(),i.parent().parent().addClass("d-none"))}))},t.toggleRow=function(){var e=this._element,t=e.attr(ae),a=e.next().children().first().children();a.stop(),"true"===t?(a.slideUp(500,(function(){e.next().addClass("d-none")})),e.attr(ae,"false"),e.trigger(n.default.Event("collapsed.lte.expandableTable"))):"false"===t&&(e.next().removeClass("d-none"),a.slideDown(500),e.attr(ae,"true"),e.trigger(n.default.Event("expanded.lte.expandableTable")))},e._jQueryInterface=function(t){return this.each((function(){var a=n.default(this).data(Z);a||(a=new e(n.default(this)),n.default(this).data(Z,a)),"string"==typeof t&&t.match(/init|toggleRow/)&&a[t]()}))},e}();n.default(".expandable-table").ready((function(){ne._jQueryInterface.call(n.default(this),"init")})),n.default(document).on("click",te,(function(){ne._jQueryInterface.call(n.default(this),"toggleRow")})),n.default.fn[Y]=ne._jQueryInterface,n.default.fn[Y].Constructor=ne,n.default.fn[Y].noConflict=function(){return n.default.fn[Y]=ee,ne._jQueryInterface};var ie="Fullscreen",oe="lte.fullscreen",se=n.default.fn[ie],le='[data-widget="fullscreen"]',re=le+" i",de={minimizeIcon:"fa-compress-arrows-alt",maximizeIcon:"fa-expand-arrows-alt"},fe=function(){function e(e,t){this.element=e,this.options=n.default.extend({},de,t)}var t=e.prototype;return t.toggle=function(){document.fullscreenElement||document.mozFullScreenElement||document.webkitFullscreenElement||document.msFullscreenElement?this.windowed():this.fullscreen()},t.fullscreen=function(){document.documentElement.requestFullscreen?document.documentElement.requestFullscreen():document.documentElement.webkitRequestFullscreen?document.documentElement.webkitRequestFullscreen():document.documentElement.msRequestFullscreen&&document.documentElement.msRequestFullscreen(),n.default(re).removeClass(this.options.maximizeIcon).addClass(this.options.minimizeIcon)},t.windowed=function(){document.exitFullscreen?document.exitFullscreen():document.webkitExitFullscreen?document.webkitExitFullscreen():document.msExitFullscreen&&document.msExitFullscreen(),n.default(re).removeClass(this.options.minimizeIcon).addClass(this.options.maximizeIcon)},e._jQueryInterface=function(t){var a=n.default(this).data(oe);a||(a=n.default(this).data());var i=n.default.extend({},de,"object"==typeof t?t:a),o=new e(n.default(this),i);n.default(this).data(oe,"object"==typeof t?t:a),"string"==typeof t&&t.match(/toggle|fullscreen|windowed/)?o[t]():o.init()},e}();n.default(document).on("click",le,(function(){fe._jQueryInterface.call(n.default(this),"toggle")})),n.default.fn[ie]=fe._jQueryInterface,n.default.fn[ie].Constructor=fe,n.default.fn[ie].noConflict=function(){return n.default.fn[ie]=se,fe._jQueryInterface};var ue="lte.iframe",ce=n.default.fn.IFrame,he='[data-widget="iframe"]',ge='[data-widget="iframe-fullscreen"]',pe=".content-wrapper",me=".content-wrapper iframe",ve='[data-widget="iframe"].iframe-mode .navbar-nav',_e=ve+" .nav-item",be='[data-widget="iframe"].iframe-mode .tab-content',Ce=be+" .tab-empty",we=be+" .tab-loading",ye=".main-sidebar .nav-item > a.nav-link",xe=".main-header .nav-item a.nav-link",Ie=".main-header a.dropdown-item",Te="iframe-mode",je="iframe-mode-fullscreen",Se={onTabClick:function(e){return e},onTabChanged:function(e){return e},onTabCreated:function(e){return e},autoIframeMode:!0,autoItemActive:!0,autoShowNewTab:!0,loadingScreen:!0,useNavbarItems:!0,scrollOffset:40,scrollBehaviorSwap:!1,iconMaximize:"fa-expand",iconMinimize:"fa-compress"},Qe=function(){function e(e,t){this._config=t,this._element=e,this._init()}var t=e.prototype;return t.onTabClick=function(e){this._config.onTabClick(e)},t.onTabChanged=function(e){this._config.onTabChanged(e)},t.onTabCreated=function(e){this._config.onTabCreated(e)},t.createTab=function(e,t,a,i){var o=this,s="panel-"+a+"-"+Math.floor(1e3*Math.random()),l="tab-"+a+"-"+Math.floor(1e3*Math.random()),r='<li class="nav-item" role="presentation"><a class="nav-link" data-toggle="row" id="'+l+'" href="#'+s+'" role="tab" aria-controls="'+s+'" aria-selected="false">'+e+"</a></li>";n.default(ve).append(r);var d='<div class="tab-pane fade" id="'+s+'" role="tabpanel" aria-labelledby="'+l+'"><iframe src="'+t+'"></iframe></div>';if(n.default(be).append(d),i)if(this._config.loadingScreen){var f=n.default(we);f.fadeIn(),n.default(s+" iframe").ready((function(){"number"==typeof o._config.loadingScreen?(o.switchTab("#"+l,o._config.loadingScreen),setTimeout((function(){f.fadeOut()}),o._config.loadingScreen)):(o.switchTab("#"+l,o._config.loadingScreen),f.fadeOut())}))}else this.switchTab("#"+l);this.onTabCreated(n.default("#"+l))},t.openTabSidebar=function(e,t){void 0===t&&(t=this._config.autoShowNewTab);var a=n.default(e).clone();void 0===a.attr("href")&&(a=n.default(e).parent("a").clone()),a.find(".right").remove();var i=a.find("p").text();""===i&&(i=a.text());var o=a.attr("href");"#"!==o&&""!==o&&void 0!==o&&this.createTab(i,o,o.replace(".html","").replace("./","").replaceAll("/","-"),t)},t.switchTab=function(e){var t=n.default(e),a=t.attr("href");n.default(Ce).hide(),n.default(ve+" .active").tab("dispose").removeClass("active"),this._fixHeight(),t.tab("show"),t.parents("li").addClass("active"),this.onTabChanged(t),this._config.autoItemActive&&this._setItemActive(n.default(a+" iframe").attr("src"))},t.removeActiveTab=function(){var e=n.default(_e+".active"),t=e.parent(),a=e.index();if(e.remove(),n.default(".tab-pane.active").remove(),n.default(be).children().length==n.default(Ce+", "+we).length)n.default(Ce).show();else{var i=a-1;this.switchTab(t.children().eq(i).find("a"))}},t.toggleFullscreen=function(){n.default("body").hasClass(je)?(n.default(ge+" i").removeClass(this._config.iconMinimize).addClass(this._config.iconMaximize),n.default("body").removeClass(je),n.default(Ce+", "+we).height("auto"),n.default(pe).height("auto"),n.default(me).height("auto")):(n.default(ge+" i").removeClass(this._config.iconMaximize).addClass(this._config.iconMinimize),n.default("body").addClass(je)),n.default(window).trigger("resize"),this._fixHeight(!0)},t._init=function(){window.frameElement&&this._config.autoIframeMode?n.default("body").addClass(Te):n.default(pe).hasClass(Te)&&(this._setupListeners(),this._fixHeight(!0))},t._navScroll=function(e){var t=n.default(ve).scrollLeft();n.default(ve).animate({scrollLeft:t+e},250,"linear")},t._setupListeners=function(){var e=this;n.default(window).on("resize",(function(){setTimeout((function(){e._fixHeight()}),1)})),n.default(document).on("click",ye,(function(t){t.preventDefault(),e.openTabSidebar(t.target)})),this._config.useNavbarItems&&n.default(document).on("click",xe+", "+Ie,(function(t){t.preventDefault(),e.openTabSidebar(t.target)})),n.default(document).on("click",_e,(function(t){t.preventDefault(),e.onTabClick(t.target),e.switchTab(t.target)})),n.default(document).on("click",'[data-widget="iframe-close"]',(function(t){t.preventDefault(),e.removeActiveTab()})),n.default(document).on("click",ge,(function(t){t.preventDefault(),e.toggleFullscreen()}));var t=!1,a=null;n.default(document).on("mousedown",'[data-widget="iframe-scrollleft"]',(function(n){n.preventDefault(),clearInterval(a);var i=e._config.scrollOffset;e._config.scrollBehaviorSwap||(i=-i),t=!0,e._navScroll(i),a=setInterval((function(){e._navScroll(i)}),250)})),n.default(document).on("mousedown",'[data-widget="iframe-scrollright"]',(function(n){n.preventDefault(),clearInterval(a);var i=e._config.scrollOffset;e._config.scrollBehaviorSwap&&(i=-i),t=!0,e._navScroll(i),a=setInterval((function(){e._navScroll(i)}),250)})),n.default(document).on("mouseup",(function(){t&&(t=!1,clearInterval(a),a=null)}))},t._setItemActive=function(e){n.default(ye+", "+Ie).removeClass("active"),n.default(xe).parent().removeClass("active");var t=n.default(xe+'[href$="'+e+'"]'),a=n.default('.main-header a.dropdown-item[href$="'+e+'"]'),i=n.default(ye+'[href$="'+e+'"]');t.each((function(e,t){n.default(t).parent().addClass("active")})),a.each((function(e,t){n.default(t).addClass("active")})),i.each((function(e,t){n.default(t).addClass("active"),n.default(t).parents(".nav-treeview").prevAll(".nav-link").addClass("active")}))},t._fixHeight=function(e){if(void 0===e&&(e=!1),n.default("body").hasClass(je)){var t=n.default(window).height();n.default(Ce+", "+we).height(t),n.default(pe).height(t),n.default(me).height(t)}else{var a=parseFloat(n.default(pe).css("min-height")),i=n.default('[data-widget="iframe"].iframe-mode .nav').outerHeight();1==e?setTimeout((function(){n.default(Ce+", "+we).height(a-i)}),50):n.default(me).height(a-i)}},e._jQueryInterface=function(t){var a=n.default(this).data(ue),i=n.default.extend({},Se,n.default(this).data());if(a||(a=new e(this,i),n.default(this).data(ue,a)),"string"==typeof t&&t.match(/createTab|openTabSidebar|switchTab|removeActiveTab/)){for(var o,s=arguments.length,l=new Array(s>1?s-1:0),r=1;r<s;r++)l[r-1]=arguments[r];(o=a)[t].apply(o,l)}},e}();n.default(window).on("load",(function(){Qe._jQueryInterface.call(n.default(he))})),n.default.fn.IFrame=Qe._jQueryInterface,n.default.fn.IFrame.Constructor=Qe,n.default.fn.IFrame.noConflict=function(){return n.default.fn.IFrame=ce,Qe._jQueryInterface};var ke="lte.layout",He=n.default.fn.Layout,ze=".main-header",Ee=".main-sidebar",Le=".main-sidebar .sidebar",Ae=".main-footer",Fe="sidebar-focused",Re={scrollbarTheme:"os-theme-light",scrollbarAutoHide:"l",panelAutoHeight:!0,panelAutoHeightMode:"min-height",loginRegisterAutoHeight:!0},De=function(){function e(e,t){this._config=t,this._element=e,this._init()}var t=e.prototype;return t.fixLayoutHeight=function(e){void 0===e&&(e=null);var t=n.default("body"),a=0;(t.hasClass("control-sidebar-slide-open")||t.hasClass("control-sidebar-open")||"control_sidebar"===e)&&(a=n.default(".control-sidebar-content").height());var i={window:n.default(window).height(),header:0!==n.default(ze).length?n.default(ze).outerHeight():0,footer:0!==n.default(Ae).length?n.default(Ae).outerHeight():0,sidebar:0!==n.default(Le).length?n.default(Le).height():0,controlSidebar:a},o=this._max(i),s=this._config.panelAutoHeight;!0===s&&(s=0);var l=n.default(".content-wrapper");!1!==s&&(o===i.controlSidebar?l.css(this._config.panelAutoHeightMode,o+s):o===i.window?l.css(this._config.panelAutoHeightMode,o+s-i.header-i.footer):l.css(this._config.panelAutoHeightMode,o+s-i.header),this._isFooterFixed()&&l.css(this._config.panelAutoHeightMode,parseFloat(l.css(this._config.panelAutoHeightMode))+i.footer)),t.hasClass("layout-fixed")&&(!1!==s&&l.css(this._config.panelAutoHeightMode,o+s-i.header-i.footer),"undefined"!=typeof n.default.fn.overlayScrollbars&&n.default(Le).overlayScrollbars({className:this._config.scrollbarTheme,sizeAutoCapable:!0,scrollbars:{autoHide:this._config.scrollbarAutoHide,clickScrolling:!0}}))},t.fixLoginRegisterHeight=function(){var e=n.default("body"),t=n.default(".login-box, .register-box");if(0===t.length)e.css("height","auto"),n.default("html").css("height","auto");else{var a=t.height();e.css(this._config.panelAutoHeightMode)!==a&&e.css(this._config.panelAutoHeightMode,a)}},t._init=function(){var e=this;this.fixLayoutHeight(),!0===this._config.loginRegisterAutoHeight?this.fixLoginRegisterHeight():this._config.loginRegisterAutoHeight===parseInt(this._config.loginRegisterAutoHeight,10)&&setInterval(this.fixLoginRegisterHeight,this._config.loginRegisterAutoHeight),n.default(Le).on("collapsed.lte.treeview expanded.lte.treeview",(function(){e.fixLayoutHeight()})),n.default('[data-widget="pushmenu"]').on("collapsed.lte.pushmenu shown.lte.pushmenu",(function(){e.fixLayoutHeight()})),n.default('[data-widget="control-sidebar"]').on("collapsed.lte.controlsidebar",(function(){e.fixLayoutHeight()})).on("expanded.lte.controlsidebar",(function(){e.fixLayoutHeight("control_sidebar")})),n.default(window).resize((function(){e.fixLayoutHeight()})),setTimeout((function(){n.default("body.hold-transition").removeClass("hold-transition")}),50)},t._max=function(e){var t=0;return Object.keys(e).forEach((function(a){e[a]>t&&(t=e[a])})),t},t._isFooterFixed=function(){return"fixed"===n.default(Ae).css("position")},e._jQueryInterface=function(t){return void 0===t&&(t=""),this.each((function(){var a=n.default(this).data(ke),i=n.default.extend({},Re,n.default(this).data());a||(a=new e(n.default(this),i),n.default(this).data(ke,a)),"init"===t||""===t?a._init():"fixLayoutHeight"!==t&&"fixLoginRegisterHeight"!==t||a[t]()}))},e}();n.default(window).on("load",(function(){De._jQueryInterface.call(n.default("body"))})),n.default(Le+" a").on("focusin",(function(){n.default(Ee).addClass(Fe)})),n.default(Le+" a").on("focusout",(function(){n.default(Ee).removeClass(Fe)})),n.default.fn.Layout=De._jQueryInterface,n.default.fn.Layout.Constructor=De,n.default.fn.Layout.noConflict=function(){return n.default.fn.Layout=He,De._jQueryInterface};var Me="PushMenu",qe="lte.pushmenu",Oe="."+qe,Ne=n.default.fn[Me],Pe='[data-widget="pushmenu"]',Be="body",Ue="sidebar-collapse",$e="sidebar-open",We="sidebar-is-opening",Ge="sidebar-closed",Je={autoCollapseSize:992,enableRemember:!1,noTransitionAfterReload:!0},Ke=function(){function e(e,t){this._element=e,this._options=n.default.extend({},Je,t),0===n.default("#sidebar-overlay").length&&this._addOverlay(),this._init()}var t=e.prototype;return t.expand=function(){var e=n.default(Be);this._options.autoCollapseSize&&n.default(window).width()<=this._options.autoCollapseSize&&e.addClass($e),e.addClass(We).removeClass("sidebar-collapse sidebar-closed").delay(50).queue((function(){e.removeClass(We),n.default(this).dequeue()})),this._options.enableRemember&&localStorage.setItem("remember"+Oe,$e),n.default(this._element).trigger(n.default.Event("shown.lte.pushmenu"))},t.collapse=function(){var e=n.default(Be);this._options.autoCollapseSize&&n.default(window).width()<=this._options.autoCollapseSize&&e.removeClass($e).addClass(Ge),e.addClass(Ue),this._options.enableRemember&&localStorage.setItem("remember"+Oe,Ue),n.default(this._element).trigger(n.default.Event("collapsed.lte.pushmenu"))},t.toggle=function(){n.default(Be).hasClass(Ue)?this.expand():this.collapse()},t.autoCollapse=function(e){if(void 0===e&&(e=!1),this._options.autoCollapseSize){var t=n.default(Be);n.default(window).width()<=this._options.autoCollapseSize?t.hasClass($e)||this.collapse():!0===e&&(t.hasClass($e)?t.removeClass($e):t.hasClass(Ge)&&this.expand())}},t.remember=function(){if(this._options.enableRemember){var e=n.default("body");localStorage.getItem("remember"+Oe)===Ue?this._options.noTransitionAfterReload?e.addClass("hold-transition").addClass(Ue).delay(50).queue((function(){n.default(this).removeClass("hold-transition"),n.default(this).dequeue()})):e.addClass(Ue):this._options.noTransitionAfterReload?e.addClass("hold-transition").removeClass(Ue).delay(50).queue((function(){n.default(this).removeClass("hold-transition"),n.default(this).dequeue()})):e.removeClass(Ue)}},t._init=function(){var e=this;this.remember(),this.autoCollapse(),n.default(window).resize((function(){e.autoCollapse(!0)}))},t._addOverlay=function(){var e=this,t=n.default("<div />",{id:"sidebar-overlay"});t.on("click",(function(){e.collapse()})),n.default(".wrapper").append(t)},e._jQueryInterface=function(t){return this.each((function(){var a=n.default(this).data(qe),i=n.default.extend({},Je,n.default(this).data());a||(a=new e(this,i),n.default(this).data(qe,a)),"string"==typeof t&&t.match(/collapse|expand|toggle/)&&a[t]()}))},e}();n.default(document).on("click",Pe,(function(e){e.preventDefault();var t=e.currentTarget;"pushmenu"!==n.default(t).data("widget")&&(t=n.default(t).closest(Pe)),Ke._jQueryInterface.call(n.default(t),"toggle")})),n.default(window).on("load",(function(){Ke._jQueryInterface.call(n.default(Pe))})),n.default.fn[Me]=Ke._jQueryInterface,n.default.fn[Me].Constructor=Ke,n.default.fn[Me].noConflict=function(){return n.default.fn[Me]=Ne,Ke._jQueryInterface};var Ve="SidebarSearch",Xe="lte.sidebar-search",Ye=n.default.fn[Ve],Ze="sidebar-search-open",et="fa-search",tt="fa-times",at="sidebar-search-results",nt="list-group",it='[data-widget="sidebar-search"]',ot=it+" .form-control",st=it+" .btn",lt=st+" i",rt=".sidebar-search-results",dt=".sidebar-search-results .list-group",ft={arrowSign:"->",minLength:3,maxResults:7,highlightName:!0,highlightPath:!1,highlightClass:"text-light",notFoundText:"No element found!"},ut=[],ct=function(){function e(e,t){this.element=e,this.options=n.default.extend({},ft,t),this.items=[]}var a=e.prototype;return a.init=function(){var e=this;0!=n.default(it).length&&(0==n.default(it).next(rt).length&&n.default(it).after(n.default("<div />",{class:at})),0==n.default(rt).children(".list-group").length&&n.default(rt).append(n.default("<div />",{class:nt})),this._addNotFound(),n.default(".main-sidebar .nav-sidebar").children().each((function(t,a){e._parseItem(a)})))},a.search=function(){var e=this,t=n.default(ot).val().toLowerCase();if(t.length<this.options.minLength)return n.default(dt).empty(),this._addNotFound(),void this.close();var a=ut.filter((function(e){return e.name.toLowerCase().includes(t)})),i=n.default(a.slice(0,this.options.maxResults));n.default(dt).empty(),0===i.length?this._addNotFound():i.each((function(t,a){n.default(dt).append(e._renderItem(a.name,a.link,a.path))})),this.open()},a.open=function(){n.default(it).parent().addClass(Ze),n.default(lt).removeClass(et).addClass(tt)},a.close=function(){n.default(it).parent().removeClass(Ze),n.default(lt).removeClass(tt).addClass(et)},a.toggle=function(){n.default(it).parent().hasClass(Ze)?this.close():this.open()},a._parseItem=function(e,t){var a=this;if(void 0===t&&(t=[]),!n.default(e).hasClass("nav-header")){var i={},o=n.default(e).clone().find("> .nav-link"),s=n.default(e).clone().find("> .nav-treeview"),l=o.attr("href"),r=o.find("p").children().remove().end().text();if(i.name=this._trimText(r),i.link=l,i.path=t,0===s.length)ut.push(i);else{var d=i.path.concat([i.name]);s.children().each((function(e,t){a._parseItem(t,d)}))}}},a._trimText=function(e){return t.trim(e.replace(/(\r\n|\n|\r)/gm," "))},a._renderItem=function(e,t,a){var i=this;if(a=a.join(" "+this.options.arrowSign+" "),this.options.highlightName||this.options.highlightPath){var o=n.default(ot).val().toLowerCase(),s=new RegExp(o,"gi");this.options.highlightName&&(e=e.replace(s,(function(e){return'<b class="'+i.options.highlightClass+'">'+e+"</b>"}))),this.options.highlightPath&&(a=a.replace(s,(function(e){return'<b class="'+i.options.highlightClass+'">'+e+"</b>"})))}return'<a href="'+t+'" class="list-group-item">\n        <div class="search-title">\n          '+e+'\n        </div>\n        <div class="search-path">\n          '+a+"\n        </div>\n      </a>"},a._addNotFound=function(){n.default(dt).append(this._renderItem(this.options.notFoundText,"#",[]))},e._jQueryInterface=function(t){var a=n.default(this).data(Xe);a||(a=n.default(this).data());var i=n.default.extend({},ft,"object"==typeof t?t:a),o=new e(n.default(this),i);n.default(this).data(Xe,"object"==typeof t?t:a),"string"==typeof t&&t.match(/init|toggle|close|open|search/)?o[t]():o.init()},e}();n.default(document).on("click",st,(function(e){e.preventDefault(),ct._jQueryInterface.call(n.default(it),"toggle")})),n.default(document).on("keyup",ot,(function(e){if(38==e.keyCode)return e.preventDefault(),void n.default(dt).children().last().focus();if(40==e.keyCode)return e.preventDefault(),void n.default(dt).children().first().focus();var t=0;clearTimeout(t),t=setTimeout((function(){ct._jQueryInterface.call(n.default(it),"search")}),100)})),n.default(document).on("keydown",dt,(function(e){var t=n.default(":focus");38==e.keyCode&&(e.preventDefault(),t.is(":first-child")?t.siblings().last().focus():t.prev().focus()),40==e.keyCode&&(e.preventDefault(),t.is(":last-child")?t.siblings().first().focus():t.next().focus())})),n.default(window).on("load",(function(){ct._jQueryInterface.call(n.default(it),"init")})),n.default.fn[Ve]=ct._jQueryInterface,n.default.fn[Ve].Constructor=ct,n.default.fn[Ve].noConflict=function(){return n.default.fn[Ve]=Ye,ct._jQueryInterface};var ht=n.default.fn.Toasts,gt="topRight",pt="topLeft",mt="bottomRight",vt="bottomLeft",_t={position:gt,fixed:!0,autohide:!1,autoremove:!0,delay:1e3,fade:!0,icon:null,image:null,imageAlt:null,imageHeight:"25px",title:null,subtitle:null,close:!0,body:null,class:null},bt=function(){function e(e,t){this._config=t,this._prepareContainer(),n.default("body").trigger(n.default.Event("init.lte.toasts"))}var t=e.prototype;return t.create=function(){var e=n.default('<div class="toast" role="alert" aria-live="assertive" aria-atomic="true"/>');e.data("autohide",this._config.autohide),e.data("animation",this._config.fade),this._config.class&&e.addClass(this._config.class),this._config.delay&&500!=this._config.delay&&e.data("delay",this._config.delay);var t=n.default('<div class="toast-header">');if(null!=this._config.image){var a=n.default("<img />").addClass("rounded mr-2").attr("src",this._config.image).attr("alt",this._config.imageAlt);null!=this._config.imageHeight&&a.height(this._config.imageHeight).width("auto"),t.append(a)}if(null!=this._config.icon&&t.append(n.default("<i />").addClass("mr-2").addClass(this._config.icon)),null!=this._config.title&&t.append(n.default("<strong />").addClass("mr-auto").html(this._config.title)),null!=this._config.subtitle&&t.append(n.default("<small />").html(this._config.subtitle)),1==this._config.close){var i=n.default('<button data-dismiss="toast" />').attr("type","button").addClass("ml-2 mb-1 close").attr("aria-label","Close").append('<span aria-hidden="true">&times;</span>');null==this._config.title&&i.toggleClass("ml-2 ml-auto"),t.append(i)}e.append(t),null!=this._config.body&&e.append(n.default('<div class="toast-body" />').html(this._config.body)),n.default(this._getContainerId()).prepend(e);var o=n.default("body");o.trigger(n.default.Event("created.lte.toasts")),e.toast("show"),this._config.autoremove&&e.on("hidden.bs.toast",(function(){n.default(this).delay(200).remove(),o.trigger(n.default.Event("removed.lte.toasts"))}))},t._getContainerId=function(){return this._config.position==gt?"#toastsContainerTopRight":this._config.position==pt?"#toastsContainerTopLeft":this._config.position==mt?"#toastsContainerBottomRight":this._config.position==vt?"#toastsContainerBottomLeft":void 0},t._prepareContainer=function(){if(0===n.default(this._getContainerId()).length){var e=n.default("<div />").attr("id",this._getContainerId().replace("#",""));this._config.position==gt?e.addClass("toasts-top-right"):this._config.position==pt?e.addClass("toasts-top-left"):this._config.position==mt?e.addClass("toasts-bottom-right"):this._config.position==vt&&e.addClass("toasts-bottom-left"),n.default("body").append(e)}this._config.fixed?n.default(this._getContainerId()).addClass("fixed"):n.default(this._getContainerId()).removeClass("fixed")},e._jQueryInterface=function(t,a){return this.each((function(){var i=n.default.extend({},_t,a),o=new e(n.default(this),i);"create"===t&&o[t]()}))},e}();n.default.fn.Toasts=bt._jQueryInterface,n.default.fn.Toasts.Constructor=bt,n.default.fn.Toasts.noConflict=function(){return n.default.fn.Toasts=ht,bt._jQueryInterface};var Ct="TodoList",wt="lte.todolist",yt=n.default.fn[Ct],xt="done",It={onCheck:function(e){return e},onUnCheck:function(e){return e}},Tt=function(){function e(e,t){this._config=t,this._element=e,this._init()}var t=e.prototype;return t.toggle=function(e){e.parents("li").toggleClass(xt),n.default(e).prop("checked")?this.check(e):this.unCheck(n.default(e))},t.check=function(e){this._config.onCheck.call(e)},t.unCheck=function(e){this._config.onUnCheck.call(e)},t._init=function(){var e=this,t=this._element;t.find("input:checkbox:checked").parents("li").toggleClass(xt),t.on("change","input:checkbox",(function(t){e.toggle(n.default(t.target))}))},e._jQueryInterface=function(t){return this.each((function(){var a=n.default(this).data(wt);a||(a=n.default(this).data());var i=n.default.extend({},It,"object"==typeof t?t:a),o=new e(n.default(this),i);n.default(this).data(wt,"object"==typeof t?t:a),"init"===t&&o[t]()}))},e}();n.default(window).on("load",(function(){Tt._jQueryInterface.call(n.default('[data-widget="todo-list"]'))})),n.default.fn[Ct]=Tt._jQueryInterface,n.default.fn[Ct].Constructor=Tt,n.default.fn[Ct].noConflict=function(){return n.default.fn[Ct]=yt,Tt._jQueryInterface};var jt="Treeview",St="lte.treeview",Qt=n.default.fn[jt],kt=".nav-item",Ht=".nav-treeview",zt=".menu-open",Et='[data-widget="treeview"]',Lt="menu-open",At="menu-is-opening",Ft={trigger:Et+" .nav-link",animationSpeed:300,accordion:!0,expandSidebar:!1,sidebarButtonSelector:'[data-widget="pushmenu"]'},Rt=function(){function e(e,t){this._config=t,this._element=e}var t=e.prototype;return t.init=function(){n.default(".nav-item.menu-open .nav-treeview").css("display","block"),this._setupListeners()},t.expand=function(e,t){var a=this,i=n.default.Event("expanded.lte.treeview");if(this._config.accordion){var o=t.siblings(zt).first(),s=o.find(Ht).first();this.collapse(s,o)}t.addClass(At),e.stop().slideDown(this._config.animationSpeed,(function(){t.addClass(Lt),n.default(a._element).trigger(i)})),this._config.expandSidebar&&this._expandSidebar()},t.collapse=function(e,t){var a=this,i=n.default.Event("collapsed.lte.treeview");t.removeClass("menu-is-opening menu-open"),e.stop().slideUp(this._config.animationSpeed,(function(){n.default(a._element).trigger(i),e.find(".menu-open > .nav-treeview").slideUp(),e.find(zt).removeClass(Lt)}))},t.toggle=function(e){var t=n.default(e.currentTarget),a=t.parent(),i=a.find("> .nav-treeview");if(i.is(Ht)||(a.is(kt)||(i=a.parent().find("> .nav-treeview")),i.is(Ht))){e.preventDefault();var o=t.parents(kt).first();o.hasClass(Lt)?this.collapse(n.default(i),o):this.expand(n.default(i),o)}},t._setupListeners=function(){var e=this,t=void 0!==this._element.attr("id")?"#"+this._element.attr("id"):"";n.default(document).on("click",""+t+this._config.trigger,(function(t){e.toggle(t)}))},t._expandSidebar=function(){n.default("body").hasClass("sidebar-collapse")&&n.default(this._config.sidebarButtonSelector).PushMenu("expand")},e._jQueryInterface=function(t){return this.each((function(){var a=n.default(this).data(St),i=n.default.extend({},Ft,n.default(this).data());a||(a=new e(n.default(this),i),n.default(this).data(St,a)),"init"===t&&a[t]()}))},e}();n.default(window).on("load.lte.treeview",(function(){n.default(Et).each((function(){Rt._jQueryInterface.call(n.default(this),"init")}))})),n.default.fn[jt]=Rt._jQueryInterface,n.default.fn[jt].Constructor=Rt,n.default.fn[jt].noConflict=function(){return n.default.fn[jt]=Qt,Rt._jQueryInterface},e.CardRefresh=f,e.CardWidget=I,e.ControlSidebar=N,e.DirectChat=$,e.Dropdown=X,e.ExpandableTable=ne,e.Fullscreen=fe,e.IFrame=Qe,e.Layout=De,e.PushMenu=Ke,e.SidebarSearch=ct,e.Toasts=bt,e.TodoList=Tt,e.Treeview=Rt,Object.defineProperty(e,"__esModule",{value:!0})}));
//# sourceMappingURL=adminlte.min.js.map
/**
 * AdminLTE Demo Menu
 * ------------------
 * You should not use this file in production.
 * This file is for demo purposes only.
 */

/* eslint-disable camelcase */

(function ($) {
  'use strict'

  var $sidebar = $('.control-sidebar')
  var $container = $('<div />', {
    class: 'p-3 control-sidebar-content'
  })

  $sidebar.append($container)

  var navbar_dark_skins = [
    'navbar-primary',
    'navbar-secondary',
    'navbar-info',
    'navbar-success',
    'navbar-danger',
    'navbar-indigo',
    'navbar-purple',
    'navbar-pink',
    'navbar-navy',
    'navbar-lightblue',
    'navbar-teal',
    'navbar-cyan',
    'navbar-dark',
    'navbar-gray-dark',
    'navbar-gray'
  ]

  var navbar_light_skins = [
    'navbar-light',
    'navbar-warning',
    'navbar-white',
    'navbar-orange'
  ]

  $container.append(
    '<h5>Customize AdminLTE</h5><hr class="mb-2"/>'
  )

  var $no_border_checkbox = $('<input />', {
    type: 'checkbox',
    value: 1,
    checked: $('.main-header').hasClass('border-bottom-0'),
    class: 'mr-1'
  }).on('click', function () {
    if ($(this).is(':checked')) {
      $('.main-header').addClass('border-bottom-0')
    } else {
      $('.main-header').removeClass('border-bottom-0')
    }
  })
  var $no_border_container = $('<div />', { class: 'mb-1' }).append($no_border_checkbox).append('<span>No Navbar border</span>')
  $container.append($no_border_container)

  var $text_sm_body_checkbox = $('<input />', {
    type: 'checkbox',
    value: 1,
    checked: $('body').hasClass('text-sm'),
    class: 'mr-1'
  }).on('click', function () {
    if ($(this).is(':checked')) {
      $('body').addClass('text-sm')
    } else {
      $('body').removeClass('text-sm')
    }
  })
  var $text_sm_body_container = $('<div />', { class: 'mb-1' }).append($text_sm_body_checkbox).append('<span>Body small text</span>')
  $container.append($text_sm_body_container)

  var $text_sm_header_checkbox = $('<input />', {
    type: 'checkbox',
    value: 1,
    checked: $('.main-header').hasClass('text-sm'),
    class: 'mr-1'
  }).on('click', function () {
    if ($(this).is(':checked')) {
      $('.main-header').addClass('text-sm')
    } else {
      $('.main-header').removeClass('text-sm')
    }
  })
  var $text_sm_header_container = $('<div />', { class: 'mb-1' }).append($text_sm_header_checkbox).append('<span>Navbar small text</span>')
  $container.append($text_sm_header_container)

  var $text_sm_sidebar_checkbox = $('<input />', {
    type: 'checkbox',
    value: 1,
    checked: $('.nav-sidebar').hasClass('text-sm'),
    class: 'mr-1'
  }).on('click', function () {
    if ($(this).is(':checked')) {
      $('.nav-sidebar').addClass('text-sm')
    } else {
      $('.nav-sidebar').removeClass('text-sm')
    }
  })
  var $text_sm_sidebar_container = $('<div />', { class: 'mb-1' }).append($text_sm_sidebar_checkbox).append('<span>Sidebar nav small text</span>')
  $container.append($text_sm_sidebar_container)

  var $text_sm_footer_checkbox = $('<input />', {
    type: 'checkbox',
    value: 1,
    checked: $('.main-footer').hasClass('text-sm'),
    class: 'mr-1'
  }).on('click', function () {
    if ($(this).is(':checked')) {
      $('.main-footer').addClass('text-sm')
    } else {
      $('.main-footer').removeClass('text-sm')
    }
  })
  var $text_sm_footer_container = $('<div />', { class: 'mb-1' }).append($text_sm_footer_checkbox).append('<span>Footer small text</span>')
  $container.append($text_sm_footer_container)

  var $flat_sidebar_checkbox = $('<input />', {
    type: 'checkbox',
    value: 1,
    checked: $('.nav-sidebar').hasClass('nav-flat'),
    class: 'mr-1'
  }).on('click', function () {
    if ($(this).is(':checked')) {
      $('.nav-sidebar').addClass('nav-flat')
    } else {
      $('.nav-sidebar').removeClass('nav-flat')
    }
  })
  var $flat_sidebar_container = $('<div />', { class: 'mb-1' }).append($flat_sidebar_checkbox).append('<span>Sidebar nav flat style</span>')
  $container.append($flat_sidebar_container)

  var $legacy_sidebar_checkbox = $('<input />', {
    type: 'checkbox',
    value: 1,
    checked: $('.nav-sidebar').hasClass('nav-legacy'),
    class: 'mr-1'
  }).on('click', function () {
    if ($(this).is(':checked')) {
      $('.nav-sidebar').addClass('nav-legacy')
    } else {
      $('.nav-sidebar').removeClass('nav-legacy')
    }
  })
  var $legacy_sidebar_container = $('<div />', { class: 'mb-1' }).append($legacy_sidebar_checkbox).append('<span>Sidebar nav legacy style</span>')
  $container.append($legacy_sidebar_container)

  var $compact_sidebar_checkbox = $('<input />', {
    type: 'checkbox',
    value: 1,
    checked: $('.nav-sidebar').hasClass('nav-compact'),
    class: 'mr-1'
  }).on('click', function () {
    if ($(this).is(':checked')) {
      $('.nav-sidebar').addClass('nav-compact')
    } else {
      $('.nav-sidebar').removeClass('nav-compact')
    }
  })
  var $compact_sidebar_container = $('<div />', { class: 'mb-1' }).append($compact_sidebar_checkbox).append('<span>Sidebar nav compact</span>')
  $container.append($compact_sidebar_container)

  var $child_indent_sidebar_checkbox = $('<input />', {
    type: 'checkbox',
    value: 1,
    checked: $('.nav-sidebar').hasClass('nav-child-indent'),
    class: 'mr-1'
  }).on('click', function () {
    if ($(this).is(':checked')) {
      $('.nav-sidebar').addClass('nav-child-indent')
    } else {
      $('.nav-sidebar').removeClass('nav-child-indent')
    }
  })
  var $child_indent_sidebar_container = $('<div />', { class: 'mb-1' }).append($child_indent_sidebar_checkbox).append('<span>Sidebar nav child indent</span>')
  $container.append($child_indent_sidebar_container)

  var $child_hide_sidebar_checkbox = $('<input />', {
    type: 'checkbox',
    value: 1,
    checked: $('.nav-sidebar').hasClass('nav-collapse-hide-child'),
    class: 'mr-1'
  }).on('click', function () {
    if ($(this).is(':checked')) {
      $('.nav-sidebar').addClass('nav-collapse-hide-child')
    } else {
      $('.nav-sidebar').removeClass('nav-collapse-hide-child')
    }
  })
  var $child_hide_sidebar_container = $('<div />', { class: 'mb-1' }).append($child_hide_sidebar_checkbox).append('<span>Sidebar nav child hide on collapse</span>')
  $container.append($child_hide_sidebar_container)

  var $no_expand_sidebar_checkbox = $('<input />', {
    type: 'checkbox',
    value: 1,
    checked: $('.main-sidebar').hasClass('sidebar-no-expand'),
    class: 'mr-1'
  }).on('click', function () {
    if ($(this).is(':checked')) {
      $('.main-sidebar').addClass('sidebar-no-expand')
    } else {
      $('.main-sidebar').removeClass('sidebar-no-expand')
    }
  })
  var $no_expand_sidebar_container = $('<div />', { class: 'mb-1' }).append($no_expand_sidebar_checkbox).append('<span>Main Sidebar disable hover/focus auto expand</span>')
  $container.append($no_expand_sidebar_container)

  var $text_sm_brand_checkbox = $('<input />', {
    type: 'checkbox',
    value: 1,
    checked: $('.brand-link').hasClass('text-sm'),
    class: 'mr-1'
  }).on('click', function () {
    if ($(this).is(':checked')) {
      $('.brand-link').addClass('text-sm')
    } else {
      $('.brand-link').removeClass('text-sm')
    }
  })
  var $text_sm_brand_container = $('<div />', { class: 'mb-1' }).append($text_sm_brand_checkbox).append('<span>Brand small text</span>')
  $container.append($text_sm_brand_container)

  var $dark_mode_checkbox = $('<input />', {
    type: 'checkbox',
    value: 1,
    checked: $('body').hasClass('dark-mode'),
    class: 'mr-1'
  }).on('click', function () {
    if ($(this).is(':checked')) {
      $('body').addClass('dark-mode')
    } else {
      $('body').removeClass('dark-mode')
    }
  })
  var $dark_mode_container = $('<div />', { class: 'mb-4' }).append($dark_mode_checkbox).append('<span>Dark Mode</span>')
  $container.append($dark_mode_container)

  $container.append('<h6>Navbar Variants</h6>')

  var $navbar_variants = $('<div />', {
    class: 'd-flex'
  })
  var navbar_all_colors = navbar_dark_skins.concat(navbar_light_skins)
  var $navbar_variants_colors = createSkinBlock(navbar_all_colors, function () {
    var color = $(this).data('color')
    var $main_header = $('.main-header')
    $main_header.removeClass('navbar-dark').removeClass('navbar-light')
    navbar_all_colors.forEach(function (color) {
      $main_header.removeClass(color)
    })

    if (navbar_dark_skins.indexOf(color) > -1) {
      $main_header.addClass('navbar-dark')
    } else {
      $main_header.addClass('navbar-light')
    }

    $main_header.addClass(color)
  })

  $navbar_variants.append($navbar_variants_colors)

  $container.append($navbar_variants)

  var sidebar_colors = [
    'bg-primary',
    'bg-warning',
    'bg-info',
    'bg-danger',
    'bg-success',
    'bg-indigo',
    'bg-lightblue',
    'bg-navy',
    'bg-purple',
    'bg-fuchsia',
    'bg-pink',
    'bg-maroon',
    'bg-orange',
    'bg-lime',
    'bg-teal',
    'bg-olive'
  ]

  var accent_colors = [
    'accent-primary',
    'accent-warning',
    'accent-info',
    'accent-danger',
    'accent-success',
    'accent-indigo',
    'accent-lightblue',
    'accent-navy',
    'accent-purple',
    'accent-fuchsia',
    'accent-pink',
    'accent-maroon',
    'accent-orange',
    'accent-lime',
    'accent-teal',
    'accent-olive'
  ]

  var sidebar_skins = [
    'sidebar-dark-primary',
    'sidebar-dark-warning',
    'sidebar-dark-info',
    'sidebar-dark-danger',
    'sidebar-dark-success',
    'sidebar-dark-indigo',
    'sidebar-dark-lightblue',
    'sidebar-dark-navy',
    'sidebar-dark-purple',
    'sidebar-dark-fuchsia',
    'sidebar-dark-pink',
    'sidebar-dark-maroon',
    'sidebar-dark-orange',
    'sidebar-dark-lime',
    'sidebar-dark-teal',
    'sidebar-dark-olive',
    'sidebar-light-primary',
    'sidebar-light-warning',
    'sidebar-light-info',
    'sidebar-light-danger',
    'sidebar-light-success',
    'sidebar-light-indigo',
    'sidebar-light-lightblue',
    'sidebar-light-navy',
    'sidebar-light-purple',
    'sidebar-light-fuchsia',
    'sidebar-light-pink',
    'sidebar-light-maroon',
    'sidebar-light-orange',
    'sidebar-light-lime',
    'sidebar-light-teal',
    'sidebar-light-olive'
  ]

  $container.append('<h6>Accent Color Variants</h6>')
  var $accent_variants = $('<div />', {
    class: 'd-flex'
  })
  $container.append($accent_variants)
  $container.append(createSkinBlock(accent_colors, function () {
    var color = $(this).data('color')
    var accent_class = color
    var $body = $('body')
    accent_colors.forEach(function (skin) {
      $body.removeClass(skin)
    })

    $body.addClass(accent_class)
  }))

  $container.append('<h6>Dark Sidebar Variants</h6>')
  var $sidebar_variants_dark = $('<div />', {
    class: 'd-flex'
  })
  $container.append($sidebar_variants_dark)
  $container.append(createSkinBlock(sidebar_colors, function () {
    var color = $(this).data('color')
    var sidebar_class = 'sidebar-dark-' + color.replace('bg-', '')
    var $sidebar = $('.main-sidebar')
    sidebar_skins.forEach(function (skin) {
      $sidebar.removeClass(skin)
    })

    $sidebar.addClass(sidebar_class)
  }))

  $container.append('<h6>Light Sidebar Variants</h6>')
  var $sidebar_variants_light = $('<div />', {
    class: 'd-flex'
  })
  $container.append($sidebar_variants_light)
  $container.append(createSkinBlock(sidebar_colors, function () {
    var color = $(this).data('color')
    var sidebar_class = 'sidebar-light-' + color.replace('bg-', '')
    var $sidebar = $('.main-sidebar')
    sidebar_skins.forEach(function (skin) {
      $sidebar.removeClass(skin)
    })

    $sidebar.addClass(sidebar_class)
  }))

  var logo_skins = navbar_all_colors
  $container.append('<h6>Brand Logo Variants</h6>')
  var $logo_variants = $('<div />', {
    class: 'd-flex'
  })
  $container.append($logo_variants)
  var $clear_btn = $('<a />', {
    href: '#'
  }).text('clear').on('click', function (e) {
    e.preventDefault()
    var $logo = $('.brand-link')
    logo_skins.forEach(function (skin) {
      $logo.removeClass(skin)
    })
  })
  $container.append(createSkinBlock(logo_skins, function () {
    var color = $(this).data('color')
    var $logo = $('.brand-link')
    logo_skins.forEach(function (skin) {
      $logo.removeClass(skin)
    })
    $logo.addClass(color)
  }).append($clear_btn))

  function createSkinBlock(colors, callback) {
    var $block = $('<div />', {
      class: 'd-flex flex-wrap mb-3'
    })

    colors.forEach(function (color) {
      var $color = $('<div />', {
        class: (typeof color === 'object' ? color.join(' ') : color).replace('navbar-', 'bg-').replace('accent-', 'bg-') + ' elevation-2'
      })

      $block.append($color)

      $color.data('color', color)

      $color.css({
        width: '40px',
        height: '20px',
        borderRadius: '25px',
        marginRight: 10,
        marginBottom: 10,
        opacity: 0.8,
        cursor: 'pointer'
      })

      $color.hover(function () {
        $(this).css({ opacity: 1 }).removeClass('elevation-2').addClass('elevation-4')
      }, function () {
        $(this).css({ opacity: 0.8 }).removeClass('elevation-4').addClass('elevation-2')
      })

      if (callback) {
        $color.on('click', callback)
      }
    })

    return $block
  }

  $('.product-image-thumb').on('click', function () {
    var image_element = $(this).find('img')
    $('.product-image').prop('src', $(image_element).attr('src'))
    $('.product-image-thumb.active').removeClass('active')
    $(this).addClass('active')
  })
})(jQuery)

/*!
 * bsCustomFileInput v1.3.4 (https://github.com/Johann-S/bs-custom-file-input)
 * Copyright 2018 - 2020 Johann-S <johann.servoire@gmail.com>
 * Licensed under MIT (https://github.com/Johann-S/bs-custom-file-input/blob/master/LICENSE)
 */
!function(e,t){"object"==typeof exports&&"undefined"!=typeof module?module.exports=t():"function"==typeof define&&define.amd?define(t):(e=e||self).bsCustomFileInput=t()}(this,function(){"use strict";var s={CUSTOMFILE:'.custom-file input[type="file"]',CUSTOMFILELABEL:".custom-file-label",FORM:"form",INPUT:"input"},l=function(e){if(0<e.childNodes.length)for(var t=[].slice.call(e.childNodes),n=0;n<t.length;n++){var l=t[n];if(3!==l.nodeType)return l}return e},u=function(e){var t=e.bsCustomFileInput.defaultText,n=e.parentNode.querySelector(s.CUSTOMFILELABEL);n&&(l(n).textContent=t)},n=!!window.File,r=function(e){if(e.hasAttribute("multiple")&&n)return[].slice.call(e.files).map(function(e){return e.name}).join(", ");if(-1===e.value.indexOf("fakepath"))return e.value;var t=e.value.split("\\");return t[t.length-1]};function d(){var e=this.parentNode.querySelector(s.CUSTOMFILELABEL);if(e){var t=l(e),n=r(this);n.length?t.textContent=n:u(this)}}function v(){for(var e=[].slice.call(this.querySelectorAll(s.INPUT)).filter(function(e){return!!e.bsCustomFileInput}),t=0,n=e.length;t<n;t++)u(e[t])}var p="bsCustomFileInput",m="reset",h="change";return{init:function(e,t){void 0===e&&(e=s.CUSTOMFILE),void 0===t&&(t=s.FORM);for(var n,l,r=[].slice.call(document.querySelectorAll(e)),i=[].slice.call(document.querySelectorAll(t)),o=0,u=r.length;o<u;o++){var c=r[o];Object.defineProperty(c,p,{value:{defaultText:(n=void 0,n="",(l=c.parentNode.querySelector(s.CUSTOMFILELABEL))&&(n=l.textContent),n)},writable:!0}),d.call(c),c.addEventListener(h,d)}for(var f=0,a=i.length;f<a;f++)i[f].addEventListener(m,v),Object.defineProperty(i[f],p,{value:!0,writable:!0})},destroy:function(){for(var e=[].slice.call(document.querySelectorAll(s.FORM)).filter(function(e){return!!e.bsCustomFileInput}),t=[].slice.call(document.querySelectorAll(s.INPUT)).filter(function(e){return!!e.bsCustomFileInput}),n=0,l=t.length;n<l;n++){var r=t[n];u(r),r[p]=void 0,r.removeEventListener(h,d)}for(var i=0,o=e.length;i<o;i++)e[i].removeEventListener(m,v),e[i][p]=void 0}}});
//# sourceMappingURL=bs-custom-file-input.min.js.map
