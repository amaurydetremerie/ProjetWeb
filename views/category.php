 <div class="col-md-2 bg-light">
  <h3>Categories</h3>
   <form>
    <table>
        <?php for ($i = 0; $i < count($category_array); $i++) { ?>
            <tr>
                <td><input type="submit" class="btn-light" value="<?php echo $category_array[$i]->getName(); ?>" name="category[<?php echo $category_array[$i]->getIdCategory(); ?>]"></td>
            </tr>
        <?php } ?>
    </table>
   </form>
  </div>