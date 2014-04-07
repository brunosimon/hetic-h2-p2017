<link rel="stylesheet" href="assets/css/chat.css">
<div id="wrap">
  <!-- Begin page content -->
  <div class="container">
    <div class="page-header">
      <h1>Come talk !</h1>
    </div>
    <p class="lead">
      <div class="chat"></div>
      <div class="form">
        <form class="form-send">
          <input type="text" class="input-medium send" placeholder="Your Message..." name="send">
          <input type="submit" class="btn btn-primary" value="Envoyer">
        </form>
      </div>
    </p>
    <div class="smileys">
    <?php
      include('config.php');
      foreach ($smiley as $key => $value) {
        echo '<img src="assets/images/smileys/'.$value.'.png" class="smiley" title="'.$key.'">';
      }
    ?>
    </div>
  </div>
  <div id="push"></div>
</div>

<div id="footer">
  <div class="container">
    <p class="muted credit">By <a href="#">Jean Yves</a> & <a href="#">Dac-Davy</a></p>
  </div>
</div>