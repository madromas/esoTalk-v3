<?php
if (!defined("IN_ESOTALK")) exit;
$form = $data["form"];
?>

<?php echo $form->open(); ?>
<div class='section'>
<ul class='form'>
  <li>
    <label>API KEY</label>
    <?php echo $form->input("apiKey", "text"); ?>
    <small>Apply key on <a href="https://akismet.com/" target="_blank">Akismet</a></small>
  </li>
  <li>
    <label>User post limitation</label>
    <?php echo $form->input("userPostLimit", "number"); ?>
    <small>Only check user's post who's post count less than this, empty this to always check.</small>
  </li>
</ul>
</div>
<div class='buttons'>
  <?php echo $form->saveButton("submit"); ?>
  <button class='button big' type='button' onclick="akismetTestKey(this.form.apiKey.value)">Test</button>
</div>
<?php echo $form->close(); ?>

<script>
function akismetTestKey(key) {
  $.ETAjax({
    url: 'admin/plugins/settings.ajax/Akismet',
    type: "post",
    data: {apiKey: key, test: true}
  });
}
</script>
