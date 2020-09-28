<?php
/**
 * Created by PhpStorm.
 * User: ahmad
 * Date: 29-03-19
 * Time: 08:34
 */
class Db{

    private static $instance = null;
    private $_db;

    /**
     * Db constructor.
     */
    private function __construct()
    {
        $config = parse_ini_file("config/config.ini");
        try {
            $this->_db = new PDO('mysql:host='.$config['db_host'].';dbname='.$config['db_name'].';charset=utf8',$config['db_user'],$config['db_password']);
            $this->_db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $this->_db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
        }
        catch (PDOException $e) {
            die('Fail to connect to the database: '.$e->getMessage());
        }

    }

    /**
     * Pattern Singleton
     */
    public static function getInstance(){
        if(is_null(self::$instance)){
            self::$instance=new Db();
        }
        return self::$instance;
    }

    #Function that SELECT questions from the db with and return a array of questions object
    #Keyword is not necessary
    public function select_questions($keyword='')
    {
        if ($keyword != '') {
            $keyword = str_replace("%", "\%", $keyword);
            $query = "SELECT * FROM questions WHERE title like :keyword OR subject like :keyword ORDER BY id_question DESC ";
            $ps = $this->_db->prepare($query);
            $ps->bindValue('keyword', "%$keyword%");
        } else {
            $query = 'SELECT * FROM questions ORDER BY id_question DESC';
            $ps = $this->_db->prepare($query);
        }
        $ps->execute();
        $array = array();
        while ($row = $ps->fetch()) {
            $answer = $this->select_right_answers($row->right_answer);
            $array[] = new Question($row->id_question, $row->title, $row->subject, $row->date, $row->state,$answer,null);
        }
        return $array;
    }

    #Function that SELECT questions from the db with the id of the user and return a array of questions object
     public function select_question_member($id){
         $query="SELECT * FROM questions WHERE id_member=:id";
         $ps= $this->_db->prepare($query);
         $ps->bindValue(':id',$id);
         $ps->execute();
         $array=array();
         while($row=$ps->fetch()){
             $answer = $this->select_right_answers($row->right_answer);
             $array[]= new Question($row->id_question, $row->title, $row->subject, $row->date, $row->state, $answer,null);
         }
         return $array;

     }

    #Function that UPDATE question in the db
    public function edit_question($title,$category,$subject,$id){
        $query= "UPDATE questions SET title=:title,id_category=:category,subject=:subject WHERE id_question= :id";
        $ps=$this->_db->prepare($query);
        $ps->bindValue(':title',$title);
        $ps->bindValue(':category',$category);
        $ps->bindValue(':subject',$subject);
        $ps->bindValue(':id',$id);
        return $ps->execute();
    }

    #Function that SELECT ONE question from the db and return a question object
    public function question_id($id){
        $query= "SELECT * FROM questions WHERE id_question = :id";
        $ps= $this->_db->prepare($query);
        $ps->bindValue(':id',$id);
        $ps->execute();
        $row=$ps->fetch();
        return $question= new Question($row->id_question,$row->title,$row->subject,$row->date,$row->state,$this->select_right_answers($row->right_answer),$this->select_user_id($row->id_member));
    }

    #Function that SELECT answers from the db and return a array of answer object
    public function select_answers($id){
        $query= "SELECT *  FROM answers WHERE id_question = :id ORDER BY id_answer ASC ";
        $ps= $this->_db->prepare($query);
        $ps->bindValue(':id',$id);
        $ps->execute();
        $array= array();

        while($row=$ps->fetch()){
            $member = $this->select_user_id($row->id_member);
            $array[]= new Answer($row->id_answer,$row->subject,$row->date,$member,$this->count_vote_Pos($row->id_answer),$this->count_vote_Neg($row->id_answer));
        }
        return $array;

    }

    #Function that SELECT the right answer from the db and return an answer object
    public function select_right_answers($id){
        $query= "SELECT * FROM answers WHERE id_answer = :id";
        $ps= $this->_db->prepare($query);
        $ps->bindValue(':id',$id);
        $ps->execute();
        $answer = new Answer(0,null,null,null,null,null);

        while($row=$ps->fetch()){
            $member = $this->select_user_id($row->id_member);
            $answer= new Answer($row->id_answer,$row->subject,$row->date,$member,null,null);
        }
        return $answer;
    }

    #Function that UPDATE questions in the db to choose the right answer
    public function choose_right_answer($id_question,$id_answer){
        $query='UPDATE questions SET right_answer=:id_answer WHERE id_question= :id_question';
        $ps= $this->_db->prepare($query);
        $ps->bindValue('id_question',$id_question);
        $ps->bindValue('id_answer',$id_answer);
        return $ps->execute();

    }
    #Function that delete the rightAnswer associated to one question when this one is changed to the state Open
    public function delete_right_answer($id_question){
        $query='UPDATE questions SET right_answer=null WHERE id_question=:id_question';
        $ps= $this->_db->prepare($query);
        $ps->bindValue('id_question',$id_question);
        return $ps->execute();
    }

    #Function that SELECT a member from the db with his id and return a member object
    public function select_user_id($id){
        $query = 'SELECT * from members WHERE id_member=:id';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id',$id);
        $ps->execute();
        $row=$ps->fetch();
        return $member = new Member($row->id_member, $row->name, $row->last_name, $row->email, $row->password, $row->admin, $row->activated);
    }

    #Function that SELECT questions of a category from the db and return a array of questions object
    public function select_questions_category($category){
        $query= "SELECT * FROM questions WHERE id_category = $category ORDER BY id_question DESC ";
        $ps= $this->_db->prepare($query);
        $ps->execute();
        $array= array();

        while($row=$ps->fetch()){
            $array[]= new Question($row->id_question,$row->title,$row->subject,$row->date,$row->state,$this->select_right_answers($row->right_answer),null);
        }
        return $array;

    }

    #Function that SELECT categories from the db and return a array of category object
    public function select_category(){
        $query= "SELECT * FROM categories";
        $ps= $this->_db->prepare($query);
        $ps->execute();
        $array= array();
        while($row=$ps->fetch()){
            $array[]= new Category($row->id_category,$row->name);
        }
        return $array;

    }

    #Function verify if the user exist
    public function exist_user($email){
        $query = 'SELECT * from members WHERE email=:email';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':email',$email);
        $ps->execute();
        if($ps->rowCount() == 0){
            return false;
        }
        return true;
    }

    #Function that INSERT new user in the DB
    public function register_user($name, $last_name, $email, $password){
        $query = 'INSERT INTO members (name, last_name, email, password, activated, admin) VALUES (:name, :last_name, :email, :password, 1, 0)';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':name',$name);
        $ps->bindValue(':last_name',$last_name);
        $ps->bindValue(':email',$email);
        $ps->bindValue(':password',$password);
        return $ps->execute();
    }

    #Function that create a question
    public function create_question($title,$category,$subject){
        $query= 'INSERT INTO questions(title,subject,id_category,id_member,date,state) VALUES (:title,:subject,:id_category,:id_member,current_date ,"O")';
        $ps=$this->_db->prepare($query);
        $ps->bindValue(':title',$title);
        $ps->bindValue(':id_category',$category);
        $ps->bindValue(':subject',$subject);
        $ps->bindValue(':id_member',$_SESSION['member']->getIdMember());
        return $ps->execute();
    }

    #Function that create an answer
    public function create_answer($reply,$id){
        $query= 'INSERT INTO answers(id_member,id_question,subject,date) VALUES(:id_member,:id_question,:subject,current_date)';
        $ps=$this->_db->prepare($query);
        $ps->bindValue(':id_member',$_SESSION['member']->getIdMember());
        $ps->bindValue(':id_question',$id);
        $ps->bindValue(':subject',$reply);
        return $ps->execute();
    }

    #Function that SELECT user from the db and verify if is suspended or if is exist
    public function active_user($email){
        $query = 'SELECT activated from members WHERE email=:email';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':email',$email);
        $ps->execute();
        if($ps->rowCount() == 0){
            return false;
        }
        if($ps->fetch()->activated == 0){
            return false;
        }
        return true;
    }

    #Function that SELECT user from the db and verify if the password is good
    public function connect_user($email, $password){
        $query = 'SELECT * from members WHERE email=:email';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':email',$email);
        $ps->execute();
        while($row=$ps->fetch()){
            $member = new Member($row->id_member, $row->name, $row->last_name, $row->email, $row->password, $row->admin, $row->activated);
        }
        if(password_verify($password, $member->getPassword())){
            $_SESSION['member'] = $member;
            return true;
        }
        return false;
    }


#PANEL CONTROLLER

    #Function that SELECT users from the db and create a array of member object
    public function select_all_user(){
        $query= "SELECT * FROM members ORDER BY admin ASC";
        $ps= $this->_db->prepare($query);
        $ps->execute();
        $array= array();
        while($row=$ps->fetch()){
            $array[]= new Member($row->id_member, $row->name, $row->last_name, $row->email, $row->password, $row->admin, $row->activated);
        }
        return $array;
    }

    #Function that UPDATE users in the db and activate his account
    public function activate_user($id){
        $query = "UPDATE members SET activated = 1 WHERE id_member = :id";
        $ps= $this->_db->prepare($query);
        $ps->bindValue(':id',$id);
        return $ps->execute();
    }

    #Function that UPDATE users in the db and inactivate his account
    public function inactivate_user($id){
        $query = "UPDATE members SET activated = 0 WHERE id_member = :id";
        $ps= $this->_db->prepare($query);
        $ps->bindValue(':id',$id);
        return $ps->execute();
    }

    #Function that UPDATE users in the db and set him administrator
    public function set_admin($id){
        $query = "UPDATE members SET admin = 1 WHERE id_member = :id";
        $ps= $this->_db->prepare($query);
        $ps->bindValue(':id',$id);
        return $ps->execute();
    }


#CHANGEMENT ETAT QUESTION + SUPPRESSION

    #Function that UPDATE question in the db and change state of the question
    public function state($id, $state){
        $query = "UPDATE questions SET state = :state WHERE id_question = :id";
        $ps= $this->_db->prepare($query);
        $ps->bindValue(':id',$id);
        $ps->bindValue(':state',$state);
        return $ps->execute();
    }

    #Function that DELETE question in the db
    public function delete_question($id){
        $query1="UPDATE questions SET right_answer = NULL WHERE id_question = :id";
        $ps1= $this->_db->prepare($query1);
        $ps1->bindValue(':id',$id);
        if($ps1->execute()){
            if($this->delete_answer($id)){
                $query2 = "DELETE FROM questions WHERE id_question = :id";
                $ps2= $this->_db->prepare($query2);
                $ps2->bindValue(':id',$id);
                return $ps2->execute();
            }
            return false;
        }
        return false;
    }
    #Function that DELETE answers in the db
    private function delete_answer($id){
        $array = $this->select_answers($id);
        foreach($array as $answer){
            if(!$this->delete_vote($answer->getIdAnswer())){
                return false;
            }
        }
        $query = "DELETE FROM answers WHERE id_question = :id";
        $ps= $this->_db->prepare($query);
        $ps->bindValue(':id',$id);
        return $ps->execute();
    }
    #Function that DELETE votes in the db
    private function delete_vote($id){
        $query = "DELETE FROM votes WHERE id_answer = :id";
        $ps= $this->_db->prepare($query);
        $ps->bindValue(':id',$id);
        return $ps->execute();
    }


#VOTE
    #Function that MAKE or CHANGE vote positive in the db
    public function vote_Pos($id_answer,$id_member){
        if($this->select_vote($id_answer,$id_member)->getValue() == 'N'){
            $query="UPDATE votes SET val = 'P' WHERE id_member = :id_member AND id_answer = :id_answer";
        }
        else{
            $query="INSERT INTO votes(id_member,id_answer,val) VALUES(:id_member,:id_answer,'P')";
        }
        $ps= $this->_db->prepare($query);
        $ps->bindValue(':id_answer',$id_answer);
        $ps->bindValue(':id_member',$id_member);
        return $ps->execute();
    }

    #Function that MAKE or CHANGE vote negative in the db
    public function vote_Neg($id_answer,$id_member){
        if($this->select_vote($id_answer,$id_member)->getValue() == 'P'){
            $query="UPDATE votes SET val='N'WHERE id_member = :id_member AND id_answer = :id_answer";
        }
        else{
            $query="INSERT INTO votes(id_member,id_answer,val) VALUES(:id_member,:id_answer,'N')";
        }
        $ps= $this->_db->prepare($query);
        $ps->bindValue(':id_answer',$id_answer);
        $ps->bindValue(':id_member',$id_member);
        return $ps->execute();
    }

    #Function that verify if the user has already voted
    public function select_vote($id_answer,$id_member){
        $query="SELECT * FROM votes WHERE id_answer = :id_answer AND id_member = :id_member";
        $ps= $this->_db->prepare($query);
        $ps->bindValue(':id_answer',$id_answer);
        $ps->bindValue(':id_member',$id_member);
        $ps->execute();
        if($ps->rowCount() == 0){
            return $vote= new Vote(null);
        }
        $row=$ps->fetch();
        return $vote = new Vote($row->val);
    }

    #Function that SELECT positive votes from the db for one answer
    public function count_vote_Pos($id_answer){
        $query="SELECT count(val) as pos FROM votes WHERE id_answer=:id_answer AND val='P'";
        $ps=$this->_db->prepare($query);
        $ps->bindValue('id_answer',$id_answer);
        $ps->execute();
        $pos=$ps->fetch();
        return $pos->pos;
    }

    #Function that SELECT negative votes from the db for one answer
    public function count_vote_Neg($id_answer){
        $query="SELECT count(val) as neg FROM votes WHERE id_answer=:id_answer AND val='N'";
        $ps=$this->_db->prepare($query);
        $ps->bindValue('id_answer',$id_answer);
        $ps->execute();
        $neg=$ps->fetch();
        return $neg->neg;

    }
}