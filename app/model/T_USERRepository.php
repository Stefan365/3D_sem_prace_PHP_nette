<?php

namespace App\Model;

use Nette;

/**
 * Repozitář pro práci s VERES_T_USER_PHP.
 */
class T_USERRepository extends Nette\Object {

    /**
     *
     * @var Nette\Database\Context
     * @inject
     */
    private $database;

    public function __construct(\Nette\Database\Context $database) {
        $this->database = $database;
    }
    
    //1.
    /**
     * Vytvori tabulku VERES_T_USER_PHP. Sluzi na ukladanie udajov o zaregistrocanych uzivateloch
     * 
     */
    public function createTableUser() {
        $sql = "CREATE TABLE VERES_T_USER_PHP"
            . " (uid INTEGER NOT NULL AUTO_INCREMENT, first_name VARCHAR(30) NOT NULL,"
            . " last_name VARCHAR(30) NOT NULL,  birth_year VARCHAR(30) NOT NULL,"
            . " PRIMARY KEY(uid)) DEFAULT CHARSET=utf8";

        $this->database->query($sql);
    }

    //3.
    /**
     * Drop table in DB
     */
    public function dropTable($tn) {
        $this->database->query("DROP TABLE $tn");
    }
    
    
    //2. Inserting new values:
    /**
     * Vlozi do tab. VERES_T_USER novy riadok.
     * 
     * @param $fn first name
     * @param $ln last name
     * @param $by bitrh year
     */
    public function insertValuesUser($fn, $ln, $by) {

        $sql = "INSERT INTO VERES_T_USER_PHP (first_name, last_name, birth_year) VALUES (?, ?, ?)";
        $this->database->query($sql, $fn, $ln, $by);
        
    }
    
    

    //2.1
    /**
     * Upravi existujuce hodnoty v tab. T_USER.
     * 
     * @param uid user id
     * @param fn first name
     * @param ln last name
     * @param by birth year
     */
    public function updateValuesUser($uid, $fn, $ln, $by) {
        $sql = "UPDATE VERES_T_USER_PHP SET first_name = '$fn', "
            . "last_name= '$ln', "
            . "birth_year= '$by'"
            . " WHERE uid = $uid";

        $this->database->query($sql);
    }

    
    
    /**
     * gets users first name
     * @param uid id uzivatela
     */
    public function getUserFn($uid) {
        $fn = $this->database->query("SELECT first_name FROM VERES_T_USER_PHP WHERE uid = $uid")->fetch();
        return $fn->first_name;
    }
    
    //3.2  
    /**
     * gets users last name
     * @param uid id uzivatela
     */
    public function getUserLn($uid) {
        $ln = $this->database->query("SELECT last_name FROM VERES_T_USER_PHP WHERE uid = $uid")->fetch();
        return $ln->last_name;
    }
    
    //3.3  
    /**
     * gets users birth year
     * @param uid id uzivatela
     */
    public function getUserBy($uid) {
        $by = $this->database->query("SELECT birth_year FROM VERES_T_USER_PHP WHERE uid = $uid")->fetch();
        return $by->birth_year;
    }
    
    
    
    /**
     * Přidá uživatele do databáze.
     */
    public function addUser($form) {
        $val = $form->getValues();

        $sql = "INSERT INTO VERES_T_USER_PHP (first_name, last_name, birth_year) VALUES (?, ?, ?)";
        $this->database->query($sql, $val->fn, $val->ln, $val->by);
        
    }
    
    /**
     * Odstrani uzivatela z databáze.
     */
    public function removeUser($uid) {
        $this->database->query("DELETE FROM VERES_T_USER_PHP WHERE uid = $uid");
    }
    
    //4.
    /**
     * Vrati zoznam vsetkych userov.
     */
    public function findAllUsers() {
        $query = "SELECT uid, first_name, last_name, birth_year from VERES_T_USER_PHP";
        $result = $this->database->query($query)->fetchAll();
        return $result;
    }

    //4.
    /**
     * Vrati zoznam mien + id vsetkych zaregistrovanych userov v systeme, tj.
     * len tych ktori niesu Admini.(aby sa nemohli navzajom vymazat, resp.
     * upravovat si udaje)
     *
     * @return zoznam mien + id na tvorbu combo boxu.
     */
    public function getComboNames() {

        $comboNames = array();
        
        $query = "SELECT uid, first_name, last_name from VERES_T_USER_PHP";
        $rows = $this->database->query($query)->fetchAll();
        
        foreach ($rows as $row){
            $uid = $row->uid;
            $fn = $row->first_name;
            $ln = $row->last_name;
            $item = $uid . ", " . $fn . " " .$ln;
            array_push($comboNames, $item);
        }

        return $comboNames;
    }

    //5.
    /**
     * Ziska user id z nazvu combo polozky.
     *
     * @param cn combo item name
     * @return string of user id.
     */
    public function getIdFromComboName($cn) {
        //echo "<div id=podpatickaR>cn:*".$cn."*</div>";
        $zoz = explode(", ", $cn);
        $uid = $zoz[0];
        //echo "<div id=podpaticka>zoz0:*".$uid."*</div>";
        //echo "<div id=podpatickaR>zoz1:*".$zoz[1]."*</div>";
        
        return $uid;
    }

}
