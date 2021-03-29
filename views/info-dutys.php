<?php
if (empty($_SESSION['logged'])) {
    ?>
    <script type="text/javascript">window.location.href = "<?php echo BASE_URL; ?>login";</script>
    <?php
    exit;
}
?>
<div class="container">
    <h1>Plantão - Informações</h1>

    <form method="POST" enctype="multipart/form-data">

        <div class="form-group">
            <label for="week">Semana do plantão:</label>
            <input type="text" name="week" id="week" class="form-control" value="<?php echo $duty['week']; ?>"
                   disabled/>
        </div>

        <div class="form-group">
            <label for="employee">Bonificado:</label>
            <select name="employee" id="employee" class="form-control" disabled>
                <option selected><?php echo utf8_encode($duty['name']); ?></option>
            </select>
        </div>

        <div class="form-group">
            <label for="value">Avaliador:</label>
            <input type="text" name="user_v" id="user_v" class="form-control"
                   value="<?php echo $evaluates['user'] ?>"
                   disabled/>
        </div>

        <div class="form-group">
            <label for="value">Justificativa:</label>
            <input type="text" name="justification" id="justification" class="form-control" rows="3"
                   value="<?php echo $evaluates['justification'] ?>"
                   disabled/>
        </div>
        <br/>

    </form>

</div>