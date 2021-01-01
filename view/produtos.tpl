<h3>Página de produtos</h3>

<hr>

    <section id="pagincao" class="row">
        <center>
        PAGINAS
        </center>
    </section>



    <section id="produtos" class="row">

        <ul style="List-style: nome" >



                <div class="row" id="pularliha">
            {foreach from=$PRO item=P}


            <li class="col-md-4">

                <div class="thumbnail">

                    <a hrer="">


                        <img src="media/images/{$P.pro_img}" alt="">

                        <div class="caption">
                            
                            <h4 class="text-center">{$P.pro_nome}</h4>

                            <h3 class="text-center text-danger">{$P.pro_valor}</h3>

                        </div>
                    
                    </a>

                </div>

            </li>

            {/foreach}

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
