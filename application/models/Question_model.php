<?php
/*
 * Generated by CRUDigniter v2.3 Beta
 * www.crudigniter.com
 */

class Question_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /*
     * Get question by question_id
     */
    function get_question($question_id)
    {
        $question = $this->db->query("
            SELECT
                *

            FROM
                `questions`

            WHERE
                `question_id` = ?
        ",array($question_id))->row_array();

        return $question;
    }

    /*
     * Get all questions
     */
    function get_all_questions()
    {
        $questions = $this->db->query("
            SELECT
                *

            FROM
                `questions`

            WHERE
                1 = 1
        ")->result_array();

        return $questions;
    }

    /*
     * function to add new question
     */
    function add_question($params)
    {
        $this->db->insert('questions',$params);
        return $this->db->insert_id();
    }

    /*
     * function to update question
     */
    function update_question($question_id,$params)
    {
        $this->db->where('question_id',$question_id);
        $response = $this->db->update('questions',$params);
        if($response)
        {
            return "question updated successfully";
        }
        else
        {
            return "Error occuring while updating question";
        }
    }

    /*
     * function to delete question
     */
    function delete_question($question_id)
    {
        $response = $this->db->delete('questions',array('question_id'=>$question_id));
        if($response)
        {
            return "question deleted successfully";
        }
        else
        {
            return "Error occuring while deleting question";
        }
    }
}
