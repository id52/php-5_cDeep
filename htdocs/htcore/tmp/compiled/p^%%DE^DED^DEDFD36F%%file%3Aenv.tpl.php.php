<?php /* cDeep-3.1.1 (2.6.16), generated on 2013-01-31 12:44:44
         template file:env.tpl.php */ ?>
<?php require_once(cDeep_CORE_DIR . 'core.load_plugins.php');
cDeep_core_load_plugins(array('plugins' => array(array('function', 'address', 'file:env.tpl.php', 3, false),array('block', 'menu', 'file:env.tpl.php', 20, false),)), $this); ?><?php $_cDeep_tpl_vars = $this->_tpl_vars;
$this->_cDeep_include(array('cDeep_include_tpl_file' => "file:_block/header.tpl.php", 'cDeep_include_vars' => array()));
$this->_tpl_vars = $_cDeep_tpl_vars;
unset($_cDeep_tpl_vars);
  $_cDeep_tpl_vars = $this->_tpl_vars;
$this->_cDeep_include(array('cDeep_include_tpl_file' => 'file:catalog/cart.tpl.php', 'cDeep_include_vars' => array()));
$this->_tpl_vars = $_cDeep_tpl_vars;
unset($_cDeep_tpl_vars);
 ?>		
<?php echo cDeep_function_address(array(), $this);?>

<div class="page">
	<div class="header">
	<div class="headerIn clear">
		<div class="logo">
			<a href="/" title=""></a>
		</div>
		<div class="topContacts">
			<?php $_cDeep_tpl_vars = $this->_tpl_vars;
$this->_cDeep_include(array('cDeep_include_tpl_file' => "tpl.page.403", 'cDeep_include_vars' => array()));
$this->_tpl_vars = $_cDeep_tpl_vars;
unset($_cDeep_tpl_vars);
 ?>
		</div>
	</div><!-- /headerIn -->
	</div><!-- /header -->

	    <div class="topmenu">
           		<ul class="clear">
            <li class="<?php if ($this->_tpl_vars['State']['Current']['index'] == "/"): ?>active<?php endif; ?>"><a href="/">Главная</a></li>
            
            <?php $this->_tag_stack[] = array('menu', array('start' => '/','level' => 0,'for' => 'all')); $_block_repeat=true;cDeep_block_menu($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
            <?php unset($this->_sections['m']);
$this->_sections['m']['loop'] = is_array($_loop=$this->_tpl_vars['Menu']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['m']['name'] = 'm';
$this->_sections['m']['show'] = true;
$this->_sections['m']['max'] = $this->_sections['m']['loop'];
$this->_sections['m']['step'] = 1;
$this->_sections['m']['start'] = $this->_sections['m']['step'] > 0 ? 0 : $this->_sections['m']['loop']-1;
if ($this->_sections['m']['show']) {
    $this->_sections['m']['total'] = $this->_sections['m']['loop'];
    if ($this->_sections['m']['total'] == 0)
        $this->_sections['m']['show'] = false;
} else
    $this->_sections['m']['total'] = 0;
if ($this->_sections['m']['show']):

            for ($this->_sections['m']['index'] = $this->_sections['m']['start'], $this->_sections['m']['iteration'] = 1;
                 $this->_sections['m']['iteration'] <= $this->_sections['m']['total'];
                 $this->_sections['m']['index'] += $this->_sections['m']['step'], $this->_sections['m']['iteration']++):
$this->_sections['m']['rownum'] = $this->_sections['m']['iteration'];
$this->_sections['m']['index_prev'] = $this->_sections['m']['index'] - $this->_sections['m']['step'];
$this->_sections['m']['index_next'] = $this->_sections['m']['index'] + $this->_sections['m']['step'];
$this->_sections['m']['first']      = ($this->_sections['m']['iteration'] == 1);
$this->_sections['m']['last']       = ($this->_sections['m']['iteration'] == $this->_sections['m']['total']);
?>
            <li class="<?php if ("/".($this->_tpl_vars['State']['Path']['0']['index']) == $this->_tpl_vars['Menu'][$this->_sections['m']['index']]['link']): ?>active <?php endif; ?>">
				<a  href="<?php echo $this->_tpl_vars['Menu'][$this->_sections['m']['index']]['link']; ?>
"><?php echo $this->_tpl_vars['Menu'][$this->_sections['m']['index']]['title']; ?>
</a>
            
            
            <?php endfor; endif; ?>
            <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo cDeep_block_menu($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    </ul>
    </div>
	
	
	<div class="body clear">
		<?php echo '
		<div class="leftCol">
			<div class="leftSearch">
				<form method="get" action="/catalog/">
				<fieldset >
					<input name=\'search\' type="text" value="в каталоге" id="" size="20" class="search_input" onclick="if(this.value==\'в каталоге\'){this.value=\'\'}" onblur="if(this.value==\'\'){this.value=\'в каталоге\'}" />
					<input type="submit" class="search_but" value="НАЙТИ" />
				</fieldset>
				</form>
			</div>
			'; ?>

			
			
            <?php $_cDeep_tpl_vars = $this->_tpl_vars;
$this->_cDeep_include(array('cDeep_include_tpl_file' => 'file:_block/sidecatalog.tpl.php', 'cDeep_include_vars' => array()));
$this->_tpl_vars = $_cDeep_tpl_vars;
unset($_cDeep_tpl_vars);
 ?>
			<?php $_cDeep_tpl_vars = $this->_tpl_vars;
$this->_cDeep_include(array('cDeep_include_tpl_file' => 'file:news/main.tpl.php', 'cDeep_include_vars' => array()));
$this->_tpl_vars = $_cDeep_tpl_vars;
unset($_cDeep_tpl_vars);
 ?>
			<br>
			<div class="leftnews"> 
			<p class="header">Личный кабинет</p>
			<div class="leftnewsT">
			<div class="leftnewsB" style="padding:20px;">
			<?php $_cDeep_tpl_vars = $this->_tpl_vars;
$this->_cDeep_include(array('cDeep_include_tpl_file' => 'file:passport/authorization.tpl.php', 'cDeep_include_vars' => array()));
$this->_tpl_vars = $_cDeep_tpl_vars;
unset($_cDeep_tpl_vars);
 ?>	
			</div>
			</div>
			</div>
			
			
			
			<div class="leftnews"> 
			<p class="header">Произвольное видео</p>
			<div class="leftnewsT">
			<div class="leftnewsB" style="padding:20px;">
			<?php $_cDeep_tpl_vars = $this->_tpl_vars;
$this->_cDeep_include(array('cDeep_include_tpl_file' => "file:photo/videorandom.tpl.php", 'cDeep_include_vars' => array()));
$this->_tpl_vars = $_cDeep_tpl_vars;
unset($_cDeep_tpl_vars);
 ?>
			</div>
			</div>
			</div>
			
			<div class="leftnews"> 
			<p class="header">Произвольное фото</p>
			<div class="leftnewsT">
			<div class="leftnewsB" style="padding:20px;">
			<?php $_cDeep_tpl_vars = $this->_tpl_vars;
$this->_cDeep_include(array('cDeep_include_tpl_file' => "file:photo/photorandom.tpl.php", 'cDeep_include_vars' => array()));
$this->_tpl_vars = $_cDeep_tpl_vars;
unset($_cDeep_tpl_vars);
 ?>
			</div>
			</div>
			</div>
			<div class="leftnews"> 
			<p class="header">Опрос</p>
			<div class="leftnewsT">
			<div class="leftnewsB" style="padding:20px;">
			<?php $_cDeep_tpl_vars = $this->_tpl_vars;
$this->_cDeep_include(array('cDeep_include_tpl_file' => "file:vote/index.tpl.php", 'cDeep_include_vars' => array()));
$this->_tpl_vars = $_cDeep_tpl_vars;
unset($_cDeep_tpl_vars);
 ?>
			</div>
			</div>
			</div>
			


		</div><!-- /leftCol -->

		<div class="content">
			<?php $_cDeep_tpl_vars = $this->_tpl_vars;
$this->_cDeep_include(array('cDeep_include_tpl_file' => "file:_block/crumbs.tpl.php", 'cDeep_include_vars' => array()));
$this->_tpl_vars = $_cDeep_tpl_vars;
unset($_cDeep_tpl_vars);
 ?>
			<?php if ($this->_tpl_vars['State']['Current']['Topic']): ?><div class="h1"><h1><span><?php echo $this->_tpl_vars['State']['Current']['Topic']; ?>
</span></h1></div><?php endif; ?> 
			<?php $_cDeep_tpl_vars = $this->_tpl_vars;
$this->_cDeep_include(array('cDeep_include_tpl_file' => "file:_block/subnodes.tpl.php", 'cDeep_include_vars' => array()));
$this->_tpl_vars = $_cDeep_tpl_vars;
unset($_cDeep_tpl_vars);
 ?>
			<?php echo $this->_tpl_vars['CONTENT']; ?>


			
		</div><!-- /content -->
		
		<div class="rightCol">
			<div class="newprods">
				<img src="/images/title_new.png" alt="title_new" width="229" height="72" />
				
					<?php $_cDeep_tpl_vars = $this->_tpl_vars;
$this->_cDeep_include(array('cDeep_include_tpl_file' => "file:catalog/main.tpl.php", 'cDeep_include_vars' => array()));
$this->_tpl_vars = $_cDeep_tpl_vars;
unset($_cDeep_tpl_vars);
 ?>
				
			</div>
		</div><!-- /rightCol -->
	</div><!-- /body -->
	<?php $_cDeep_tpl_vars = $this->_tpl_vars;
$this->_cDeep_include(array('cDeep_include_tpl_file' => "file:_block/footer.tpl.php", 'cDeep_include_vars' => array()));
$this->_tpl_vars = $_cDeep_tpl_vars;
unset($_cDeep_tpl_vars);
 ?>