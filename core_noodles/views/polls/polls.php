<script src="/theme/js/admin/admin/polls.js"></script>

<div <div class="column large-10">
    <br>
    <h2>Encuestas</h2>
            <?php
            $result = $this -> db
                            -> order_by("id", "desc")
                            -> get('polls');

            foreach ($result -> result() as $row){
                echo "
                    <div class=\"callout lista_elementos_editar clearfix\" elemento_eliminar=\"". $row -> id ."\">
                        <a href=\"/admin/polls/editar/". $row -> id ."/\" class=\"large-10 column\">
                            <div class=\"large-8 column\">
                                <h3>". $row -> descripcion ."</h3>
                                <p>". $row -> fecha ."</p>
                            </div>
                        </a>
                            <div class=\"large-2 column\">
                        ";

                        if($row -> publica){
                            echo "
                                <button class=\"button publica success\" href=\"#\" id-elemento-publica=\"". $row -> id ."\" style=\"display: none\">Publicar</button>
                            ";
                        }else{
                            echo "
                                <button class=\"button publica success\" href=\"#\" id-elemento-publica=\"". $row -> id ."\">Publicar</button>
                            ";
                        }

                        echo "
                            </div>
                        <div class=\"large-2 column\">
                            <button class=\"button eliminar\" href=\"#\" data-open=\"modal_eliminar\" id-elemento=\"". $row -> id ."\">Eliminar</button>
                        </div>
                    </div>
                    ";
            }
            ?>

</div>

<div class="reveal" id="modal_eliminar" data-reveal>
    <h2 id="firstModalTitle">¿Desea eliminar este artículo?</h2>
    <p id="eliminar_descripcion"></p>
    <br>
    <div class="columns small-12 collapse">
        <div class="columns small-6">
            <button class="button expanded radius" id="eliminar_cancelar">Cancelar</button>
        </div>
        <div class="columns small-6">
            <button class="button expanded radius alert" id="eliminar_eliminar">Eliminar</button>
        </div>
    </div>

    <button class="close-button" data-close aria-label="Close reveal" type="button">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
