/*
 ### jQuery FCKEditor Plugin v1.22 - 2008-07-31 ###
 * http://www.fyneworks.com/ - diego@fyneworks.com
 * Dual licensed under the MIT and GPL licenses:
 *   http://www.opensource.org/licenses/mit-license.php
 *   http://www.gnu.org/licenses/gpl.html
 ###
 Project: http://jquery.com/plugins/project/FCKEditor/
 Website: http://www.fyneworks.com/jquery/FCKEditor/
*/
/*
 USAGE: $('textarea').fck({ path:'/path/to/fck/editor/' }); // initialize FCK editor
 ADVANCED USAGE: $.fck.update(); // update value in textareas of each FCK editor instance
*/

/*# AVOID COLLISIONS #*/
;if(window.jQuery) (function($){
/*# AVOID COLLISIONS #*/

$.extend($, {
 fck:{
  waitFor: 10,// in seconds, how long should we wait for the script to load?
  config: { Config: {} }, // default configuration
  path: '/tools/fckeditor/', // default path to FCKEditor directory
  editors: [], // array of editor instances
  loaded: false, // flag indicating whether FCK script is loaded
  intercepted: null, // variable to store intercepted method(s)
  
  // utility method to read contents of FCK editor
  content: function(i, v){
   try{
    var x = FCKeditorAPI.GetInstance(i);
    if(v) x.SetHTML(v);
    return x.GetXHTML(true);
   }catch(e){ return ''; };
  }, // fck.content function
  
  // inspired by Sebasti�n Barrozo <sbarrozo@b-soft.com.ar>
  setHTML: function(i, v){
   if(typeof i=='object'){
    v = i.html;
    i = i.InstanceName || i.instance;
   };
   return $.fck.content(i, v);
  },
  
  // utility method to update textarea contents before ajax submission
  update: function(){
   // Update contents of all instances
   var e = $.fck.editors;
   for(var i=0;i<e.length;i++){
    var ta = e[i].textarea;
    var ht = $.fck.content(e[i].InstanceName);
    ta.val(ht).filter('textarea').text(ht);
    if(ht!=ta.val())
     alert('Critical error in FCK plugin:'+'\n'+'Unable to update form data');
   }
  }, // fck.update
  
  // utility method to non-existing instances from memory
  clean: function(){
      var a = $.fck.editors, b = {}, c = [];
      $.each(a, function(){ if($('#'+this.InstanceName).length>0) b[this.InstanceName] = this; });
      $.each(b, function(){ c[c.length] = this; });
      $.fck.editors = c;
  }, // fck.clean
  
  // utility method to create instances of FCK editor (if any)
  create: function(option){
      // Create a new options object
   var o = $.extend({}/* new object */, $.fck.config || {}, option || {});
   // Normalize plugin options
   $.extend(o, {
    selector: (o.selector || 'textarea.fck, textarea.fckeditor'),
    BasePath: (o.path || o.BasePath || $.fck.path)
   });
   // Find fck.editor-instance 'wannabes'
   var e = $(o.e);
   if(!e.length>0) e = $(o.selector);
   if(!e.length>0) return;
      // Accept settings from metadata plugin
      o = $.extend({}, o,
        ($.meta ? e.data()/*NEW metadata plugin*/ :
        ($.metadata ? e.metadata()/*OLD metadata plugin*/ : 
        null/*metadata plugin not available*/)) || {}
      );
   // Load script and create instances
   if(!$.fck.loading && !$.fck.loaded){
    $.fck.loading = true;
    $.getScript(
     o.BasePath+'fckeditor.js',
     function(){ $.fck.loaded = true; }
    );
   };
   // Start editor
   var start = function(){//e){
    if($.fck.loaded){
     //if(window.console) console.log(['fck.create','start',e,o]);
     $.fck.editor(e,o);
    }
    else{
     //if(window.console) console.log(['fck.create','waiting for script...',e,o]);
     if($.fck.waited<=0){
      alert('jQuery.fckeditor plugin error: The FCKEditor script did not load.');
     }
     else{
      $.fck.waitFor--;
      window.setTimeout(start,1000);
     };
    }
   };
   start(e);
   // Return matched elements...
   return e;
  },
  
  // utility method to integrate this plugin with others...
  intercept: function(){
   if($.fck.intercepted) return;
   // This method intercepts other known methods which
   // require up-to-date code from FCKEditor
   $.fck.intercepted = {
    ajaxSubmit: $.fn.ajaxSubmit || function(){}
   };
   $.fn.ajaxSubmit = function(){
    $.fck.update(); // update html
    return $.fck.intercepted.ajaxSubmit.apply( this, arguments );
   };
  },
  
  // utility method to create an instance of FCK editor
  editor: function(e /* elements */, o /* options */){
   //if(window.console) console.log(['fck.editor','OPTIONS',o]);
   o = $.extend({}, $.fck.config || {}, o || {});
   // Default configuration
   $.extend(o,{
    Width: (o.width || o.Width || '100%'),
    Height: (o.height || o.Height|| '500px'),
    BasePath: (o.path || o.BasePath || $.fck.path),
    ToolbarSet: (o.toolbar || o.ToolbarSet || 'Default'),
    Config: (o.config || o.Config || {})
   });
   // Make sure we have a jQuery object
   e = $(e);
   //if(window.console) console.log(['fck.editor','E',e,o]);
   if(e.size()>0){
    // Local array to store instances
    var a = $.fck.editors;// || [];
    // Go through objects and initialize fck.editor
    e.each(
     function(i,t){
            if((t.tagName||'').toLowerCase()!='textarea')
              return alert(['An invalid parameter has been passed to the $.fckeditor.editor function','tagName:'+t.tagName,'name:'+t.name,'id:'+t.id].join('\n'));
      
      var T = $(t);// t = element, T = jQuery
      if(!t.name) t.name = 'fck'+($.fck.editors.length+1);
      if(!t.id) t.id = t.name;
      if(t.id/* has id */ && !t.fck/* not already installed */){
       var n = a.length;
              // create FCKeditor instance
       a[n] = new FCKeditor(t.name);
              // Apply inline configuration
       $.extend(a[n], o, o.Config || {});
              // Start FCKeditor
       a[n].ReplaceTextarea();
              // Store reference to original element
       a[n].textarea = T;
              // Store reference to FCKeditor in element
       t.fck = a[n];
      };
     }
    );
    // Store instances in global array
    $.fck.editors = a;
        // Remove old non-existing editors from memory
        $.fck.clean();
   };
   // return jQuery array of elements
   return e;
  }, // fck.editor function
  
  // start-up method
  start: function(o/* options */){
   // Attach itself to known plugins...
   $.fck.intercept();
   // Create FCK editors
   return $.fck.create(o);
  } // fck.start
  
 } // fck object
 //##############################
 
});
// extend $
//##############################


$.extend($.fn, {
 fck: function(o){
  //(function(opts){ $.fck.start(opts); })($.extend(o || {}, {e: this}));
  $.fck.start($.extend(o || {}, {e: this}));
 }
});
// extend $.fn
//##############################

/*# AVOID COLLISIONS #*/
})(jQuery);
/*# AVOID COLLISIONS #*/

jQuery(document).ready(function() {
    jQuery(document).find("textarea.getfck").each(function(i) {
            jQuery(this).fck({
	    height: this.style.height?this.style.height:(this.rows*15)
	    });
    } );
} );