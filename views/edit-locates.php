<?php
if (empty($_SESSION['logged'])) {
    ?>
    <script type="text/javascript">window.location.href = "<?php echo BASE_URL; ?>login";</script>
    <?php
    exit;
}
?>
<div class="container">
    <h1>Locação - Editar Locação</h1>

    <form method="POST" enctype="multipart/form-data">

        <div class="form-group">
            <label for="name_loc">Nome da locação</label>
            <input class="form-control" name="name_loc" type="text" id="name_loc" value="<?php echo $getLocate['name']; ?>"
                   disabled/>
        </div>

        <div class="form-group">
            <label for="user">QA:</label>
            <select name="user" id="user" class="form-control">
                <option value="default"></option>
                <?php
                foreach ($users as $user):
                    ?>
                <?php if ($user['user'] != 'admin') : ?>
                    <option value="<?php echo $user['id']; ?>"
                        <?php echo $getLocate['id'] == $user['id'] ? 'selected' : ''; ?> ><?php echo utf8_encode($user['user']); ?></option>
                <?php endif; ?>
                <?php
                endforeach;
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="prevision_date">Previsão de término</label>
            <input class="form-control" name="prevision_date" type="text"  id="week">
            <script type="text/javascript">
                var nowDate = new Date();
                var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), nowDate.getHours() + 4);

                $(function() {
                    $('input[name="prevision_date"]').daterangepicker( {
                        singleDatePicker: true,
                        timePicker: true,
                        timePicker24Hour: true,
                        timePickerIncrement: 15,
                        minDate: today,
                        locale: {
                            format: 'DD/MM/YYYY HH:mm'
                        }
                    });
                });
            </script>
        </div>

        <br/>

        <input type="submit" value="Editar" class="btn btn-default"/>
    </form>

</div>

