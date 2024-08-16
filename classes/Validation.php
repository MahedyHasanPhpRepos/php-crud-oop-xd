
<?php

include('../interfaces/ValidationInterface.php');

class Validation implements ValidationInterface
{

    public function checkEmptyField($data, $fields)
    {
        $err_message = null;
        foreach ($fields as $field):
            if (empty($data[$field])):
                $err_message .= "<p class='error'>$field field is required!</p>";
            endif;
        endforeach;

        return $err_message;
    }

    public function isValidName($name)
    {

        $pattern = "/^[a-zA-Z][a-zA-Z0-9 ]{0,19}$/";
        return preg_match($pattern, $name);

        // if()){
        //     return false ; 
        // }
    }


    public function isValidEmail($email)
    {
        $valid_1 = filter_var($email, FILTER_VALIDATE_EMAIL);
        if ($valid_1) {
            return  preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/", $valid_1);
        }
    }


    public function isValidNumberOnly($number)
    {
        
        $pattern = "/^[0-9]+$/";
        return preg_match($pattern, $number);
    }

    public function isValidTextOnly($text)
    {
        $pattern = "/^[a-zA-Z]+$/";
        return preg_match($pattern, $text);
    }

    public function isValidNote($note)
    {
        $wordCount = str_word_count($note, 0, "অআইঈউঊঋএঐওঔকখগঘঙচছজঝঞটঠডঢণতথদধনপফবভমযরলশষসহড়ঢ়য়");
        if ($wordCount >= 30) {
            return false ; 
        }
        
        return true ; 
    }

    public function isValidCity($city)
    {
        $pattern = "/^[a-zA-Z ]+$/";
        return preg_match($pattern, $city);
    }
}
