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
            <input type="text" name="task" id="task" class="form-control" value="<?php echo $task['task']; ?>"
                   disabled/>

            <div class="form-group">
                <label for="employee">QA:</label>
                <select name="employee" id="employee" class="form-control" disabled>
                    <option selected><?php echo utf8_encode($task['name']); ?></option>
                </select>
            </div>

            <div class="form-group">
                <label for="value">Valor total a pagar:</label>
                <input type="number" name="value" id="value" class="form-control" placeholder="0 a 99"/>
            </div>
        <br/>

        <input type="submit" value="Realizar pagamento" class="btn btn-default"/>
    </form>

</div>