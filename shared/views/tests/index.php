<?= $v->layout("layouts/tests") ?>

<?= $v->start("content") ?>
<div style="width:100%;padding:100px 0; text-align:center;">
    <h4>VIEW INDEX</h4>
</div>
<?= $v->end("content") ?>

<?= $v->start("styles") ?>
<style>
    .bg {
        background: red;
    }
</style>
<?= $v->end("styles") ?>

<?= $v->start("scripts") ?>
<script>
    console.log("Ola Mundo");
</script>
<?= $v->end("scripts") ?>

<?= $v->start("jujubas") ?>
<h2>Jujubas</h2>
<?= $v->end("jujubas") ?>