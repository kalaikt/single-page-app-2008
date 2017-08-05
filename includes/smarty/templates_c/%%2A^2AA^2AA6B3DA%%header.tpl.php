<?php /* Smarty version 2.6.18, created on 2008-07-04 12:10:20
         compiled from default/admin/header.tpl */ ?>
<?php if ($_POST['username']): ?><?php echo $this->_tpl_vars['pu']->checkAdminUser(); ?>
<?php endif; ?>
<table bgcolor="#ffc726" border="0" cellpadding="0" cellspacing="0" width="720">
<tr>
  <th width="654" valign="middle" class="panel">Admin Panel</th>
  <th width="66" valign="middle" class="panel"> <?php if ($_SESSION['admin_user_id']): ?><a href="?cw=main&amp;logout=1">Logout</a><?php endif; ?></th>
</tr> 
</table>
<br />
<?php if ($_SESSION['admin_user_id']): ?>
<!--<table border="0" cellpadding="0" cellspacing="0" width="720">

<tr>
  <th valign="middle" align="right" > <a href="?cw=dealers">Manage Dealers</a>| <a href="?cw=users">Manage Admin Users</a></th>
  </tr>
<tr>
  <th valign="middle" align="right" >&nbsp;</th>
</tr> 
</table>-->
<?php endif; ?>