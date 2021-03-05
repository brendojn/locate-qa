<?php
if (empty($_SESSION['logged'])) {
    ?>
    <script type="text/javascript">window.location.href = "<?php echo BASE_URL; ?>login";</script>
    <?php
    exit;
}
?>
<div class="container">
    <h1>Plantão - Avaliar Plantão</h1>

    <form method="POST" enctype="multipart/form-data">


        <div class="form-group">
            <div class="radio">
                <label for="automation">Marcou indevidamente um membro?</label><br/>
                <label><input type="radio" name="member" value="0" />Sim</label>
                <label><input type="radio" name="member" value="1"/>Não</label>
            </div>
        </div>

        <div class="form-group">
            <div class="radio">
                <label for="automation">Tagueou todos os bugs?</label><br/>
                <label><input type="radio" name="tag" value="0" />Sim</label>
                <label><input type="radio" name="tag" value="1"/>Não</label>
            </div>
        </div>

        <div class="form-group">
            <div class="radio">
                <label for="automation">Registrou a fonte?</label><br/>
                <label><input type="radio" name="font" value="0" />Sim</label>
                <label><input type="radio" name="font" value="1"/>Não</label>
            </div>
        </div>

        <div class="form-group">
            <label for="time">Houve bugs impactantes?</label>
            <input type="number" name="bugs" id="bugs" class="form-control" placeholder="0 a 99"/>
        </div>
        <br/>

        <input type="submit" value="Emitir Avaliação" class="btn btn-default"/>
    </form>

</div>