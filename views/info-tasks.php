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
                <label for="value">Valor pago pela tarefa:</label>
                <input type="text" name="value" id="value" class="form-control" value="<?php echo "R$ " . number_format($final_value, 2, ',', ' '); ?>"
                       disabled/>
            </div>

            <div class="form-group">
                <label for="value">Avaliador:</label>
                <input type="text" name="user_v" id="user_v" class="form-control" value=""
                       disabled/>
            </div>

            <div class="form-group">
                <label for="value">Pagador:</label>
                <input type="text" name="user_p" id="user_p" class="form-control" value="<?php echo $payments['fk_user_id'] ?>"
                       disabled/>
            </div>
            <br/>

    </form>

</div>