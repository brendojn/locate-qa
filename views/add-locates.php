<?php
if (empty($_SESSION['logged'])) {
    ?>
    <script type="text/javascript">window.location.href = "<?php echo BASE_URL; ?>login";</script>
    <?php
    exit;
}
?>
<div class="container">
    <h1>Locação - Adicionar Locação</h1>
    <?php if(!empty($erro)): ?>
        <div class="alert alert-danger"><?php echo $erro; ?></div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="class">Classe de locação:</label><br/>
            <div class="radio">

                <label><input type="radio" name="class"
                              value="environment"/>Ambiente
                </label>
                <label><input type="radio" name="class"
                              value="device"/>Dispositivo
                </label>
            </div>
        </div>
        <div class="form-group">
            <label for="name_loc">Nome da locação</label>
            <input class="form-control" name="name_loc" type="text" id="name_loc">
        </div>

        <div class="row">
                    <div class="form-group ">
                        <label class="control-label col-sm-2 requiredField" for="prevision_date">
                            Previsão de término
                            <span class="asteriskField">
       </span>
                        </label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar">
                                    </i>
                                </div>
                                <input class="form-control" id="prevision_date" name="prevision_date" placeholder="DD/MM/YYYY" type="text" autocomplete="off"/>
                        <script>
                            $(document).ready(function(){
                                var date_input=$('input[name="prevision_date"]'); //our date input has the name "date"
                                var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
                                date_input.datepicker({
                                    format: 'dd/mm/yyyy',
                                    container: container,
                                    todayHighlight: true,
                                    autoclose: true,
                                })
                            })
                        </script>
                    </div>

                    <br/>

                    <input type="submit" value="Adicionar" class="btn btn-default"/>
                </form>

            </div>