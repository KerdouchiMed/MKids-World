    <!-- Contenue principale -->
    <div class="col-xs-12 col-sm-12 col-md-12" id="content">
      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="panel-title">
        suggestion
        <?php lockButtonHtml("suggestion"); ?>
      </div>
    </div>
    <div class="panel-body">
      <?php lockerDivHtml("suggestion"); ?>
      <div class="row">
        <?php
        if(isset($_GET['id']))
        {
          $req = "SELECT * FROM videos WHERE channel_id = :this_id ORDER BY name LIMIT 4";
          $rep = $bdd->prepare($req);
          $rep->execute(array(":this_id" => $channel_id));
          while($row = $rep->fetch())
          {
              dynamicThumbnailWithoutTitle($row['name'],$row['image_link'],'videos.php?id='.$row['id'],6,4,6);
          }

          $req = "SELECT * FROM videos WHERE channel_id <> :this_id ORDER BY name LIMIT 4";
          $rep = $bdd->prepare($req);
          $rep->execute(array(":this_id" => $channel_id));
          while($row = $rep->fetch())
          {
              dynamicThumbnailWithoutTitle($row['name'],$row['image_link'],'videos.php?id='.$row['id'],6,4,6);
          }
        }
        ?>
      </div>
    </div>
  </div>
</div>
