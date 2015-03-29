<?php
class View {

    /*
     * Display the number of cash notes.
     *
     * @param array $noteCount -- including the number of $50 and $20 notes
     */
    public function displayNotes($noteCount = array()){

        echo "[ $50 Notes => " . $noteCount['50'] . ",  $20 Notes => " . $noteCount['20'] . " ]" ;
        echo "\n";
    }

    /*
     * Display Error message
     *
     * $param $message
     */
    public function displayError($message = ''){

        echo "Error! " . $message . "\n";
    }

}
?>