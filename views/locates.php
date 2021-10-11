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
                        <input type="submit" class="btn btn-info" value="Aplicar filtro(s)"/>
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
        </tr>
        </thead>
        <?php
        foreach ($locates as $locate):
            ?>
            <tr>
                <?php if ($locate['environment'] === '1') : ?>
                    <td><?php echo "Ambiente"; ?></td>
                <?php else : ?>
                    <td><?php echo "Dispositivo"; ?></td>
                <?php endif; ?>
                <td><?php echo $locate['name']; ?></td>
                <td><?php echo $locate['user']; ?></td>
                <td><?php echo implode("/",array_reverse(explode("-",$locate['prevision_date']))); ?></td>


                <td>
                    <?php if ($locate['user'] == 'admin') : ?>
                    <a href="<?php echo BASE_URL; ?>locates/edit/<?php echo $locate['id']; ?>"
                       class="btn btn-default">Editar</a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>