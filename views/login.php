<div class="col-md-10">
<?php if($notif=='This user doesn\'t exist or is suspended'){?>
  <div class="alert alert-danger">
    <p><?php echo $notif?></p>
  </div>
<?php }
     if($notif=='Wrong password') {?>
  <div class="alert alert-warning">
    <p><?php echo $notif?></p>
  </div>
<?php }?>
<?php if($notif=='Login') {?>
    <div class="alert alert-info">
        <p><?php echo $notif?></p>
    </div>
<?php }?>
 <form method="POST">
    <h3>Mail</h3>
    <input type="email" name="email" required>
    <h3>Password</h3>
    <input type="password" name="password" required>
    <p><input class="btn-primary" type="submit" name="submit" value="submit"></p>
 </form>
</div>
</div>