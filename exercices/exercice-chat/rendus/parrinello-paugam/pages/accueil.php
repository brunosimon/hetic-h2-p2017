<?php
    if(!empty($_POST['name']) && !empty($_POST['room_name'])){
        $author = $_POST['name'];
        $room_name = $_POST['room_name'];

        $query = $db->prepare("INSERT INTO chat_room (name, author) VALUES (:name, :author)");
        $query->bindvalue(':author', $author, PDO::PARAM_STR);
        $query->bindvalue(':name', $room_name, PDO::PARAM_STR);
        $query->execute();
    }
?>
<div class="container"><br/><br/><br/><br/>
    <div class="jumbotron">
        <h1>The Concept</h1>
        <p>You feel lonely? You talk about your environment or life events? Then create a ChatRoom and discuss!</p>
        <p>Create a ChatRoom to serve as subject!</p>
        <p><a class="btn btn-lg btn-primary" href="../../components/#navbar" role="button">Create a Room »</a></p>     
    </div>
    <div class="row">
        <div class="col-md-3">
            <table class="table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                <?php
                    $query = $db->query("SELECT * FROM chat_room");
                    while($value = $query->fetch()): ?>
                        <tr>
                          <td><?php echo $value['id']; ?></td>
                          <td><?php echo $value['name']; ?></td>
                          <td align="right"><a href="index.php?page=room&id=<?php echo $value['id']; ?>" class="btn btn-primary btn-xs">Entrer</a></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
          </table>
        </div>
        <div class="col-md-9">
            <div class="page-header">
                <h2><center>Create a Room</center></h2>
            </div>
            <form class="form-horizontal col-md-4 col-md-offset-4" method="POST" action="#">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Your Name ..." name="name" value="<?php if(isset($_SESSION['author'])){echo $_SESSION['author'];}?>">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Subject" name="room_name">
                </div>
                <center><input type="submit" class="btn btn-success btn-lg" value="Go !"></center>
            </form>
        </div>
    </div>
</div>
