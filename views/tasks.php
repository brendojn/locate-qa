<?php
if(empty($_SESSION['logged'])) {
    ?>
    <script type="text/javascript">window.location.href="<?php echo BASE_URL; ?>login";</script>
    <?php
    exit;
}
?>
<div class="container">
    <h1>Tarefas</h1>

    <a href="<?php echo BASE_URL; ?>tasks/add" class="btn btn-default">Adicionar Tarefa</a>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>Nome</th>
            <th>Tester</th>
            <th>Complexidade</th>
            <th>Pontos</th>
            <th>Ações</th>
        </tr>
        </thead>
        <?php
        foreach($tasks as $task):
            ?>
            <tr>
                <td><?php echo $task['task']; ?></td>
                <td><?php echo $task['name']; ?></td>
                <td><?php echo $task['fibonacci']; ?></td>
                <td><?php echo $task['points']; ?> %</td>
                <td>
                    <a href="<?php echo BASE_URL; ?>tasks/edit/<?php echo $task['task']; ?>"class="btn btn-default">Editar</a>
                    <a href="tasks/delete?task=<?php echo $task['task']; ?>" class="btn btn-danger">Excluir</a>
                    <a href="<?php echo BASE_URL; ?>tasks/evaluate/<?php echo $task['id']; ?>"class="btn btn-info">Avaliar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>