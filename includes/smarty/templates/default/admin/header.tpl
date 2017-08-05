{if $smarty.post.username}{$pu->checkAdminUser()}{/if}
<table bgcolor="#ffc726" border="0" cellpadding="0" cellspacing="0" width="720">
<tr>
  <th width="654" valign="middle" class="panel">Admin Panel</th>
  <th width="66" valign="middle" class="panel"> {if $smarty.session.admin_user_id}<a href="?cw=main&amp;logout=1">Logout</a>{/if}</th>
</tr> 
</table>
<br />
{if $smarty.session.admin_user_id}
<!--<table border="0" cellpadding="0" cellspacing="0" width="720">

<tr>
  <th valign="middle" align="right" > <a href="?cw=dealers">Manage Dealers</a>| <a href="?cw=users">Manage Admin Users</a></th>
  </tr>
<tr>
  <th valign="middle" align="right" >&nbsp;</th>
</tr> 
</table>-->
{/if}