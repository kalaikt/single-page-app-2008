<?php /* Smarty version 2.6.18, created on 2008-07-31 10:29:05
         compiled from default/news.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'ucfirst', 'default/news.tpl', 12, false),array('modifier', 'date_format', 'default/news.tpl', 12, false),array('modifier', 'replace', 'default/news.tpl', 13, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "default/loader.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
  <tr>
    <td colspan="2" align="left" style="padding-left:30px;"><!--<img src="images/contact.jpg">--></td>
     <td align="left"> &nbsp;<!--<img src="images/new.jpg">--></td>
  </tr>
  <tr>
<td width="52%" class="content pad" valign="top">
<table border="0" cellspacing="0" cellpadding="0">
<?php $_from = $this->_tpl_vars['pu']->getNews('',1); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['news_id'] => $this->_tpl_vars['news']):
?>
  <tr>
    <td scope="col"> <div class="sub_heading" id="news_<?php echo $this->_tpl_vars['news_id']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['news']['title'])) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : smarty_modifier_ucfirst($_tmp)); ?>
 <span class="content"><strong>- <?php echo ((is_array($_tmp=$this->_tpl_vars['news']['added_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m.%d.%y") : smarty_modifier_date_format($_tmp, "%m.%d.%y")); ?>
</strong></span></div><div><br /></div>
 <div class="news_desc"><?php if ($this->_tpl_vars['news']['image']): ?><div class="news_image"><img src="images/<?php echo $this->_tpl_vars['news']['image']; ?>
" alt=""/></div><?php endif; ?><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['news']['description'])) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : smarty_modifier_ucfirst($_tmp)))) ? $this->_run_mod_handler('replace', true, $_tmp, "\n", "<br />") : smarty_modifier_replace($_tmp, "\n", "<br />")); ?>
</div>
 </td>
  </tr>
   <tr>
    <td scope="row">&nbsp;</td>
  </tr>
<?php endforeach; else: ?>
  <tr>
    <td scope="row" class="required">News not found</td>
  </tr>
<?php endif; unset($_from); ?>
 
</table>

 
 </td>
	<td width="3%" valign="top" class="content"><img src="images/line_sep.jpg" alt=""/></td>
	<td width="38%" align="left" valign="top" class="content" style="padding-top:10px;"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "default/whatsnew.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
</tr>
</table>