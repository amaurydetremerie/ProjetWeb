 <section class="col-md-10">
  <form  method="POST">
    <fieldset>
        <legend>Edit a Question</legend>
        <em><?php echo $notif?></em>
        <h4> Title</h4>
        <input type="text" name="title" value="<?php echo $question->getTitle()?>" required>
        <h4>Category</h4>
        <select name="category">
            <?php for ($i = 0; $i < count($category_array); $i++) { ?>
            <option value="<?php echo $category_array[$i]->getIdCategory();?>"><?php echo $category_array[$i]->getName();}?></option>
        </select>
        <h4>Description</h4>
        <textarea name="subject" cols="50" rows="10" required><?php echo $question->getSubject()?></textarea>
        <p><input type="submit" class="btn-primary" value="Edit" name="submit"></p>
    </fieldset>
  </form>
 </section>
</div>
