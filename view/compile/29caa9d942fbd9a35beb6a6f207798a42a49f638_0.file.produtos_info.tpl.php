<?php
/* Smarty version 3.1.36, created on 2021-01-02 18:04:28
  from 'C:\xampp\htdocs\Meus_projetos\Loja_Virtual_PHP7\view\produtos_info.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5ff0a79c119cf8_85594917',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '29caa9d942fbd9a35beb6a6f207798a42a49f638' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Meus_projetos\\Loja_Virtual_PHP7\\view\\produtos_info.tpl',
      1 => 1609607066,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5ff0a79c119cf8_85594917 (Smarty_Internal_Template $_smarty_tpl) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['PRO']->value, 'P');
$_smarty_tpl->tpl_vars['P']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['P']->value) {
$_smarty_tpl->tpl_vars['P']->do_else = false;
?>

    <h3> class="text-center"><?php echo $_smarty_tpl->tpl_vars['P']->value['pro_nome'];?>
 - Ref: <?php echo $_smarty_tpl->tpl_vars['P']->value['pro']['ref'];?>
</h3>
    <h3>
<hr>

<div class="row">

        <div class="col-md-6">

        <img class="thumbnail" src="<?php echo $_smarty_tpl->tpl_vars['P']->value['pro_img_g'];?>
" alt="" >
    
    </div>


    <div class="col-md-6" thumbnail">

        <img src="<?php echo $_smarty_tpl->tpl_vars['TEMA']->value;?>
/images/logo-pagseguro.png" alt="">
<hr>

    </div>

    <div class="col-md-6">
        <form name="carrinho" method="post" action="">
            <input type="hidden" name="pro_id" value="<?php echo $_smarty_tpl->tpl_vars['P']->value['pro_id'];?>
">
            <input type="hidden" name="acao" value="add">
        <button class="btn btn-geral btn-lg">Comprar</button>
            </form>
        </div>
    </div>

</div>
    <!-- -->
        <div class="row">
        <hr>
            <h4 class="text-center">Mais imagens</h4>

            <ul style="list-style: nome">


                <li class="col-md-3 ">
                    <img src="" alt="" class="thumbnail">

                </li>
            </ul>
        
        </div>
            
        <div class="row">
            <hr>
                <h4 class="text-center">Descrição do produto</h4>

                <?php echo $_smarty_tpl->tpl_vars['P']->value['pro']['desc'];?>

            
            </div>
                <br>
                <br>
    
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
}
