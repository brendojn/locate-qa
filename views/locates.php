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
                        <label for="name_object">Objeto de locação:</label>
                        <select id="name_object" name="filters[name_object]" class="form-control">
                            <?php if (!isset($_GET['filters'])) : ?>
                                <option></option>
                            <?php endif; ?>
                            <?php foreach ($locates as $locate): ?>
                                <option value="<?php echo $locate['id']; ?>" <?php echo ($locate['id'] == $filters['name_object']) ? 'selected="selected"' : ''; ?>><?php echo utf8_encode($locate['name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <div class="form-group">
                        <?php if ($userLogged == 'admin') : ?>
                            <a href="<?php echo BASE_URL; ?>locates/add" class="btn btn-default">Adicionar Locação</a>
                        <?php endif; ?>
                        <?php if (!isset($_GET['filters'])) : ?>
                            <input type="submit" class="btn btn-info" value="Aplicar filtro(s)"/>
                        <?php endif; ?>
                        <?php if (isset($_GET['filters'])) : ?>
                            <a href="<?php echo BASE_URL; ?>locates" class="btn btn-outline-info">Limpar filtro(s)</a>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Classe</th>
            <th>Nome da locação</th>
            <th>Locatário</th>
            <th>Previsão de término</th>
            <th>Ações</th>
        </tr>
        </thead>
        <?php
        foreach ($locates as $locate):
            ?>
            <?php if (strpos($locate['name'], 'JARVIS') !== false): ?>
            <tr class="text-danger">
        <?php elseif (strpos($locate['name'], 'GHOSTNET') !== false): ?>
            <tr class="text-warning">
        <?php elseif (strpos($locate['name'], 'IPHONE') !== false): ?>
            <tr class="text-info">
        <?php elseif (strpos($locate['name'], 'ANDROID') !== false): ?>
            <tr class="text-success">
        <?php endif; ?>
            <?php if ($locate['environment'] === '1') : ?>
            <td><?php echo "Ambiente"; ?></td>
        <?php else : ?>
            <td><?php echo "Dispositivo"; ?></td>
        <?php endif; ?>
            <td><?php echo $locate['name']; ?></td>
            <td><?php echo $locate['user']; ?></td>
            <?php $prevision_date = explode(' ', $locate['prevision_date']); ?>
            <?php $prevision_date[0] = implode("/", array_reverse(explode("-", $prevision_date[0]))); ?>
            <td><?php echo $prevision_date[0] . " " . $prevision_date[1]; ?></td>

            <td>
                <?php if ($userLogged == 'admin' || $locate['user'] == 'admin') : ?>
                    <a href="<?php echo BASE_URL; ?>locates/edit/<?php echo $locate['id']; ?>"
                       class="btn btn-default">Editar</a>
                <?php endif; ?>
                <?php if (isset($locate['fk_locate_id'])) : ?>
                    <a href="<?php echo BASE_URL; ?>locates/info/<?php echo $locate['id']; ?>"
                       class="btn btn-info">Informações</a>
                <?php endif; ?>
                <?php if ($locate['prevision_date'] != NULL && $locate['user'] === $userLogged) : ?>
                    <a href="locates/deallocate?id=<?php echo $locate['id']; ?>"
                       class="btn btn-warning">Liberar Locação</a>
                <?php endif; ?>
            </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>