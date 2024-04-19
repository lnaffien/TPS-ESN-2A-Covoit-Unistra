<?php

class Concordance
{
    private $_date;
    private $_friends = array();

    public function __construct($date, $friends)
    {
        $this->_date = $date;
        $this->_friends[] = $friends;
    }

    public function __add_users($user)
    {
        $_friends = array_merge($_friends, $user);
    }

    public function __remove_users($user)
    {
        // = array_diff($_friends, $user);
    }

    public function __compare()
    {

    }

}

?>