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
                <h4>Filtros avançados</h4>
                <form method="GET">
                    <div class="col-xs-3 col-xs-offset-0">
                        <label for="employee">QA's:</label>
                        <select id="employee" name="filters[employee]" class="form-control">
                            <option></option>
                            <?php foreach ($employees as $employee): ?>
                                <option value="<?php echo $employee['id']; ?>" <?php echo ($employee['id'] == $filters['employee']) ? 'selected="selected"' : ''; ?>><?php echo utf8_encode($employee['name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-xs-3 col-xs-offset-1">
                        <label for="status">Status do plantão:</label>
                        <select id="status" name="filters[status]" class="form-control">
                            <option></option>
                            <option value="1-1" <?php echo ($filters['status'] == '1-1') ? 'selected="selected"' : ''; ?>>
                                Plantões pagos
                            </option>
                            <option value="1-0" <?php echo ($filters['status'] == '1-0') ? 'selected="selected"' : ''; ?>>
                                Plantões avaliados
                            </option>
                            <option value="0-0" <?php echo ($filters['status'] == '0-0') ? 'selected="selected"' : ''; ?>>
                                Plantões em aberto
                            </option>
                        </select>
                    </div>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <div class="form-group">
                        <a href="<?php echo BASE_URL; ?>dutys/add" class="btn btn-default">Adicionar Plantão</a>
                        <input type="submit" class="btn btn-info" value="Aplicar filtro(s)"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Semana</th>
            <th>QA</th>
            <th>Pontos</th>
            <th>Ações</th>
        </tr>
        </thead>
        <?php
        foreach ($dutys as $duty):
            ?>
            <tr>
                <td><?php echo $duty['week']; ?></td>
                <td><?php echo $duty['name']; ?></td>
                <td><?php echo "R$ " . $duty['points']; ?></td>
                <td>
                    <?php if ($duty['pay'] == 0 && $duty['evaluate'] == 0) : ?>
                        <a href="<?php echo BASE_URL; ?>dutys/edit/<?php echo $duty['week']; ?>"
                           class="btn btn-default">Editar</a>
                        <a href="dutys/delete?week=<?php echo $duty['week']; ?>"
                           class="btn btn-danger">Excluir</a>
                    <?php elseif($duty['pay'] == 0 && $duty['evaluate'] == 1): ?>
                        <a href="dutys/delete?week=<?php echo $duty['week']; ?>"
                           class="btn btn-danger">Excluir</a>
                    <?php endif; ?>
                    <?php if ($duty['evaluate'] == 0) : ?>
                        <a href="<?php echo BASE_URL; ?>dutys/evaluate/<?php echo $duty['id']; ?>"
                           class="btn btn-info">Avaliar</a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <ul class="pagination">
        <?php for ($q = 1; $q <= $total_pages; $q++): ?>
            <li class="<?php echo ($p == $q) ? 'active' : ''; ?>">
                <a href="<?php echo BASE_URL; ?>dutys?p=<?php echo $q; ?>"><?php echo $q; ?></a></li>
        <?php endfor; ?>
    </ul>
</div>