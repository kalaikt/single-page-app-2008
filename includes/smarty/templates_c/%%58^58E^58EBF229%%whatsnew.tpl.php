<?php /* Smarty version 2.6.18, created on 2008-07-31 11:55:30
         compiled from default/whatsnew.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'ucfirst', 'default/whatsnew.tpl', 14, false),array('modifier', 'date_format', 'default/whatsnew.tpl', 14, false),)), $this); ?>
<!--<div class="sub_heading">Write  some "News" type articles up:</div>
<ul>
<ul class="list">
  <li>Held hostage by my own company</li>
  <li>Reduce cycle time, improve responsiveness</li>
  <li>What the heck is PeopleU?</li>
  <li>Outsourcing vs. Insourcing vs. Flexsourcing</li>
  <li>Is augmentation right for me?</li>
</ul>
-->
<table border="0" cellspacing="0" cellpadding="0" width="95%">
<?php $_from = $this->_tpl_vars['pu']->getNews('',1); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['news_id'] => $this->_tpl_vars['news']):
?>
  <tr>
    <td scope="col" style="padding-right:30px;" ><span class="content"><a class="content font_11" href="#news_<?php echo $this->_tpl_vars['news_id']; ?>
"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['news']['title'])) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : smarty_modifier_ucfirst($_tmp)); ?>
</strong></a> - <?php echo ((is_array($_tmp=$this->_tpl_vars['news']['added_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m.%d.%y") : smarty_modifier_date_format($_tmp, "%m.%d.%y")); ?>
</span></td>
  </tr>
  <tr>
  <td class="line_brd" ><img src="images/dotted.jpg"  alt=""/></td>
  </tr>
<?php endforeach; else: ?>
  <tr>
    <td scope="row" class="required">News not found</td>
  </tr>
<?php endif; unset($_from); ?>
 
</table>