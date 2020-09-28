<div class="col-md-10">
 <table>
    <tr>
        <th class="h3">Users</th>
    </tr>
    <?php
    $nb_user = 0;
    for ($i = 0; $i < count($user_array); $i++) {
        if($user_array[$i]->getAdmin()==1){
            $nb_user = $i;
            break;
        }
    ?>
    <tr>
        <td>
            <?php echo $user_array[$i]->getEmail(); ?>
        </td>
        <td>
            <?php
                if($user_array[$i]->getActivated() == 0){
                    echo '<a class="btn btn-success" role="button" href="?action=panel&amp;activated='.$user_array[$i]->getIdMember().'">Activate</a>';
                }
                else{
                    echo '<a class="btn btn-danger" role="button" href="?action=panel&amp;inactivated='.$user_array[$i]->getIdMember().'">Suspend</a>';
                }
            ?>
        </td>
        <td>
            <a class="btn btn-primary" role="button" href="?action=panel&amp;admin=<?php echo $user_array[$i]->getIdMember(); ?>">Set as administrator</a>
        </td>
    </tr>
    <?php } ?>
    <tr>
        <th class="h3">Administrator</th>
    </tr>
    <?php
    for ($i = $nb_user; $i < count($user_array); $i++) {
    ?>
    <tr>
        <td>
            <?php echo $user_array[$i]->getEmail(); ?>
        </td>
        <td>
            <?php
            if($user_array[$i]->getIdMember() != $session->getIdMember()){
                if($user_array[$i]->getActivated() == 0){
                    echo '<a role="button" class="btn btn-success" href="?action=panel&amp;activated='.$user_array[$i]->getIdMember().'">Activate</a>';
                }
                else{
                    echo '<a role="button" class="btn btn-danger" href="?action=panel&amp;inactivated='.$user_array[$i]->getIdMember().'">Suspend</a>';
                }
            }
            ?>
        </td>
    </tr>
    <?php } ?>
 </table>
</div>
</div>