<?php
if (empty($_SESSION['logged'])) {
    ?>
    <script type="text/javascript">window.location.href = "<?php echo BASE_URL; ?>login";</script>
    <?php
    exit;
}
?>
<div class="container">
    <h1>Tarefas - Histórico</h1>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>Descrição</th>
                <th>Data de Criação</th>
            </tr>
            </thead>
            <?php
            foreach ($logs as $log):
                ?>
                <tr>
                    <td><?php echo $log['description']; ?></td>
                    <td><?php echo $log['created_at']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>


        <br/>

</div>