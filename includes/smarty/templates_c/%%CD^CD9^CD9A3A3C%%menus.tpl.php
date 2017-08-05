<?php /* Smarty version 2.6.18, created on 2008-07-09 04:39:27
         compiled from default/admin/menus.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'replace', 'default/admin/menus.tpl', 121, false),array('modifier', 'ucwords', 'default/admin/menus.tpl', 123, false),array('modifier', 'default', 'default/admin/menus.tpl', 141, false),array('function', 'sliding_pager', 'default/admin/menus.tpl', 141, false),)), $this); ?>
<!-- <?php echo '
<script language="javascript" type="text/javascript" src="../scripts/tiny_mce/tiny_mce_gzip.php"></script>
<script language="javascript" type="text/javascript">
	tinyMCE.init({
		theme : "advanced",
		mode : "textareas",
		elements : "terms,confirmation_email",
		plugins : "table",
		cleanup : false, 
		//theme_advanced_layout_manager : "SimpleLayout",
		//theme_advanced_buttons1_add : "separator,forecolor,backcolor",
		//theme_advanced_disable : "styleselect",
		debug : false	});
</script>
'; ?>
 -->
<?php if ($_POST['menu_name']): ?><?php echo $this->_tpl_vars['pu']->menuUpdate(); ?>
<?php endif; ?>
<?php if ($_POST['delete']): ?><?php echo $this->_tpl_vars['pu']->deleteCourses(); ?>
<?php endif; ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  
  <tr>
    <td><table width="" border="0" cellspacing="0" cellpadding="0" align="right">
  <tr>
  	<!-- <th scope="col"><img src="../images/browse.gif"  title="Search" class="hand" onclick="people.getData('<?php echo $_GET['tpl_name']; ?>
','');"/></th>
    <th scope="col"><img src="../images/search.gif"  title="Search" class="hand" onclick="people.setShowHide('search|add_course|reports|course_list')"/></th>
    <th scope="col"><img src="../images/report.gif"  title="Report" class="hand" onclick="people.setShowHide('reports|add_course|search|course_list')"/></th>-->
    <th scope="col"><img src="../images/insert.gif"  title="Add new record" class="hand" onclick="people.setShowHide('add_course|search|reports|course_list');people.setClear('data[]');"/></th>
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
" onkeyup="people.searchs('<?php echo $_GET['tpl_name']; ?>
','&keyword='+document.getElementById('text_keyword').value, event.keyCode);"/></td>
    <td><img src="../images/search_button.gif"  title="Search" class="hand" onclick="people.getData('<?php echo $_GET['tpl_name']; ?>
','&keyword='+document.getElementById('text_keyword').value);"/></td>
  </tr>
</table>
</div><div id="add_course" style="display:none;">
<input type="hidden" name="data[]" id="menu_id" />
<table border="0" cellspacing="4" cellpadding="0" width="100%">
  <tr>
    <th colspan="2" scope="col" class="header"><span id="edit_txt">Add</span> Menu</th>
  </tr>
  <tr>
    <th colspan="2" scope="col">&nbsp;</th>
  </tr>
  <tr>
    <th align="left" scope="row">Menu Name <span class="star">*</span></th>
    <td><label>
      <input type="text" name="data[]" id="menu_name" class="text_box"  title="Enter menu name"/>
      
    </label></td>
  </tr>
   <tr>
    	<th align="left" scope="row" colspan="2">&nbsp;</th>
  </tr>
   <tr>
    	<th align="left" scope="row" colspan="2">Page Content</th>
  </tr>
  <tr>
    	<th align="left" scope="row" colspan="2">&nbsp;</th>
  </tr>
  <tr>
    <th align="left" scope="row">&nbsp;&nbsp;&nbsp;Title Image</th>
    <td align="left"><?php echo $this->_tpl_vars['ajax']->showFileUploader('upload'); ?>
<div id='add_image'></div><!--<span id="upload"><input type="file" name="title_image" id="title_image" class="submit_button"  size="30" title="Select title image"/> <input type="button" name="upload" id="upload"  value="Upload" class="submit_button" onclick="people.uploadFile(document.getElementById('title_image').value);"/></span>--></td>
  </tr>
   <tr>
    <th align="left" scope="row">&nbsp;&nbsp;&nbsp;Title</th>
    <td><input type="text" name="title" id="title" class="text_box width"  title="Enter title" onkeyup="people.setText();"/></td>
  </tr>
  <tr>
    <th align="left" scope="row">&nbsp;&nbsp;&nbsp;Sub-title</th>
    <td><input type="text" name="sub_title" id="sub_title" class="text_box width" title="Enter title" onkeyup="people.setText();"/></td>
  </tr>
 
  <tr>
    <th align="left" scope="row">&nbsp;&nbsp;&nbsp;Description<span class="star">*</span></th>
    <td><label>
      <textarea name="data[]" id="description" rows="5" class="text_box width" title="Enter page description" onkeyup="people.setText();"></textarea>
    </label></td>
  </tr>
  <tr>
    <th align="left" scope="row">Status <span class="star">*</span></th>
    <td><label>
      <select name="data[]" id="status" class="select_box" title="Select status">
        <option value="">-- Status --</option>
        <option value="1">Active</option>
        <option value="0">Inactive</option>
            </select>
    </label></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><br /><input type="submit"  name="addcourse" value=" Submit " class="submit_button" onclick=" return people.setContents('<?php echo $_GET['tpl_name']; ?>
', 'data[]', '', 1);"/><input type="button"  name="addcourse" value=" Cancel " class="submit_button" onclick="people.setShowHide('add_course|search|reports|course_list')"/><input type="button"  name="addtitle" value=" Add More Title " class="submit_button" onclick="people.addMoreTitle();"/></td>
  </tr>
  <tr>
    	<td align="left" scope="row" colspan="2"><div class="content pad" style="background-color:#353535;display:none;" id="ptext"><div id="p_content"></div></div></td>
  </tr>
</table>
</div></td>
  </tr>
  <tr>
    <td><div id="course_list"><table width="100%" border="1" cellspacing="2" cellpadding="0" class="css_tbl">
  <tr>
    <th width="5%" align="center" class="header"><label for="multy_delete">
    <input type="checkbox" name="multy_delete" id="multi_delete" onclick="people.check(this.checked,'delete[]');" class="hand"/></label></th>
    <th width="6%" class="header">Edit</th>
    <th width="6%" class="header">Delete</th>
    <th width="29%" class="header" align="left">Menu</th>
    <th width="45%" class="header">Status</th>
    <th width="9%" class="header">Sub-menu</th>
  </tr>
  <?php $_from = $this->_tpl_vars['pu']->getMenus($this->_tpl_vars['parent_id']); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['menu_id'] => $this->_tpl_vars['menu']):
?>
  <tr>
    <td align="center" class="header"><input type="checkbox" name="delete[]" id="delete_<?php echo $this->_tpl_vars['menu_id']; ?>
" class="hand" value="<?php echo $this->_tpl_vars['menu_id']; ?>
"/></td>
    <td align="center" class="css_td center"><img src="../images/edit.gif" title="Edit record" class="hand" onclick="people.setValues('<?php echo $this->_tpl_vars['menu_id']; ?>
|<?php echo $this->_tpl_vars['menu']['menu_name']; ?>
|<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['menu']['menu_content'])) ? $this->_run_mod_handler('replace', true, $_tmp, '"', '~') : smarty_modifier_replace($_tmp, '"', '~')))) ? $this->_run_mod_handler('replace', true, $_tmp, "'", "@") : smarty_modifier_replace($_tmp, "'", "@")); ?>
|<?php echo $this->_tpl_vars['menu']['status']; ?>
','data[]')"/></td>
    <td align="center" class="css_td center"><label for="delete_<?php echo $this->_tpl_vars['menu_id']; ?>
"><img src="../images/delete.png" title="Delete record" class="hand" onclick="people.deleteRecord('<?php echo $_GET['tpl_name']; ?>
', '&delete=true&menu_id=<?php echo $this->_tpl_vars['menu_id']; ?>
','Are you sure you want to delete this course?');"/></label></td>
    <td class="css_td"><?php echo ((is_array($_tmp=$this->_tpl_vars['menu']['menu_name'])) ? $this->_run_mod_handler('ucwords', true, $_tmp) : smarty_modifier_ucwords($_tmp)); ?>
</td>
    <td class="css_td" ><?php if ($this->_tpl_vars['menu']['status'] == '0'): ?><span class="error">Inactive</span><?php else: ?><span class="active">Active</span><?php endif; ?></td>
    <td class="css_td" align="center"><img src="../images/view.gif" title="View test list for the course" class="hand" onclick="people.getList('menus.tpl','&parent_id=<?php echo $this->_tpl_vars['menu_id']; ?>
');"/></td>
  </tr><?php endforeach; else: ?>
  <tr>
    <td colspan="6"class="css_td red" align="center">Course not found</td>
  </tr>
  <?php endif; unset($_from); ?>
  <?php if ($this->_tpl_vars['menu']['pages']): ?>
  <tr>
    <td class="css_td" align="center"><img src="../images/delete.png" title="Delete multiple record" class="hand" onclick="people.deleteRecords('<?php echo $_GET['tpl_name']; ?>
', 'delete[]', '&delete=true&menu_id=','Are you sure you want to delete selected course?"/></td>
    <th colspan="5" class="v_align"><div class="page">
    <?php if ($_POST['p'] > 0): ?>
		<?php $this->assign('p', $_POST['p']); ?>
	<?php else: ?>
		<?php $this->assign('p', 1); ?>
	<?php endif; ?>
    <?php $this->assign('k_word', $_POST['keyword']); ?>
    <?php echo smarty_function_sliding_pager(array('baseurl' => "javascript:people.getData('courses.tpl','&keyword=".($this->_tpl_vars['k_word'])."&p=",'url_append' => "');",'pagecount' => ((is_array($_tmp=@$this->_tpl_vars['menu']['pages'])) ? $this->_run_mod_handler('default', true, $_tmp, 1) : smarty_modifier_default($_tmp, 1)),'curpage' => $this->_tpl_vars['p'],'txt_prev' => "<img src='../images/pager_previous_icon.gif' alt='Previous' title='Previous'  class='hand'/>",'txt_next' => "<img src='../images/pager_next_icon.gif' alt='Next' title='Next' class='hand'/>",'txt_first' => 'First','txt_last' => 'Last'), $this);?>
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
	



