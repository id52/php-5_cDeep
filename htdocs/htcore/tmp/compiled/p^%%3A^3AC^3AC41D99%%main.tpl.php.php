<?php /* cDeep-3.1.1 (2.6.16), generated on 2013-02-13 08:35:27
         template file:catalog/main.tpl.php */ ?>
<?php require_once(cDeep_CORE_DIR . 'core.load_plugins.php');
cDeep_core_load_plugins(array('plugins' => array(array('function', 's_catalog', 'file:catalog/main.tpl.php', 34, false),array('modifier', 'default', 'file:catalog/main.tpl.php', 45, false),array('modifier', 'htmlall', 'file:catalog/main.tpl.php', 62, false),)), $this); ?><?php echo '
<script>
var head = document.getElementsByTagName("head")[0];
var link = document.createElement("link");
link.setAttribute("href","/css/notify.css");
link.setAttribute("rel","stylesheet");
head.appendChild(link);




var script = document.createElement("script");
script.setAttribute("src","/css/notify.js");
script.setAttribute("type","text/javascript");
head.appendChild(script);


</script>
'; ?>







<link rel="Stylesheet"  href="/css/notify.css" type="text/css" />
<script type="text/javascript" src="/js/notify.js"></script>
<?php $_cDeep_tpl_vars = $this->_tpl_vars;
$this->_cDeep_include(array('cDeep_include_tpl_file' => 'file:catalog/jscripts.tpl.php', 'cDeep_include_vars' => array()));
$this->_tpl_vars = $_cDeep_tpl_vars;
unset($_cDeep_tpl_vars);
 ?>




                <?php echo cDeep_function_s_catalog(array('action' => 'group','group' => $this->_tpl_vars['State']['Current_item'],'mmid' => 0), $this);?>

		<?php echo cDeep_function_s_catalog(array('action' => 'main'), $this);?>

    
			
		<?php unset($this->_sections['mi']);
$this->_sections['mi']['loop'] = is_array($_loop=$this->_tpl_vars['Groups']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['mi']['name'] = 'mi';
$this->_sections['mi']['show'] = true;
$this->_sections['mi']['max'] = $this->_sections['mi']['loop'];
$this->_sections['mi']['step'] = 1;
$this->_sections['mi']['start'] = $this->_sections['mi']['step'] > 0 ? 0 : $this->_sections['mi']['loop']-1;
if ($this->_sections['mi']['show']) {
    $this->_sections['mi']['total'] = $this->_sections['mi']['loop'];
    if ($this->_sections['mi']['total'] == 0)
        $this->_sections['mi']['show'] = false;
} else
    $this->_sections['mi']['total'] = 0;
if ($this->_sections['mi']['show']):

            for ($this->_sections['mi']['index'] = $this->_sections['mi']['start'], $this->_sections['mi']['iteration'] = 1;
                 $this->_sections['mi']['iteration'] <= $this->_sections['mi']['total'];
                 $this->_sections['mi']['index'] += $this->_sections['mi']['step'], $this->_sections['mi']['iteration']++):
$this->_sections['mi']['rownum'] = $this->_sections['mi']['iteration'];
$this->_sections['mi']['index_prev'] = $this->_sections['mi']['index'] - $this->_sections['mi']['step'];
$this->_sections['mi']['index_next'] = $this->_sections['mi']['index'] + $this->_sections['mi']['step'];
$this->_sections['mi']['first']      = ($this->_sections['mi']['iteration'] == 1);
$this->_sections['mi']['last']       = ($this->_sections['mi']['iteration'] == $this->_sections['mi']['total']);
?>

		
		<?php if ($this->_tpl_vars['Groups'][$this->_sections['mi']['index']]['is_group']): ?>
		<div class="item clear">
		<p class="title"><a href="/catalog/<?php echo $this->_tpl_vars['Groups'][$this->_sections['mi']['index']]['url']; ?>
"><?php echo $this->_tpl_vars['Groups'][$this->_sections['mi']['index']]['mname']; ?>
</a></p>
		<p class="pic">
			<a href="/catalog/<?php echo $this->_tpl_vars['Groups'][$this->_sections['mi']['index']]['url']; ?>
"><img width="163" src="/zoom/163x0/<?php echo ((is_array($_tmp=@$this->_tpl_vars['Groups'][$this->_sections['mi']['index']]['mprewiev'])) ? $this->_run_mod_handler('default', true, $_tmp, '/images/root/nophoto2.jpg') : cDeep_modifier_default($_tmp, '/images/root/nophoto2.jpg')); ?>
"></a>
		</p>
		</div>

		<?php else: ?>
		
		
		
		<div class="item clear">
		<p class="title"><a href="/catalog/<?php echo $this->_tpl_vars['Groups'][$this->_sections['mi']['index']]['url']; ?>
"><?php echo $this->_tpl_vars['Items'][$this->_sections['mi']['index']]['mname']; ?>
</a></p>
		<p class="pic">
			<a href="/catalog/<?php echo $this->_tpl_vars['Groups'][$this->_sections['mi']['index']]['url']; ?>
"><img src="/zoom/163x0/<?php echo ((is_array($_tmp=@$this->_tpl_vars['Items'][$this->_sections['mi']['index']]['mprewiev'])) ? $this->_run_mod_handler('default', true, $_tmp, '/images/root/nophoto.jpg') : cDeep_modifier_default($_tmp, '/images/root/nophoto.jpg')); ?>
" alt="prod_mid" width="163"/></a>
		</p>
		<div class="info2 clear">
		<p class="priceLabel">ЦЕНА:</p>
		<p class="price"><b><?php echo $this->_tpl_vars['Items'][$this->_sections['mi']['index']]['mprice']; ?>
</b> РУБ.</p>
		<a href="/catalog/add/<?php echo $this->_tpl_vars['Groups'][$this->_sections['mi']['index']]['mid']; ?>
.html?<?php echo $this->_tpl_vars['cat_link']; ?>
&count=1" target="hf" id="link_qty_item_<?php echo $this->_sections['mi']['index']; ?>
" 
		title="<?php echo ((is_array($_tmp=$this->_tpl_vars['Groups'][$this->_sections['mi']['index']]['mname'])) ? $this->_run_mod_handler('htmlall', true, $_tmp) : cDeep_modifier_htmlall($_tmp)); ?>
" class="buy"></a>
		</div>
		</div>
		
		
		
		


		


		<?php endif; ?>
		
       <?php endfor; endif; ?>