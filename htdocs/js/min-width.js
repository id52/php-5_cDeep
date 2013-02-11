  window.attachEvent('onload',mmwidth);
  window.attachEvent('onresize',mmwidth);
  function mmwidth(){
    document.getElementById('site').style.width = (((document.documentElement.clientWidth || document.body.clientWidth) < 1005)? "1005px" : "100%");
  };  