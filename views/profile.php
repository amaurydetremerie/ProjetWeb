 <div class="col-md-10">
  <table class="table">
    <thead>
       <tr>
         <th>Title</th>
         <th>Date</th>
       </tr>
    </thead>
    <tbody>
    <?php for ($i = 0; $i < count($question_array); $i++) { ?>
        <tr>
            <?php $url='index.php?action=question&amp;id='.$question_array[$i]->getIdQuestion();?>
            <td><a href="<?php echo $url ?>"> <?php echo $question_array[$i]->getTitle()?></a></td>
            <td><?php echo $question_array[$i]->getDate()?></td>
        </tr>
    </tbody>
    <?php } ?>
     <tfoot>
      <tr>
          <td colspan="2">Question Legend: [S]=solved [D]=Duplicate [O]=Open</td>
      </tr>
     </tfoot>
  </table>
 </div>
</div>