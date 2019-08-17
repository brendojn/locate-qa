<div class="container-fluid">

    <div class="row">
        <div class="col-sm-3">
            <h4>Pesquisa Avançada</h4>
            <form method="GET">
                <div class="form-group">
                    <label for="employee">QA's:</label>
                    <select id="employee" name="filtros[employee]" class="form-control">
                        <option></option>
                        <?php foreach ($employees as $employee): ?>
                            <option value="<?php echo $employee['id']; ?>" <?php echo ($employee['id'] == $filters['employee']) ? 'selected="selected"' : ''; ?>><?php echo utf8_encode($employee['name']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-info" value="Buscar"/>
                </div>
            </form>


</div>