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
        $sql = "SELECT Question_ID,Question,Options FROM " . QUIZ_Q_AND_A . " WHERE Level = $level";
        $res = $this->db->connect()->query($sql);
        if (!empty($res)) {
            return $res;
        }
    }

    private function get_question_answer_by_id($id)
    {
        $sql = "SELECT * FROM " . QUIZ_Q_AND_A . " WHERE Question_ID=" . $id;
        $res = $this->db->connect()->query($sql);
        if (!empty($res)) {
            return $res;
        }
    }

    public function check_answer_is_correct($id, $selected_option)
    {
        $result = $this->get_question_answer_by_id($id);
        $correct_ans = array();
        if (!empty($result) && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($row['Correct_Answer'] === $selected_option) {
                    return true;
                } else {
                    $correct_ans['correct_option'] = $row['Correct_Answer'];
                    $correct_ans['explaination'] = $row['Explanations'];
                }
            }
        }
        return $correct_ans;
    }

    function is_mobile()
    {
        if (strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mobile') || strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'android')) {
           return true;
        } else {
           return false;
        }
    }
}
