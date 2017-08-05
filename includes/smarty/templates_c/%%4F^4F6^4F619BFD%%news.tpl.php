<?php /* Smarty version 2.6.18, created on 2008-07-14 08:33:08
         compiled from default/admin/news.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'replace', 'default/admin/news.tpl', 59, false),array('modifier', 'ucfirst', 'default/admin/news.tpl', 79, false),array('modifier', 'truncate', 'default/admin/news.tpl', 79, false),array('modifier', 'default', 'default/admin/news.tpl', 99, false),array('function', 'sliding_pager', 'default/admin/news.tpl', 99, false),)), $this); ?>
<?php echo $this->_tpl_vars['pu']->checkLogin(); ?>

<?php if ($_POST['title']): ?><?php echo $this->_tpl_vars['pu']->newsUpdate(); ?>
<?php endif; ?>
<?php if ($_POST['delete']): ?><?php echo $this->_tpl_vars['pu']->deleteNews(); ?>
<?php endif; ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="" border="0" cellspacing="0" cellpadding="0" align="right">
  <tr>
  	 <th scope="col"><img src="../images/browse.gif"  title="Search" class="hand" onclick="people.getData('<?php echo $_GET['tpl_name']; ?>
','');"/></th>
    <th scope="col"><img src="../images/search.gif"  title="Search" class="hand" onclick="people.setShowHide('search|add_news|reports|news_list')"/></th>
    <th scope="col"><img src="../images/report.gif"  title="Report" class="hand" onclick="people.setShowHide('reports|add_news|search|news_list')"/></th>
    <th scope="col"><img src="../images/insert.gif"  title="Add new record" class="hand" onclick="people.setShowHide('add_news|search|reports|news_list');people.setClear('data[]');"/></th>
  </tr>
</table></td>
  </tr>
  <tr>
    <td><div id="loading" align="center" style="display:none;position:absolute; height:800px; width:700px; top:50px;"><img src="../images/loading.gif"   title="Loading"/></div><div id="reports" style="display:none;"><table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><img src="../images/excel.gif"  title="Generate excel report" class="hand" onclick="people.reports('excel',document.getElementById('sql').value ,'cources');"/></td>
    <td><img src="../images/word.gif"  title="Generate word report" class="hand" onclick="people.reports('word',document.getElementById('sql').value ,'cources');"/></td>
    <td><img src="../images/csv.gif"  title="Generate csv report" class="hand" onclick="people.reports('csv',document.getElementById('sql').value ,'cources');"/></td>
  </tr>
</table>
</div><div id="search" style="display:<?php if ($_POST['keyword']): ?>block<?php else: ?>none<?php endif; ?>;"><table border="0" cellspacing="2" cellpadding="0">
  <tr>
    <td><input name="text_keyword" id="text_keyword" type="text"  class="text_box" value="<?php echo $_POST['keyword']; ?>
" onkeyup='people.searchs("<?php echo $_GET['tpl_name']; ?>
",this, event.keyCode);'/></td>
    <td><img src="../images/search_button.gif"  title="Search" class="hand" onclick="people.getData('<?php echo $_GET['tpl_name']; ?>
','&keyword='+document.getElementById('text_keyword').value);"/></td>
  </tr>
</table>
</div><div id="add_news" style="display:<?php if ($_POST['news_id']): ?>block<?php else: ?>none<?php endif; ?>;">
<input type="hidden" name="data[]" id="news_id" value="<?php echo $_POST['news_id']; ?>
"/>
<table border="0" cellspacing="4" cellpadding="0" width="100%">
  <tr>
    <th colspan="2" scope="col" class="header"><span id="edit_txt">Add</span> News</th>
  </tr>
  <tr>
    <th colspan="2" scope="col">&nbsp;</th>
  </tr>
  <tr>
    	<th align="left" scope="row" colspan="2">&nbsp;</th>
  </tr>
  <tr>
    <th align="left" scope="row">Image</th>
    <td align="left"><div id='add_image'><?php if (! $this->_tpl_vars['newsdata'][$_POST['news_id']]['image']): ?><?php echo $this->_tpl_vars['ajax']->showFileUploader('upload'); ?>
<?php else: ?><a href='../images/<?php echo $this->_tpl_vars['newsdata'][$_POST['news_id']]['image']; ?>
' target='_blank'>Open File</a> &nbsp;&nbsp;&nbsp; <a href='javascript:people.deleteFile("deletefile.php?filename=../images/<?php echo $this->_tpl_vars['newsdata'][$_POST['news_id']]['image']; ?>
");'><img src='../images/delete.png'/></a><input type='hidden' name='title_image' id='title_image' value='<?php echo $this->_tpl_vars['newsdata'][$_POST['news_id']]['image']; ?>
'><?php endif; ?></div></td>
  </tr>
   <tr>
    <th align="left" scope="row">Title<span class="star">*</span></th>
    <td><input type="text" name="data[]" id="title" class="text_box width" value="<?php echo $this->_tpl_vars['newsdata'][$_POST['news_id']]['title']; ?>
"  title="Enter title" onkeyup="people.setText();"/></td>
  </tr>
  <tr>
    <th align="left" scope="row">Description<span class="star">*</span></th>
    <td><label>
      <textarea name="data[]" id="description" rows="5" class="text_box width" title="Enter page description" onkeyup="people.setText();"><?php echo $this->_tpl_vars['newsdata'][$_POST['news_id']]['description']; ?>
</textarea>
    </label></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><br /><input type="submit"  name="addcourse" value=" Submit " class="submit_button" onclick=" return people.saveData('<?php echo $_GET['tpl_name']; ?>
', 'data[]', '', 1);"/><input type="button"  name="addcourse" value=" Cancel " class="submit_button" onclick="people.setShowHide('add_news|search|reports|news_list')"/></td>
  </tr>
  <tr>
    	<td align="left" scope="row" colspan="2" id="preview"><strong>Preview</strong><div class="content pad" style="background-color:#353535;display:<?php if ($_POST['news_id']): ?>block<?php else: ?>none<?php endif; ?>;" id="ptext"><div id="p_content" class="height"><?php if ($this->_tpl_vars['newsdata'][$_POST['news_id']]['image']): ?><div class="news_image"><img src="../images/<?php echo $this->_tpl_vars['newsdata'][$_POST['news_id']]['image']; ?>
"/></div><?php endif; ?><div class="sub_heading"><?php echo $this->_tpl_vars['newsdata'][$_POST['news_id']]['title']; ?>
</div><?php echo ((is_array($_tmp=$this->_tpl_vars['newsdata'][$_POST['news_id']]['description'])) ? $this->_run_mod_handler('replace', true, $_tmp, "\n", "<br />") : smarty_modifier_replace($_tmp, "\n", "<br />")); ?>
</div></div></td>
  </tr>
</table>
</div></td>
  </tr>
  <tr>
    <td><div id="news_list" style="display:<?php if (! $_POST['news_id']): ?>block<?php else: ?>none<?php endif; ?>"><table width="100%" border="1" cellspacing="2" cellpadding="0" class="css_tbl">
  <tr>
    <th width="5%" align="center" class="header"><label for="multy_delete">
    <input type="checkbox" name="multy_delete" id="multi_delete" onclick="people.check(this.checked,'delete[]');" class="hand"/></label></th>
    <th width="29%" class="header" align="left">Title</th>
    <th width="45%" class="header">Description</th>
    <th class="header">Status</th>
    <th width="6%" class="header">Edit</th>
    <th width="6%" class="header">Delete</th>
   </tr>
  <?php $_from = $this->_tpl_vars['pu']->getNews(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['news_id'] => $this->_tpl_vars['news']):
?>
  <tr>
    <td align="center" class="header"><input type="checkbox" name="delete[]" id="delete_<?php echo $this->_tpl_vars['news_id']; ?>
" class="hand" value="<?php echo $this->_tpl_vars['news_id']; ?>
"/></td>
    
    <td class="css_td"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['news']['title'])) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : smarty_modifier_ucfirst($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, '50') : smarty_modifier_truncate($_tmp, '50')); ?>
</td>
    <td class="css_td" ><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['news']['description'])) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : smarty_modifier_ucfirst($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, '150') : smarty_modifier_truncate($_tmp, '150')); ?>
</td>
     <td class="css_td" ><?php if ($this->_tpl_vars['news']['status'] == '1'): ?><span class="active">Active</span><?php else: ?><span class="required">Inactive</span><?php endif; ?></td>
   <td align="center" class="css_td center"><img src="../images/edit.gif" title="Edit record" class="hand" onclick="people.getData('news.tpl','&news_id=<?php echo $this->_tpl_vars['news_id']; ?>
');"/></td>
    <td align="center" class="css_td center"><label for="delete_<?php echo $this->_tpl_vars['news_id']; ?>
"><img src="../images/delete.png" title="Delete record" class="hand" onclick="people.deleteRecord('<?php echo $_GET['tpl_name']; ?>
', '&delete=true&news_id=<?php echo $this->_tpl_vars['news_id']; ?>
','Are you sure you want to delete this course?');"/></label></td>
  </tr><?php endforeach; else: ?>
  <tr>
    <td colspan="6"class="css_td red" align="center">News not found</td>
  </tr>
  <?php endif; unset($_from); ?>
  <?php if ($this->_tpl_vars['news']['pages']): ?>
  <tr>
    <td class="css_td" align="center"><img src="../images/delete.png" title="Delete multiple record" class="hand" onclick="people.deleteRecords('<?php echo $_GET['tpl_name']; ?>
', 'delete[]', '&delete=true&news_id=','Are you sure you want to delete selected course?')"/></td>
    <th colspan="5" class="v_align"><div class="page">
    <?php if ($_POST['p'] > 0): ?>
		<?php $this->assign('p', $_POST['p']); ?>
	<?php else: ?>
		<?php $this->assign('p', 1); ?>
	<?php endif; ?>
    <?php $this->assign('k_word', $_POST['keyword']); ?>
    <?php echo smarty_function_sliding_pager(array('baseurl' => "javascript:people.getData('news.tpl','&keyword=".($this->_tpl_vars['k_word'])."&p=",'url_append' => "');",'pagecount' => ((is_array($_tmp=@$this->_tpl_vars['news']['pages'])) ? $this->_run_mod_handler('default', true, $_tmp, 1) : smarty_modifier_default($_tmp, 1)),'curpage' => $this->_tpl_vars['p'],'txt_prev' => "<img src='../images/pager_previous_icon.gif' alt='Previous' title='Previous'  class='hand'/>",'txt_next' => "<img src='../images/pager_next_icon.gif' alt='Next' title='Next' class='hand'/>",'txt_first' => 'First','txt_last' => 'Last'), $this);?>
&nbsp;</div></th>
  </tr>
  <?php endif; ?>
</table></div>
<input type="hidden" name="sql" id="sql" value="<?php echo $this->_tpl_vars['pu']->getQuery(); ?>
" />
</td>
  </tr>
</table>
<div id="content_test"></div>
	



