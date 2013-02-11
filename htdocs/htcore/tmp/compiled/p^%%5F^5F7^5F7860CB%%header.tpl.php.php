<?php /* cDeep-3.1.1 (2.6.16), generated on 2013-01-31 12:44:44
         template file:_block/header.tpl.php */ ?>
<?php require_once(cDeep_CORE_DIR . 'core.load_plugins.php');
cDeep_core_load_plugins(array('plugins' => array(array('function', 'address', 'file:_block/header.tpl.php', 5, false),array('function', 'loader', 'file:_block/header.tpl.php', 24, false),)), $this); ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<?php echo cDeep_function_address(array(), $this); if ($this->_tpl_vars['State']['titlemeta']): ?><title><?php echo $this->_tpl_vars['State']['titlemeta']; ?>
 - <?php echo $this->_tpl_vars['titleend']; ?>
</title> <?php endif;  if ($this->_tpl_vars['State']['keywordsmeta']): ?><meta name="Keywords" content="<?php echo $this->_tpl_vars['State']['keywordsmeta']; ?>
"> <?php endif;  if ($this->_tpl_vars['State']['descriptionmeta']): ?><meta name="Description" content="<?php echo $this->_tpl_vars['State']['descriptionmeta']; ?>
"><?php endif; ?>    
<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['State']['Path']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['start'] = (int)-1;
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
if ($this->_sections['i']['start'] < 0)
    $this->_sections['i']['start'] = max($this->_sections['i']['step'] > 0 ? 0 : -1, $this->_sections['i']['loop'] + $this->_sections['i']['start']);
else
    $this->_sections['i']['start'] = min($this->_sections['i']['start'], $this->_sections['i']['step'] > 0 ? $this->_sections['i']['loop'] : $this->_sections['i']['loop']-1);
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = min(ceil(($this->_sections['i']['step'] > 0 ? $this->_sections['i']['loop'] - $this->_sections['i']['start'] : $this->_sections['i']['start']+1)/abs($this->_sections['i']['step'])), $this->_sections['i']['max']);
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
 if (! $this->_tpl_vars['State']['keywordsmeta']): ?><meta name="Keywords" content="<?php echo $this->_tpl_vars['State']['Path'][$this->_sections['i']['index']]['keywordsmeta']; ?>
"><?php endif;  if (! $this->_tpl_vars['State']['descriptionmeta']): ?><meta name="Description" content="<?php echo $this->_tpl_vars['State']['Path'][$this->_sections['i']['index']]['descriptionmeta']; ?>
"><?php endif;  if (! $this->_tpl_vars['State']['titlemeta']): ?><title><?php echo $this->_tpl_vars['State']['Path'][$this->_sections['i']['index']]['titlemeta']; ?>
 - <?php echo $this->_tpl_vars['titleend']; ?>
</title><?php endif;  endfor; endif; ?>
<link rel="Stylesheet"  href="/css/style.css" type="text/css" />
<link rel="Stylesheet"  href="/css/tree.css" type="text/css" />
<link rel="Stylesheet"  href="/css/crumbs.css" type="text/css" />
<link rel="Stylesheet"  href="/css/spiski.css" type="text/css" />
<link rel="Stylesheet"  href="/css/forms.css" type="text/css" />
<link rel="Stylesheet"  href="/css/sorting.css" type="text/css" />

<script type="text/javascript" src="/js/jquery-1.7.2.min.js"></script>


<?php echo cDeep_function_loader(array('action' => 'print'), $this);?>

</head>


		