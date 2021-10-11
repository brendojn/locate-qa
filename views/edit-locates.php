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

        <input type="submit" value="Editar" class="btn btn-default"/>
    </form>

</div>

