<?php
if (empty($_SESSION['logged'])) {
    ?>
    <script type="text/javascript">window.location.href = "<?php echo BASE_URL; ?>login";</script>
    <?php
    exit;
}
?>
<div class="container">
    <h1>Tarefas - Pagamento de meta</h1>

    <form method="POST" enctype="multipart/form-data">

        <div class="form-group">
            <label for="task">Nome da Tarefa:</label>
            <input type="text" name="task" id="task" class="form-control" value="<?php echo $getTask['task']; ?>"
                   disabled/>

            <div class="form-group">
                <label for="employee">QA:</label>
                <select name="employee" id="employee" class="form-control" disabled>
                    <option selected><?php echo utf8_encode($getTask['name']); ?></option>
                </select>
            </div>

        <div class="form-group">
            <div class="radio">
                <label for="complexity">Complexidade:</label><br/>
                <?php
                foreach ($complexities as $complexity):
                    ?>
                    <label><input type="radio" name="complexity"
                                  value="<?php echo $complexity['id']; ?>"/><?php echo utf8_encode($complexity['fibonacci']); ?>
                    </label>
                <?php
                endforeach;
                ?>
            </div>
        </div>
        <br/>

        <input type="submit" value="Adicionar" class="btn btn-default"/>
    </form>

</div>