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
        <div class="form-group">
            <label for="prevision_date">Previsão de término</label>
        <input class="form-control" name="prevision_date" type="text"  id="week">
        <script type="text/javascript">
            $(function() {
                $('input[name="prevision_date"]').daterangepicker( {
                    singleDatePicker: true,
                    timePicker: true,
                    timePicker24Hour: true,
                    timePickerIncrement: 15,
                    minDate: new Date(new Date().setFullYear(new Date().getFullYear())),
                    locale: {
                        format: 'DD/MM/YYYY HH:mm'
                    }
                });
            });
        </script>
        </div>
                    <br/>

                    <input type="submit" value="Adicionar" class="btn btn-default"/>
                </form>

            </div>