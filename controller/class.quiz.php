<?php
require_once  dirname(__FILE__, 2) . '/config.php';
require_once ROOT_PATH_DB;
require_once ROOT_PATH_DBTABLES;

class Quiz
{

    private $db;
    function __construct()
    {
        $this->db = new Database();
    }

    public function get_questions_by_level($level)
    {
        $sql = "SELECT Question,Options FROM " . QUIZ_Q_AND_A . " WHERE Level = $level";
        $res = $this->db->connect()->query($sql);
        if(!empty($res)){
            return $res;
        }
    }
}
