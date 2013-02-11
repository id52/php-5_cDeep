{literal}
<script language="JavaScript" type="text/javascript">
<!--
// выставляем секунды
var sec=20;
// выставляем минуты
var min=00;

function refresh()
{
  sec--;
  if(sec==-01){sec=59; min=min-1;}
  else{min=min;}
  //if(sec<=9){sec="0" + sec;}
  //time=(min<=9 ? "0" + min : min) + ":" + sec;
  time=sec;
  if(document.getElementById){timer.innerHTML=time;}
  inter=setTimeout("refresh()", 1000);
  // действие, если таймер 00:00
  // в данном случае переход на страницу http://www.sdws.ru/
  if(min=='00' && sec=='00'){sec="00"; clearInterval(inter); window.location='http://www.sdws.ru/';}
}
//-->
</script>
{/literal}
<body OnLoad="refresh();">
<span id="timer"></span>