<?php /* cDeep-3.1.1 (2.6.16), generated on 2013-01-31 12:44:44
         template file:news/main.tpl.php */ ?>
<?php require_once(cDeep_CORE_DIR . 'core.load_plugins.php');
cDeep_core_load_plugins(array('plugins' => array(array('function', 'loader', 'file:news/main.tpl.php', 1, false),array('function', 'news_viewer', 'file:news/main.tpl.php', 2, false),array('modifier', 'rusdate', 'file:news/main.tpl.php', 12, false),)), $this); ?><?php echo cDeep_function_loader(array('src' => 'news.css','base' => '/css/','type' => 'css'), $this); echo cDeep_function_news_viewer(array('action' => 'ListByTag','max' => 3), $this);?>



			
<div class="leftnews">
				<p class="header">Последние новости</p>
				<div class="leftnewsT">
				<div class="leftnewsB">
					<?php $_from = $this->_tpl_vars['News']['List']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['news'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['news']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['New']):
        $this->_foreach['news']['iteration']++;
?>
					<div class="item">
						<p class="date"><span><?php echo ((is_array($_tmp=$this->_tpl_vars['New']['Date'])) ? $this->_run_mod_handler('rusdate', true, $_tmp, 'd m y') : cDeep_modifier_rusdate($_tmp, 'd m y')); ?>
</span></p>
						<p class="title"><a href="/news/<?php echo $this->_tpl_vars['New']['id']; ?>
.html"><?php echo $this->_tpl_vars['New']['Title']; ?>
</a></p>
						<?php echo $this->_tpl_vars['New']['Description']; ?>

						<a href="/news/<?php echo $this->_tpl_vars['New']['id']; ?>
.html" class="readon">подробнее</a>
					</div>
					<?php endforeach; endif; unset($_from); ?>    
				</div>
				</div>
				<a href="/news/" class="readall">Все новости</a>
</div>			