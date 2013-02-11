<?php /* cDeep-3.1.1 (2.6.16), generated on 2013-01-31 13:55:22
         template file:sadm/catalog/item/index.tpl.php */ ?>
<?php require_once(cDeep_CORE_DIR . 'core.load_plugins.php');
cDeep_core_load_plugins(array('plugins' => array(array('function', 'loader', 'file:sadm/catalog/item/index.tpl.php', 1, false),array('modifier', 'default', 'file:sadm/catalog/item/index.tpl.php', 39, false),array('modifier', 'catalog', 'file:sadm/catalog/item/index.tpl.php', 39, false),array('modifier', 'htmlall', 'file:sadm/catalog/item/index.tpl.php', 41, false),)), $this); ?><?php echo cDeep_function_loader(array('src' => 'facebox.css,gallery.css','type' => 'css','base' => '/css/admin/','comment' => ''), $this); echo cDeep_function_loader(array('src' => 'facebox/facebox.js','type' => 'js','comment' => 'JQuery'), $this);?>


<script>
<?php echo '
function cdelete(u,t,i)
{
  if(confirm(\'Вы действительно желаете \'+t+\' ?\'))
  {
  	$("#f"+i).fadeOut();
	
	Img = new Image(1,1);
    Img.src = u;
	// при удалении надо бы еще обновлять список каталога и перекидывать на папку родитель (открытую) удялемого объекта
  	//$("#catinfo").loadJFrame(u);
  }
}
$(document).ready(function() {
    $(\'a[rel*=facebox]\').facebox()
});
'; ?>

</script>

<div>
<a href='/sadm/catalog/importer/'>Импорт</a>
<a href='/sadm/catalog/sorting/'>Сортировка</a>
</div>




<?php if ($this->_tpl_vars['State']['Current_item']): ?>
	<?php if ($this->_tpl_vars['Item']['is_group']): ?>
            <div class="buttons">
                <a href="/sadm/catalog/tree/main[].xml" rel="facebox" >
                <img src="/img/icons/news.png" alt="" /> 
                Список товаров на главной
                </a>
            	<a href="/sadm/catalog/add[<?php echo ((is_array($_tmp=@$this->_tpl_vars['Item']['mid'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : cDeep_modifier_default($_tmp, 0)); ?>
].xml" class="positive" ><img src="/img/icons/add.png" alt="" /> Добавить позицию в (<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['Item']['mid'])) ? $this->_run_mod_handler('catalog', true, $_tmp) : cDeep_modifier_catalog($_tmp)))) ? $this->_run_mod_handler('default', true, $_tmp, "корень каталога") : cDeep_modifier_default($_tmp, "корень каталога")); ?>
)</a>
            	<a href="/sadm/catalog/add[<?php echo ((is_array($_tmp=@$this->_tpl_vars['Item']['mid'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : cDeep_modifier_default($_tmp, 0)); ?>
].xml?is_group=1" class="positive" ><img src="/img/icons/add.png" alt="" /> Добавить подгруппу в (<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['Item']['mid'])) ? $this->_run_mod_handler('catalog', true, $_tmp) : cDeep_modifier_catalog($_tmp)))) ? $this->_run_mod_handler('default', true, $_tmp, "корень каталога") : cDeep_modifier_default($_tmp, "корень каталога")); ?>
)</a>
                <a href="javascript: void(0);" class="negative" ><span onclick="return cdelete('/sadm/catalog/remove[<?php echo $this->_tpl_vars['Item']['mid']; ?>
].xml', this.title, <?php echo $this->_tpl_vars['Item']['mid']; ?>
);" title='Удалить <?php echo ((is_array($_tmp=$this->_tpl_vars['Item']['mname'])) ? $this->_run_mod_handler('htmlall', true, $_tmp) : cDeep_modifier_htmlall($_tmp)); ?>
'><img src="/img/icons/delete.png" alt="" /> Удалить эту группу (<?php echo ((is_array($_tmp=$this->_tpl_vars['Item']['mid'])) ? $this->_run_mod_handler('catalog', true, $_tmp) : cDeep_modifier_catalog($_tmp)); ?>
)</span></a> 
    		</div>
	<?php $_cDeep_tpl_vars = $this->_tpl_vars;
$this->_cDeep_include(array('cDeep_include_tpl_file' => "file:sadm/catalog/item/group.tpl.php", 'cDeep_include_vars' => array()));
$this->_tpl_vars = $_cDeep_tpl_vars;
unset($_cDeep_tpl_vars);
 ?>
	<?php elseif (! $this->_tpl_vars['Item']['is_group']): ?>
            <div class="buttons">
                <a href="/sadm/catalog/tree/main[].xml" rel="facebox" >
                <img src="/img/icons/news.png" alt="" /> 
                Список товаров на главной
                </a>
            	<a href="/sadm/catalog/add[<?php echo ((is_array($_tmp=@$this->_tpl_vars['Item']['mgid'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : cDeep_modifier_default($_tmp, 0)); ?>
].xml"  class="positive" ><img src="/img/icons/add.png" alt="" /> Добавить позицию в (<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['Item']['mgid'])) ? $this->_run_mod_handler('catalog', true, $_tmp) : cDeep_modifier_catalog($_tmp)))) ? $this->_run_mod_handler('default', true, $_tmp, "корень каталога") : cDeep_modifier_default($_tmp, "корень каталога")); ?>
)</a>
                <a href="javascript: void(0);" class="negative"><span onclick="return cdelete('/sadm/catalog/remove[<?php echo $this->_tpl_vars['Item']['mid']; ?>
].xml', this.title, <?php echo $this->_tpl_vars['Item']['mid']; ?>
);" title='Удалить <?php echo $this->_tpl_vars['Item']['mname']; ?>
'><img src="/img/icons/delete.png" alt="" /> Удалить эту позицию (<?php echo ((is_array($_tmp=$this->_tpl_vars['Item']['mid'])) ? $this->_run_mod_handler('catalog', true, $_tmp) : cDeep_modifier_catalog($_tmp)); ?>
)</span></a> 
    		</div>		
		<?php $_cDeep_tpl_vars = $this->_tpl_vars;
$this->_cDeep_include(array('cDeep_include_tpl_file' => "file:sadm/catalog/item/item.tpl.php", 'cDeep_include_vars' => array()));
$this->_tpl_vars = $_cDeep_tpl_vars;
unset($_cDeep_tpl_vars);
 ?>
	<?php endif;  else: ?>
        <div class="buttons">
            <a href="/sadm/catalog/tree/main[].xml" rel="facebox" >
            <img src="/img/icons/news.png" alt="" /> 
            Список товаров на главной
            </a>
	       	<a href="/sadm/catalog/add[0].xml?is_group=1" class="positive" >
			<img src="/img/icons/add.png" alt="" /> 
			Добавить подгруппу в корень каталога
			</a>
	    </div>
		
    	<!--iframe src="/tools/price.php" width="400" height="300" frameborder="1" allowtransparency="0" scrolling="no"></iframe-->
		<!--iframe src="/sadm/catalog/importer/uploadprice" width="400" height="300" frameborder="1" allowtransparency="1" scrolling="no"></iframe-->
<?php endif; ?>

<div id="catinfo"></div>