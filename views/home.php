 <div class="col-md-10">
<?php if(empty($_GET['category']))
       echo'<h3>Recents Questions</h3>';
      else
        echo '<h3>Question By Category</h3>'?>
  <table class="table">
    <thead>
      <tr>
       <th>Title</th>
       <th>Date</th>
      </tr>
    </thead>
    <tbody>
    <?php if(empty($question_array)){
        echo'<div class="alert alert-info">No question found</div>';
    } ?>
    <?php for ($i = 0; $i < count($question_array); $i++) { ?>
          <tr>
             <?php $url='index.php?action=question&amp;id='.$question_array[$i]->getIdQuestion();?>
             <td><a href="<?php echo $url ?>"> <?php echo $question_array[$i]->getTitle().' ['.$question_array[$i]->getState().']'?></a></td>
             <td><?php echo $question_array[$i]->getDate()?></td>
          </tr>
    <?php } ?>
    </tbody>
    <tfoot>
      <tr>
          <td colspan="2">Question Legend: [S]=solved [D]=Duplicate [O]=Open</td>
      </tr>
    </tfoot>
  </table>
 </div>
</div>
