<?php /* cDeep-3.1.1 (2.6.16), generated on 2013-02-06 09:59:15
         template file:sadm/photo/files.tpl.php */ ?>
<?php require_once(cDeep_CORE_DIR . 'core.load_plugins.php');
cDeep_core_load_plugins(array('plugins' => array(array('function', 'video_manager', 'file:sadm/photo/files.tpl.php', 3, false),)), $this); ?><div id="actPhoto" src="#" ></div>

<?php echo cDeep_function_video_manager(array('action' => 'Files'), $this);?>
  
<div id="gallery">
<div class="floats">
<?php $_from = $this->_tpl_vars['video_manager']['List']['Files']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['Img']):
?>
    <div class="sortitem" id="photo_<?php echo $this->_tpl_vars['Img']['id']; ?>
">
        <div class="panel">
		
		
<?php if ($this->_tpl_vars['Img']['ext'] != 'flv' && $this->_tpl_vars['Img']['ext'] != 'mp4'): ?>
            <a href="/upload/photo/<?php echo $this->_tpl_vars['Img']['src']; ?>
" target="_top" rel="facebox" title="<?php echo $this->_tpl_vars['Photo']['Name']; ?>
"><img src="/img/icons/zoom.png" height="16" width="16" alt="Приблизить" /></a>
<?php endif; ?>
			<a href="edit/photo[<?php echo $this->_tpl_vars['Img']['id']; ?>
].xml" rel="facebox" ><img src="/img/icons/picture_edit.png" width="16" height="16" alt="Редактировать <?php echo $this->_tpl_vars['Img']['id']; ?>
"/></a>
			<a href="javascript:void(0);" onclick="<?php echo 'if(confirm(this.title)) { loadPhoto(\'remove\',\'';  echo $this->_tpl_vars['Img']['id'];  echo '\'); } return false;'; ?>
" title="Удалить <?php echo $this->_tpl_vars['Img']['id']; ?>
?"><img src="/img/icons/cross.png" width="16" height="16" alt="Удалить <?php echo $this->_tpl_vars['Img']['id']; ?>
"/></a>
        </div>  

        <div class="r">
            <div class="holder">
            <em class="edge"></em>
            <em class="container">

			<?php if ($this->_tpl_vars['Img']['ext'] == 'flv' || $this->_tpl_vars['Img']['ext'] == 'mp4'): ?>
				<img src="/zoom/100x100/upload/photo/<?php echo $this->_tpl_vars['Img']['image']; ?>
" alt="video"/>
			<?php else: ?>
				<a href="/upload/photo/<?php echo $this->_tpl_vars['Img']['src']; ?>
" target="_top" rel="facebox" title="<?php echo $this->_tpl_vars['Photo']['Name']; ?>
">
				<img src="/zoom/100x100/upload/photo/<?php echo $this->_tpl_vars['Img']['src']; ?>
" alt="preview"/>
			<?php endif; ?>
			</a></em>
            </div>
        </div>
        <div class="min"><p><?php if ($this->_tpl_vars['Img']['Name']):  echo $this->_tpl_vars['Img']['Name'];  else: ?>Рис.<?php echo $this->_tpl_vars['Img']['id'];  endif; ?></p></div>
    </div><!---->
    
<?php endforeach; endif; unset($_from);  echo '
<SCRIPT type=text/javascript>
        

function loadPhoto(act, p)
{
	$("#actPhoto").loadJFrame(\'files/\' + act + \'[\' + p + \'].xml\');
        
	switch(act)
	{
		case \'remove\':
		    $(\'#photo_\'+p).fadeOut(400);
			break;
	};
        
	return false;
}
</SCRIPT>

<SCRIPT type=text/javascript> 
function chfunct(e,ui)
{
    $("#actPhoto").loadJFrame(\'files/sort[].xml?a&\' + $(\'.floats\').sortable(\'serialize\'));
    
}

$(document).ready(
    function () {
        $(\'.floats\').sortable(
            {
                opacity:        0.8,
                fx:             200,
                revert:         true,
                helper:         "clone",
                tolerance:      "guess",
                items:          ".sortitem",
                update:         function(e,ui) { chfunct(e,ui); }
            }
        );
        $(\'.disabled\').css(\'opacity\', \'0.4\');
    }
    
);
</SCRIPT> 

'; ?>

</div>
</div>