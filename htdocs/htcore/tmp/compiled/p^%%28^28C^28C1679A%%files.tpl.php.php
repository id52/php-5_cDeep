<?php /* cDeep-3.1.1 (2.6.16), generated on 2013-02-06 09:32:42
         template file:sadm/catalog/item/files.tpl.php */ ?>
<?php require_once(cDeep_CORE_DIR . 'core.load_plugins.php');
cDeep_core_load_plugins(array('plugins' => array(array('function', 'loader', 'file:sadm/catalog/item/files.tpl.php', 1, false),array('function', 'a_catalog', 'file:sadm/catalog/item/files.tpl.php', 5, false),)), $this); ?><?php echo cDeep_function_loader(array('src' => 'facebox.css,gallery.css','type' => 'css','base' => '/css/admin/','comment' => ''), $this); echo cDeep_function_loader(array('src' => 'facebox/facebox.js','type' => 'js','comment' => 'JQuery'), $this);?>


<div id="actPhoto" src="#" ></div>
<?php echo cDeep_function_a_catalog(array('action' => 'Files','item' => $this->_tpl_vars['State']['Current_item']), $this);?>

<div id="gallery">
<div class="floats">
<?php $_from = $this->_tpl_vars['Photos']['List']['Files']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['Img']):
?>
    <div class="sortitem" id="photo_<?php echo $this->_tpl_vars['Img']['id']; ?>
">
        <div class="panel">
		<?php if ($this->_tpl_vars['Img']['ext'] == 'jpg'): ?>
            <a href="/upload/catalog/<?php echo $this->_tpl_vars['Img']['src']; ?>
" target="_top" rel="facebox" title="<?php echo $this->_tpl_vars['Img']['Name']; ?>
"><img src="/img/icons/zoom.png" height="16" width="16" alt="Приблизить" /></a>
		<?php endif; ?>
				
			<a href="edit/photo[<?php echo $this->_tpl_vars['Img']['id']; ?>
].xml" rel="facebox" ><img src="/img/icons/picture_edit.png" width="16" height="16" alt="Редактировать <?php echo $this->_tpl_vars['Img']['id']; ?>
"/></a>
			<a href="javascript:void(0);" onclick="<?php echo 'if(confirm(this.title)) { delPhoto(\'';  echo $this->_tpl_vars['Img']['id'];  echo '\'); } return false;'; ?>
" title="Удалить <?php echo $this->_tpl_vars['Img']['id']; ?>
?"><img src="/img/icons/cross.png" width="16" height="16" alt="Удалить <?php echo $this->_tpl_vars['Img']['id']; ?>
"/></a>
        </div>  

        <div class="r">
            <div class="holder">
            <em class="edge"></em>
			<?php if ($this->_tpl_vars['Img']['ext'] == 'jpg'): ?>
				<em class="container"><a href="/upload/catalog/<?php echo $this->_tpl_vars['Img']['src']; ?>
" target="_top" rel="facebox" title="<?php echo $this->_tpl_vars['Img']['Name']; ?>
"><img src="/zoom/100x100/upload/catalog/<?php echo $this->_tpl_vars['Img']['src']; ?>
" alt="jpg"/></a></em>
			<?php endif; ?>
			
			
			<?php if ($this->_tpl_vars['Img']['ext'] == 'flv' || $this->_tpl_vars['Img']['ext'] == 'mp4'): ?>
			<?php if ($this->_tpl_vars['Img']['image']): ?>
					<em class="container"><img src="/zoom/100x100/upload/<?php echo $this->_tpl_vars['Img']['image']; ?>
" alt=""/></em>
				<?php else: ?>
					<em class="container"><img src="/img/flv.jpg" alt=""/></em>
				<?php endif; ?>
			<?php endif; ?>
			
			<?php if ($this->_tpl_vars['Img']['ext'] == 'doc' || $this->_tpl_vars['Img']['ext'] == 'docx' || $this->_tpl_vars['Img']['ext'] == 'odt'): ?>
				<em class="container"><img src="/img/doc.jpg" alt="doc"/></em>
			<?php endif; ?>
			
			<?php if ($this->_tpl_vars['Img']['ext'] == 'xls' || $this->_tpl_vars['Img']['ext'] == 'ods' || $this->_tpl_vars['Img']['ext'] == 'xlsx'): ?>
				<em class="container"><img src="/img/xls.jpg" alt="xls"/></em>
			<?php endif; ?>
			
			<?php if ($this->_tpl_vars['Img']['ext'] == 'pdf'): ?>
				<em class="container"><img src="/img/pdf.jpg" alt="pdf"/></em>
			<?php endif; ?>
            </div>
        </div>
        <div class="min"><p><?php if ($this->_tpl_vars['Img']['Name']):  echo $this->_tpl_vars['Img']['Name'];  else: ?>Рис.<?php echo $this->_tpl_vars['Img']['id'];  endif; ?></p></div>
    </div><!---->
    
<?php endforeach; endif; unset($_from);  echo '
<SCRIPT type=text/javascript>
function delPhoto(id)
{
    $(\'#photo_\'+id).fadeOut();
        
    Img = new Image(1,1);
    Img.src = "files/remove["+id+"].xml"}
    
 
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
		//$(\'a[rel*=facebox]\').facebox();
    }
);
</SCRIPT> 

'; ?>

</div>
</div>