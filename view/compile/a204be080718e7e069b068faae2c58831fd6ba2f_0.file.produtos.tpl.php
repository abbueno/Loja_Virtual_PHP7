<?php
/* Smarty version 3.1.36, created on 2021-01-02 14:45:36
  from 'C:\xampp\htdocs\Meus_projetos\Loja_Virtual_PHP7\view\produtos.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5ff0790019fd19_22969475',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a204be080718e7e069b068faae2c58831fd6ba2f' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Meus_projetos\\Loja_Virtual_PHP7\\view\\produtos.tpl',
      1 => 1609594056,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5ff0790019fd19_22969475 (Smarty_Internal_Template $_smarty_tpl) {
?><h3>Página de produtos</h3>

<hr>

    <section id="pagincao" class="row">
        <center>
        PAGINAS
        </center>
    </section>



    <section id="produtos" class="row">

        <ul style="List-style: nome" >



                <div class="row" id="pularliha">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['PRO']->value, 'P');
$_smarty_tpl->tpl_vars['P']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['P']->value) {
$_smarty_tpl->tpl_vars['P']->do_else = false;
?>


            <li class="col-md-4">

                <div class="thumbnail">

                    <a hrer="">


                        <img src="<?php echo $_smarty_tpl->tpl_vars['P']->value['pro_img'];?>
" alt="">

                        <div class="caption">
                            
                            <h4 class="text-center"><?php echo $_smarty_tpl->tpl_vars['P']->value['pro_nome'];?>
</h4>

                            <h3 class="text-center text-danger"><?php echo $_smarty_tpl->tpl_vars['P']->value['pro_valor'];?>
</h3>

                        </div>
                    
                    </a>

                </div>

            </li>

            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

            </div>


</ul>

    </section>




    <section id="pagincao" class="row">
    <center>
    PAGINAS
    </center>
</section>

<ul style="list-style: nome" >

        <div class="row" id="pularliha">

    <li class="col-md-4">

        <div class="thumbnail">

            <a href="">

                <img src=" alt=">

                <div class="caption">

                    <h4 class="text-center">NOME PROD</h4>

                    <h3 class="text-center text-danger">VALOR</h3>
                
                    </div>
                    
                    </a>

                </div>


            </li>

            </div>


</ul>

    </section>
    
        <section id="pagincao" class="row">
        <center>
        PAGINAS
        </center>        
        </section>
<?php }
}
