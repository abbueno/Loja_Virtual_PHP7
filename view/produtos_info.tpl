{foreach from=$PRO item=P}

    <h3> class="text-center">{$P.pro_nome} - Ref: {$P.pro.ref}</h3>
    <h3>
<hr>

<div class="row">

    {* div da esquerda imagem do produto  *}
    <div class="col-md-6">

        <img class="thumbnail" src="{$P.pro_img_g}" alt="" >
    
    </div>


{*   dive da direita info produtos    *}
    <div class="col-md-6" thumbnail">

        <img src="{$TEMA}/images/logo-pagseguro.png" alt="">
<hr>

    </div>

    <div class="col-md-6">
        <form name="carrinho" method="post" action="">
            <input type="hidden" name="pro_id" value="{$P.pro_id}">
            <input type="hidden" name="acao" value="add">
        <button class="btn btn-geral btn-lg">Comprar</button>
            </form>
        </div>
    </div>

</div>
    <!-- -->
    {*  listagem de imagens extras  *}
    <div class="row">
        <hr>
            <h4 class="text-center">Mais imagens</h4>

            <ul style="list-style: nome">


                <li class="col-md-3 ">
                    <img src="" alt="" class="thumbnail">

                </li>
            </ul>
        
        </div>
            {*   <!-- descrição do produto-->  *}

        <div class="row">
            <hr>
                <h4 class="text-center">Descrição do produto</h4>

                {$P.pro.desc}
            
            </div>
                <br>
                <br>
    
    {/foreach}
