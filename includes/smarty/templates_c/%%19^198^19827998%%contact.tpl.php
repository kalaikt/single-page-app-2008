<?php /* Smarty version 2.6.18, created on 2008-08-01 11:24:03
         compiled from default/contact.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "default/loader.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
  <tr>
    <td colspan="2" align="left" style="padding-left:30px;"><img src="images/contact.jpg" alt=""/></td>
     <td align="left"><img src="images/peopleu.jpg" alt=""/></td>
  </tr>
  <tr>
<td width="52%" valign="top" class="content pad">
<?php if ($_POST['send_to']): ?><?php echo $this->_tpl_vars['pu']->sendEMail(); ?>
<?php else: ?>
    <table border="0" cellpadding="5" cellspacing="0" width="405">
<tr>
            <td class="style29" align="left" valign="top" width="71"><strong>
            <label for="send_to">Send to: <span class="required">*</span></label>
            </strong></td>
      <td align="left" width="314">
<select name="data[]" class="select_box text" id="send_to" title="Select one">
                    <option value="" selected="selected">Choose One</option>
                    <option value="Customer Service">Customer Service</option>

                    <option value="General Information">General Information</option>
                    <option value="Pricing Sales">Pricing &amp; Sales</option>
                </select>			
            </td>
        </tr>
        <tr>
            <td class="style29" align="left" valign="top"><strong>

            <label for="name">Name: <span class="required">*</span></label></strong></td>
            <td align="left"><input name="data[]" class="text_box text" id="name" value="" type="text" title="Enter name" /></td>
        </tr>
        <tr>
            <td class="style29" align="left" valign="top"><strong>
            <label for="email">E-mail: <span class="required">*</span></label></strong></td>
            <td align="left"><input name="data[]" class="text_box text" id="email" value="" type="text" title="Enter email" /></td>
        </tr>

        <tr>
            <td class="style29" align="left" valign="top"><strong>
            <label for="message">Message: <span class="required">*</span></label></strong></td>
            <td align="left"><textarea name="data[]" cols="30" rows="5" class="text_box text" id="message" title="Enter message"></textarea></td>
        </tr>
        <tr>
            <td colspan="2"><div align="center"><input name="Submit" value=" Send Message " class="submit_button" id="Submit" type="button" onclick="object.saveData('contact','data[]','&amp;flag=1', 0);"/></div></td>
        </tr>

    
  </table>
  <?php endif; ?>
  </td>
	<td width="3%" valign="top" class="content"><img src="images/line_sep.jpg"  alt=""/></td>
	<td width="38%" align="left" valign="top" class="content" style="padding-top:10px;">
<div class="sub_heading">USA</div>
16200 Foster Street<br/>
Overland Park, Kansas 66085<br/>
Toll Free Phone: 888.255.9622<br/>
Fax: 913.814.8108<br/><br/>

<div class="sub_heading">India</div>
50/2, First floor, Harrington Road<br/>
Shenoy Nagar, Chennai 600030<br/>
Phone: +91 44 64621628 /29/30<br/>
</td>
</tr>
</table>
    