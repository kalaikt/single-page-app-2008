<?php /* Smarty version 2.6.18, created on 2008-07-01 09:55:38
         compiled from default/admin/exams.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'ucwords', 'default/admin/exams.tpl', 85, false),array('modifier', 'default', 'default/admin/exams.tpl', 104, false),array('function', 'sliding_pager', 'default/admin/exams.tpl', 104, false),)), $this); ?>
<?php if ($_POST['test_name']): ?><?php echo $this->_tpl_vars['cg']->testUpdate(); ?>
<?php endif; ?>
<?php if ($_POST['delete']): ?><?php echo $this->_tpl_vars['cg']->deleteTests(); ?>
<?php endif; ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  
  <tr>
    <td><table width="" border="0" cellspacing="0" cellpadding="0" align="right">
  <tr>
  <th scope="col"><img src="../images/browse.gif"  title="Search" class="hand" onclick="course.getData('<?php echo $_GET['tpl_name']; ?>
','&course_id=<?php echo $_POST['course_id']; ?>
');"/></th>
    <th scope="col"><img src="../images/search.gif"  title="Search" class="hand" onclick="course.setShowHide('search|add_course|reports|course_list')"/></th>
    <th scope="col"><img src="../images/report.gif"  title="Report" class="hand" onclick="course.setShowHide('reports|add_course|search|course_list')"/></th>
    <th scope="col"><img src="../images/insert.gif"  title="Add new record" class="hand" onclick="course.setShowHide('add_course|search|reports|course_list');course.setClear('data[]');"/></th>
  </tr>
</table></td>
  </tr>
  <tr>
    <td><div id="loading" align="center" style="display:none;position:absolute; height:800px; width:1000px; top:50px;"><img src="../images/loading.gif"   title="Generate excel report"/></div><div id="reports" style="display:none;"><table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><img src="../images/excel.gif"  title="Generate excel report" class="hand" onclick="course.reports('excel',document.getElementById('sql').value ,'test');"/></td>
    <td><img src="../images/word.gif"  title="Generate word report" class="hand" onclick="course.reports('word',document.getElementById('sql').value ,'test');"/></td>
    <td><img src="../images/csv.gif"  title="Generate csv report" class="hand" onclick="course.reports('csv',document.getElementById('sql').value ,'test');"/></td>
  </tr>
</table>
</div><div id="search" style="display:<?php if ($_POST['keyword']): ?>block<?php else: ?>none<?php endif; ?>;"><table border="0" cellspacing="2" cellpadding="0">
  <tr>
    <td><input name="text_keyword" id="text_keyword" type="text"  class="text_box" value="<?php echo $_POST['keyword']; ?>
" onkeyup="course.searchs('<?php echo $_GET['tpl_name']; ?>
','&course_id=<?php echo $_POST['course_id']; ?>
&keyword='+document.getElementById('text_keyword').value, event.keyCode);"/></td>
    <td><img src="../images/search_button.gif"  title="Search" class="hand" onclick="course.getData('<?php echo $_GET['tpl_name']; ?>
','&course_id=<?php echo $_POST['course_id']; ?>
&keyword='+document.getElementById('text_keyword').value);"/></td>
  </tr>
</table>
</div>
<div id="add_course" style="display:none;">
<input type="hidden" name="data[]" id="exam_id" />
<input type="hidden" name="data[]" id="courseid" />
<input type="hidden" name="course_id" id="course_id" value="<?php echo $_POST['course_id']; ?>
"/>
<table border="0" cellspacing="4" cellpadding="0">
  <tr>
    <th colspan="2" scope="col" class="header"><span id="edit_txt">Add</span> Test</th>
  </tr>
  <tr>
    <th colspan="2" scope="col">&nbsp;</th>
  </tr>
  <tr>
    <th align="left" scope="row">Test Name <span class="star">*</span></th>
    <td><label>
      <input type="text" name="data[]" id="test_name" class="text_box" title="Enter test name"/>
       </label></td>
  </tr>
  <tr>
    <th align="left" scope="row">Pass Mark <span class="star">*</span></th>
    <td><label>
	<input type="text" name="data[]" id="pass_mark" class="text_box" style=" width:35px;" maxlength="3" title="Enter pass mark"/>
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
    <td colspan="2" align="center"><br /><input type="button"  name="addcourse" value=" Submit " class="submit_button" onclick="course.saveData('<?php echo $_GET['tpl_name']; ?>
', 'data[]','&course_id=<?php echo $_POST['course_id']; ?>
',2);"/><input type="button"  name="addcourse" value=" Cancel " class="submit_button" onclick="course.setShowHide('add_course|search|reports|course_list')"/></td>
  </tr>
</table>
</div></td>
  </tr>
  <tr>
    <td><div id="course_list"><table width="100%" border="1" cellspacing="2" cellpadding="0" class="css_tbl">
  <tr>
    <th width="5%" align="center" class="header"><label for="multy_delete">
    <input type="checkbox" name="multy_delete" id="multi_delete" onclick="course.check(this.checked,'delete[]');" class="hand"/></label></th>
    <th width="6%" class="header">Edit</th>
    <th width="6%" class="header">Delete</th>
    <th width="29%" class="header" align="left">Test Name</th>
    <th width="32%" class="header">Pass Mark</th>
    <th width="22%" class="header">View Questions</th>
  </tr>
  <?php $_from = $this->_tpl_vars['cg']->getExams(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['exam_id'] => $this->_tpl_vars['exam']):
?>
  <tr>
    <td align="center" class="header"><input type="checkbox" name="delete[]" id="delete_<?php echo $this->_tpl_vars['exam_id']; ?>
" class="hand" value="<?php echo $this->_tpl_vars['exam_id']; ?>
"/></td>
    <td align="center" class="css_td center"><img src="../images/edit.gif" title="Edit record" class="hand" onclick="course.setValues('<?php echo $this->_tpl_vars['exam_id']; ?>
|<?php echo $this->_tpl_vars['exam']['course_id']; ?>
|<?php echo $this->_tpl_vars['exam']['exam_name']; ?>
|<?php echo $this->_tpl_vars['exam']['pass_score']; ?>
|<?php echo $this->_tpl_vars['exam']['status']; ?>
','data[]')"/></td>
    <td align="center" class="css_td center"><label for="delete_<?php echo $this->_tpl_vars['exam_id']; ?>
"><img src="../images/delete.png" title="Delete record" class="hand" onclick="course.deleteRecord('<?php echo $_GET['tpl_name']; ?>
', '&delete=true&exam_id=<?php echo $this->_tpl_vars['exam_id']; ?>
&course_id=<?php echo $_POST['course_id']; ?>
','Are you sure you want to delete this course?');"/></label></td>
    <td class="css_td"><?php echo ((is_array($_tmp=$this->_tpl_vars['exam']['exam_name'])) ? $this->_run_mod_handler('ucwords', true, $_tmp) : smarty_modifier_ucwords($_tmp)); ?>
</td>
    <td class="css_td" ><?php echo $this->_tpl_vars['exam']['pass_score']; ?>
</td>
    <td class="css_td" align="center"><img src="../images/view.gif" title="View test list for the course" class="hand" onclick="course.getList('questions.tpl','&course_id=<?php echo $_POST['course_id']; ?>
&exam_id=<?php echo $this->_tpl_vars['exam_id']; ?>
');"/></td>
  </tr><?php endforeach; else: ?>
  <tr>
    <td colspan="6" class="css_td red" align="center">Test not found</td>
  </tr>
  <?php endif; unset($_from); ?>
  <?php if ($this->_tpl_vars['exam']['pages']): ?>
  <tr>
  
    <td class="css_td" align="center"><img src="../images/delete.png" title="Delete multiple record" class="hand" onclick="course.deleteRecords('<?php echo $_GET['tpl_name']; ?>
', 'delete[]', '&delete=true&course_id=<?php echo $_POST['course_id']; ?>
&exam_id=','Are you sure you want to delete selected course?')"/></td>
   <th colspan="5" class="v_align"><div class="page">
    <?php if ($_POST['p'] > 0): ?>
		<?php $this->assign('p', $_POST['p']); ?>
	<?php else: ?>
		<?php $this->assign('p', 1); ?>
	<?php endif; ?>
    <?php $this->assign('k_word', "&course_id=".($_POST['course_id'])."&keyword=".($_POST['keyword'])."&p="); ?>
    <?php echo smarty_function_sliding_pager(array('baseurl' => "javascript:course.getData('exams.tpl','".($this->_tpl_vars['k_word']),'url_append' => "');",'pagecount' => ((is_array($_tmp=@$this->_tpl_vars['exam']['pages'])) ? $this->_run_mod_handler('default', true, $_tmp, 1) : smarty_modifier_default($_tmp, 1)),'curpage' => $this->_tpl_vars['p'],'txt_prev' => "<img src='../images/pager_previous_icon.gif' alt='Previous' title='Previous'  class='hand'/>",'txt_next' => "<img src='../images/pager_next_icon.gif' alt='Next' title='Next' class='hand'/>",'txt_first' => 'First','txt_last' => 'Last'), $this);?>
&nbsp;</div></th>
  </tr>
  <?php endif; ?>
</table></div><br />
<input type="button" name="back" value=" << Back " class="submit_button" onclick="course.getData('courses.tpl','');"/>
<input type="hidden" name="sql" id="sql" value='<?php echo $this->_tpl_vars['cg']->getQuery(); ?>
' />
</td>
  </tr>
</table>



