<?php
if (empty($_SESSION['logged'])) {
    ?>
    <script type="text/javascript">window.location.href = "<?php echo BASE_URL; ?>login";</script>
    <?php
    exit;
}
?>
<div class="container">

    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-10 col-xs-offset-0">
                <form method="GET">

                    <div class="form-group">
                        <a href="<?php echo BASE_URL; ?>employees/add" class="btn btn-default">Adicionar QA</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Nome</th>
            <th>N° de tarefas testadas</th>
        </tr>
        </thead>
        <?php
        foreach ($employees as $employee):
            ?>
            <tr>
                <td><?php echo $employee['name']; ?></td>
                <td><?php echo $employee['tasks']; ?></td>
                <td>
                    <?php if ($employee['tasks'] == 0) : ?>
                    <a href="employees/delete?name=<?php echo $employee['name']; ?>"
                       class="btn btn-danger">Excluir</a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <ul class="pagination">
        <?php for ($q = 1; $q <= $total_pages; $q++): ?>
            <li class="<?php echo ($p == $q) ? 'active' : ''; ?>">
                <a href="<?php echo BASE_URL; ?>tasks?p=<?php echo $q; ?>"><?php echo $q; ?></a></li>
        <?php endfor; ?>
    </ul>
</div>