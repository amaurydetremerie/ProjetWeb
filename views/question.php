 <div class="col-md-10">
  <?php if($notification!='' && $notification!='Your voted is saved !'){?>
   <div class="alert alert-warning">
    <p><?php echo $notification?></p>
   </div>
  <?php }
     if($notification=='Your voted is saved !') {?>
   <div class="alert alert-success">
    <p><?php echo $notification?></p>
   </div>
   <?php }?>
  <h3> Question [<?php echo $state?>]</h3>
  <table class="table table-hover">
     <thead class="thead-dark">
        <tr>
            <th>Title</th>
            <th>Autor</th>
            <th>Subject</th>
        </tr>
     </thead>
     <tbody>
      <tr class="<?php echo $class?>">
        <td><?php echo $question->getTitle().' ['.$question->getState().']' ?></td>
        <td><?php echo $question->getUser()->getName().' '.$question->getUser()->getLastName(); ?></td>
        <td><?php echo $question->getSubject() ?>
            <br>
            <?php echo $question->getDate() ?>
        </td>

        <td>
            <?php
            if(!empty($session) && $session->getAdmin() == 1){
                if($question->getState() != 'D'){
                    echo '<a href="index.php?action=question&amp;id='.$question->getIdQuestion().'&amp;state=D" class="btn btn-warning" role="button">Duplicate</a>';
                }
                else{
                    if($question->getRightAnswer()->getSubject() != null){
                        echo '<a href="index.php?action=question&amp;id='.$question->getIdQuestion().'&amp;state=S" class="btn btn-warning" role="button">Solved</a>';
                    }
                    else{
                        echo '<a href="index.php?action=question&amp;id='.$question->getIdQuestion().'&amp;state=O" class="btn btn-warning" role="button">Open</a>';
                    }
                }
                if($question->getState() == 'O'){
                    echo '<a href="index.php?action=question&amp;id='.$question->getIdQuestion().'&amp;state=S" class="btn btn-success" role="button">Solved</a>';
                }
                if($question->getState() == 'S'){
                    echo '<a href="index.php?action=question&amp;id='.$question->getIdQuestion().'&amp;state=O" class="btn btn-light" role="button">Open</a>';
                }
                echo '<a href="index.php?action=edit&amp;id='.$question->getIdQuestion().'" class="btn btn-secondary" role="button">Edit</a>';
                echo '<a href="index.php?action=question&amp;id='.$question->getIdQuestion().'&amp;delete=true" class="btn btn-danger" role="button">Delete</a>';

            }
            if(!empty($session) && $question->getUser()->getIdMember()==$session->getIdMember() && $session->getAdmin() !=1){
                 if($question->getState() == 'O'){
                     echo '<a href="index.php?action=question&amp;id='.$question->getIdQuestion().'&amp;state=S" class="btn btn-success" role="button">Solved</a>';
                 }
                 if($question->getState() == 'S'){
                     echo '<a href="index.php?action=question&amp;id='.$question->getIdQuestion().'&amp;state=O" class="btn btn-light" role="button">Open</a>';
                 }
                 echo '<a href="index.php?action=edit&amp;id='.$question->getIdQuestion().'" class="btn btn-secondary" role="button">Edit</a>';
            }?>
        </td>
      </tr>
     </tbody>
   </table>
   <h3>Answer</h3>
   <table class="table table-hover">
     <thead class="thead-dark">
     <tr>
        <th>Vote</th>
        <th>Autor</th>
        <th>Subject</th>
     </tr>
    </thead>
    <tbody>
    <?php for ($i = 0; $i < count($answer_array); $i++) { ?>
        <tr>
            <td><a role="button" href="?action=question&amp;id=<?php echo $question->getIdQuestion()?>&amp;id_answer=<?php echo $answer_array[$i]->getIdAnswer()?>&amp;vote=Pos" class="btn btn-light" >+</a><?php echo $answer_array[$i]->getNbVotesPos()?>
                <a href="?action=question&amp;id=<?php echo $question->getIdQuestion()?>&amp;id_answer=<?php echo $answer_array[$i]->getIdAnswer() ?>&amp;vote=Neg" class="btn btn-light" role="button">-</a><?php echo $answer_array[$i]->getNbVotesNeg()?></td>
            <td>
                <?php echo $answer_array[$i]->getUser()->getName().' '.$answer_array[$i]->getUser()->getLastName(); ?>
            </td>
            <td>
                <?php echo $answer_array[$i]->getSubject(); ?>
                <br>
                <?php echo $answer_array[$i]->getDate(); ?>
            </td>
            <td><?php if(!empty($session) && $question->getUser()->getIdMember()==$session->getIdMember()){
                 echo'<a href="?action=question&amp;id='.$question->getIdQuestion().'&amp;rightAnswer='.$answer_array[$i]->getIdAnswer().'" class="btn btn-success" role="button">Right answer</a></td>';
                 }?>
            <td><?php if($answer_array[$i]->getIdAnswer()==$question->getRightAnswer()->getIdAnswer()){
                   echo'<img class="img-thumbnail" src="'.VIEWS_WAY.'images/right.png" alt="rightanswer">';
                }?>
            </td>
        </tr>
    <?php } ?>
    </tbody>
   </table>
    <h4>Reply</h4>
  <form method=POST>
    <textarea name="reply" placeholder="Enter your text" rows="10" cols="50" required></textarea>
    <p><input type="submit" class="btn-primary" value="submit"></p>
  </form>
 </div>
</div>