 <div class="col-md-10">
     <?php if($notif=='This user already exists'){?>
         <div class="alert alert-danger">
             <p><?php echo $notif?></p>
         </div>
     <?php }
     if($notif=='Please complete all fields') {?>
         <div class="alert alert-warning">
             <p><?php echo $notif?></p>
         </div>
     <?php }?>
     <?php if($notif=='Register') {?>
         <div class="alert alert-info">
             <p><?php echo $notif?></p>
         </div>
     <?php }?>
     <?php if($notif=='An error is occured') {?>
         <div class="alert alert-danger">
             <p><?php echo $notif?></p>
         </div>
     <?php }?>
  <form method="POST">
    <h3>Name</h3>
    <input type="text" name="name">
    <h3>Last Name</h3>
    <input type="text" name="last_name">
    <h3>E-Mail</h3>
    <input type="email" name="email">
    <h3>Password</h3>
    <input type="password" name="password">
    <p><input class="btn-primary" type="submit" name="submit" value="submit"></p>
  </form>
 </div>
</div>