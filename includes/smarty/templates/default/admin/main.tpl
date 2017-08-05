<form id="form1" name="form1" method="post" action="?cw=dealers">
  <table width="29%" border="0" cellspacing="0" cellpadding="5">
    
    <tr>
      <td colspan="3" class="required">{if $smarty.get.error}*Invalid username or password!{/if}&nbsp;</td>
    </tr>
    <tr>
      <td width="8%">&nbsp;</td>
      <td width="29%">Username</td>
      <td width="63%"><label>
        <input type="text" name="username" id="username"  class="input_text"/>
      </label></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Password</td>
      <td><label>
        <input type="password" name="password" id="password" class="input_text"/>
      </label></td>
    </tr>
    
    <tr>
      <td colspan="3" align="center"><input type="submit" name="button" id="button" value="Submit" class="submit_button"/></td>
    </tr>
  </table>
  <label></label>
</form>
