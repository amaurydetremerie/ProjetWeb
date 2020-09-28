 <section class="col-md-10">
     <?php if($notif=='Please complete all fields'){?>
         <div class="alert alert-danger">
             <p><?php echo $notif?></p>
         </div>
     <?php }
     if($notif=='An error is occured') {?>
         <div class="alert alert-warning">
             <p><?php echo $notif?></p>
         </div>
     <?php }?>
   <form method="POST">
    <fieldset>
    <legend>Create a question</legend>
    <em><?php echo $notif?></em>
    <h4> Title</h4>
    <input type="text" name="title" required>
    <h4>Category</h4>
    <select name="category">
        <?php for ($i = 0; $i < count($category_array); $i++) { ?>
                <option value="<?php echo $category_array[$i]->getIdCategory();?>"><?php echo $category_array[$i]->getName();}?></option>

    </select>
    <h4>Description</h4>
    <textarea name="subject" cols="50" rows="10" placeholder="Enter your text" required></textarea>
    <p><input type="submit" value="Create" class="btn-primary" name="submit"></p>
    </fieldset>
    </form>
 </section>
</div>