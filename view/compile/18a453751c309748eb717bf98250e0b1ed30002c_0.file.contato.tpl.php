<?php
/* Smarty version 3.1.36, created on 2020-12-30 00:44:20
  from 'C:\xampp\htdocs\Meus_projetos\Loja_Virtual_PHP7\view\contato.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5febbf54e6e312_95204388',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '18a453751c309748eb717bf98250e0b1ed30002c' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Meus_projetos\\Loja_Virtual_PHP7\\view\\contato.tpl',
      1 => 1609285445,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5febbf54e6e312_95204388 (Smarty_Internal_Template $_smarty_tpl) {
?><link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<?php echo '<script'; ?>
 src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="//code.jquery.com/jquery-1.11.1.min.js"><?php echo '</script'; ?>
>
<!------ Include the above in your HEAD tag ---------->

<div class="container">
<div class="col-md-5">
    <div class="form-area">  
        <form role="form">
        <br style="clear:both">
                    <h3 style="margin-bottom: 25px; text-align: center;">Contact Form</h3>
    				<div class="form-group">
						<input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="email" name="email" placeholder="Email" required>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile Number" required>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" required>
					</div>
                    <div class="form-group">
                    <textarea class="form-control" type="textarea" id="message" placeholder="Message" maxlength="140" rows="7"></textarea>
                        <span class="help-block"><p id="characterLeft" class="help-block ">You have reached the limit</p></span>                    
                    </div>
            
        <button type="button" id="submit" name="submit" class="btn btn-primary pull-right">Submit Form</button>
        </form>
    </div>
</div>
</div><?php }
}
