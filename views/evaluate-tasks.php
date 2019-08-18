<?php
if (empty($_SESSION['logged'])) {
    ?>
    <script type="text/javascript">window.location.href = "<?php echo BASE_URL; ?>login";</script>
    <?php
    exit;
}
?>
<div class="container">
    <h1>Tarefas - Avaliar Tarefa</h1>

    <form method="POST" enctype="multipart/form-data">

        <div class="form-group">
            <label for="time">Dias de atraso:</label>
            <input type="number" name="time" id="time" class="form-control" placeholder="0 a 99"/>
        </div>

        <div class="form-group">
            <div class="radio">
                <label for="automation">Rodou automação?</label><br/>
                    <label><input type="radio" name="automation" value="0" />Sim</label>
                    <label><input type="radio" name="automation" value="1"/>Não</label>
            </div>
        </div>

        <div class="form-group">
            <div class="radio">
                <label for="automation">Rodou lighthouse?</label><br/>
                <label><input type="radio" name="lighthouse" value="0" />Sim</label>
                <label><input type="radio" name="lighthouse" value="1"/>Não</label>
            </div>
        </div>

        <div class="form-group">
            <div class="radio">
                <label for="automation">Gerenciou o trello?</label><br/>
                <label><input type="radio" name="trello" value="0" />Sim</label>
                <label><input type="radio" name="trello" value="1"/>Não</label>
            </div>
        </div>

        <div class="form-group">
            <div class="radio">
                <label for="automation">Gerenciou o jira?</label><br/>
                <label><input type="radio" name="jira" value="0" />Sim</label>
                <label><input type="radio" name="jira" value="1"/>Não</label>
            </div>
        </div>

        <div class="form-group">
            <div class="radio">
                <label for="automation">Utilizou o testrail?</label><br/>
                <label><input type="radio" name="testrail" value="0" />Sim</label>
                <label><input type="radio" name="testrail" value="1"/>Não</label>
            </div>
        </div>

        <div class="form-group">
            <label for="time">Quantos bugs?</label>
            <input type="number" name="bugs" id="bugs" class="form-control" placeholder="0 a 99"/>
        </div>

        <div class="form-group">
            <div class="radio">
                <label for="automation">Houve bugs impactantes?</label><br/>
                <label><input type="radio" name="impact" value="1" />Sim</label>
                <label><input type="radio" name="impact" value="0"/>Não</label>
            </div>
        </div>

        <br/>

        <input type="submit" value="Emitir Avaliação" class="btn btn-default"/>
    </form>

</div>