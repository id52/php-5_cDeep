/*
* jQuery Plugin Name : dirLister
* Version : 1.1
* Release Date : 05/05/2008
*
* By : Simon Pottier
* Right : http://creativecommons.org/licenses/by-nd/2.0/be/
* Site : www.guistalk.com
*/
(function($)
{
  $.fn.dirLister = function(params, callback, folderCallback)
  {

    /********************************
    *******    PARAMETERS    ********
    ********************************/
    var params = $.extend(
    {
      directory: "/",
      webDirectoryPath: "/",
      scriptLocation: "dirlister.php",
      filesIgnored: ".htaccess, .htpasswd, robots.txt",
      onEvent: "click",
      openEasing: null,
      closeEasing: null,
      openSpeed: "normal",
      closeSpeed: "normal",
      multiOpen: true,
      dateFormat: "d/m/y H:i",
      loadText: "загрузка",
      emptyText: "Пусто",
      lang: "ru",
      showDirPath: true,
      dirPathPosi: "top",
      filesLinkFollow: true,
      safeContent: true
    }, params);
      
    /********************************
    *******   APPEND DATA   *********
    ********************************/

    function appendata(selector, directory)
    {
      if (!$(selector).attr("content"))
      {
        $(selector).addClass("wait");
        $.post(params.scriptLocation, {dir: directory, dateformat: params.dateFormat, webpath: params.webDirectoryPath, filesignored: params.filesIgnored, lang: params.lang}, function(data)
        {
          if (params.directory == directory) // FOR THE FIRST LAUNCH
          {
            data!="" ? $(selector).html("").append(data) : $(selector).html("").html("<ul class='dirtree'>"+params.emptyText+"</ul>");
            $(selector).find("ul:hidden").show();
          }
          else
          {
            if (params.safeContent) $(selector).attr("content", data); // WE SAFE CONTENT
            data!="" ? $(selector).removeClass("wait").append(data) : $(selector).removeClass("wait").append("<ul class='dirtree'>"+params.emptyText+"</ul>");
            $(selector).find("ul:hidden").slideDown({ duration: params.openSpeed, easing: params.openEasing });
          }
          onevent(selector);
        });
      }
      else // THERE IS A SAFE CONTENT
      {
        $(selector).append($(selector).attr("content"));
        $(selector).find("ul:hidden").slideDown({ duration: params.openSpeed, easing: params.openEasing });
        onevent(selector);
      }
    }
    
    /********************************
    *********   ON EVENT   **********
    ********************************/

    function onevent(selector)
    {
      $(selector).find("li a").bind(params.onEvent, function()
      {
        if ($(this).parent().hasClass("folder")) $(this).toggleClass("highlight");
        if ($(this).parent().hasClass("close, folder")) // IT'S AN CLOSED FOLDER
        { 
          if(folderCallback) folderCallback($(this).parent().attr("name"));
          
          if (!params.multiOpen) // ALL OTHER FOLDERS MUST BE CLOSED
          {
            $(this).parent().parent().find("ul").slideUp({ duration: params.closeSpeed, easing: params.closeEasing });
            $(this).parent().parent().find("li.open a").removeClass("highlight");
            $(this).parent().parent().find("li.open").removeClass("open").addClass("close");
          }
          
          if (params.showDirPath) // FOR SHOWING THE DIRTREE PATH
          {
            dirtreepath($(this).parent(), "extend");
          }
          $(this).parent().find("ul").remove();
          $(this).parent().removeClass("close").addClass("open");
          
          appendata($(this).parent(), $(this).parent().attr("id"));
          
          return false;
        }
        else if ($(this).parent().hasClass("open, folder")) // IT'S AN OPENED FOLDER
        {
          if (params.showDirPath) // FOR SHOWING THE DIRTREE PATH
          {
            dirtreepath($(this).parent(), "reduce");
          }
          $(this).parent().removeClass("open").addClass("close");
          $(this).parent().find("ul").slideUp({ duration: params.closeSpeed, easing: params.closeEasing });
          return false;
        }
        else // IT'S AN FILE
        {
          if(callback) callback($(this).parent().attr("name"));
          if (!params.filesLinkFollow) return false;
        }
      });
    }
    
    /********************************
    *******   FILETREE PATH   *******
    ********************************/
    
    function dirtreepath(selector, action)
    {
    	//pref = $("#dirtreepath").text();
      if (action == "extend")
      {
        $("#dirtreepath").text(selector.attr("title"));
      }
      else if (action == "reduce")
      {
        //$("#dirtreepath").text(pref.substr(0, pref.length-selector.attr("title").length-1));
      }
    }
    
    /********************************
    *********    LAUNCH    **********
    ********************************/

    this.each(function()
    {
      $(this).html("<ul class='dirtree'><li class='wait'><a href='#'><span class='title'>"+params.loadText+"</span></a></li></ul>");
      appendata($(this), params.directory);
      if (params.showDirPath)  // FOR ADDING THE DIRTREE PATH
      {
        params.dirPathPosi == "bottom" ? $(this).after("<div id='dirtreepath'>Каталог</div>") : $(this).before("<div id='dirtreepath'>Каталог</div>");
      }
    });
  };
})(jQuery)