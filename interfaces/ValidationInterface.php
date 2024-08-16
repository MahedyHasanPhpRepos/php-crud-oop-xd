<?php

interface ValidationInterface
{
    public function checkEmptyField($data, $fields);
    public function isValidName($name);
    public function isValidEmail($email);
    public function isValidNumberOnly($number) ; 
    // public function isValidEntryByNumberOnly($number);
    // public function isValidAmountNumberOnly($number);
    // public function isValidPhoneNumberOnly($number);
    public function isValidTextOnly($phone);

    public function isValidNote($note);
    public function isValidCity($city);
}
