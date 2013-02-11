<?php /* cDeep-3.1.1 (2.6.16), generated on 2013-01-31 12:44:44
         template file:catalog/jscripts.tpl.php */ ?>
<script>
<?php echo '

function descr(p)
{
  window.open("/catalog/item/"+p+".html", p, \'width=640, height=480, scrollbars=no, toolbar=no, location=no, status=no, resizable=no, screenX=\'+ (screen.width/2 - 320) +\', screenY=\'+ (screen.height/2 - 240) +\'\'); 
  return false;
}



function notifyclose(obj)
{
$(\'.achtung\').achtung(\'close\');
}

function addcart(p,text,mprice,summ)
{


  num = document.getElementById(\'numcart\');
  num.innerHTML = p;
  
  /////////////////////////
  summobj = document.getElementById(\'summ\');
  summ=parseFloat(summ);
  if (summ) summobj.innerHTML=summ;
  
  
  
  setIframeSrc(\'hf\', \'/\');
  
  var achtungCount = 1, exampleBaseSuccess = {
            timeout: 10
        };
  
  
  foo=$.achtung(exampleBaseSuccess, {
            message: \'<div class=grumbleTitle>Корзина пополнена!</div><p>\' + text + \'<br>\'+mprice+\' руб.</p><p>Всего товаров в корзине: \'+ p +\' шт.,<br>на сумму: \'+summ+\' руб.</em></p><div class="cartlinks">&nbsp;&nbsp;&nbsp;<a href="/catalog/cart">оформить заказ</a><p class="closebut" onclick="notifyclose(this)">продолжить покупки</p></div>\'
			
			});

  
}




function setIframeSrc(iframeNode, src) {
  doc = document.getElementById(iframeNode).src = src;
  
  
}

function chclass(elem, first, next, num, delay)
{
  tip = document.getElementById(elem);
  
  if(tip.className == first)
  {
    tip.className = next;
  }
  else
  {
    tip.className = first;
  }

  if(num>0)
  {
    num--;
    setTimeout("chclass(\'"+elem+"\',\'"+first+"\',\'"+next+"\',\'"+num+"\',\'"+delay+"\')", delay);
	
  }
}

function showtip(msg)
{
  tip = document.getElementById(\'ctip\');
  tip.innerHTML = msg;
  tip.className = \'block label\';
  setTimeout("chclass(\'ctip\',\'alabel\',\'label\', 3,100)", 1000);
  setTimeout("tip.className=\'none\';", 3000);
  

}
'; ?>

</script>
<?php echo '
  <script>
    $(document).ready(function(){
        $(".integer").format({precision: 0,allow_negative:false,autofix:true});
        $("input[id^=qty_item_]").bind("keyup", recalc);
        $("input[id^=qty_item_]").bind("OnBlur", recalc);

    });
    function recalc(){
        var id = "#link_" +$(this).attr(\'id\');
        var value = $(this).attr(\'value\');
        var alink = $(id).attr(\'href\');

        if (value < 1){ 
          value = 1; 
        }
        value = "count=" + value; 
        
        var x = alink.indexOf("count=");
        if(x!=-1){
            alink = alink.substr(0, x);    
        }  
             
        alink = alink + value;
        $(id).attr("href", alink);
    }
    
  </script>

'; ?>
 
<div style="display: none;">
<iframe id="hf" name="hf" width="500" height="400" border="0" frameborder="0"></iframe>
</div>