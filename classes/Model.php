<?php
class Model {

    public $cashNotes;

    /*
     * Default initial cash notes as $50 -->10 , $20 -->10
     */

    function __construct () {

        $this->cashNotes = array('50'=>10,'20'=>10);
    }

    /*
     * Reset the Cash Notes number in ATM
     *
     * $param array $cashNotes -- number of $50, $20 notes
     *
     */

    public function setCash ($cashNotes = array()) {

        if(!empty($cashNotes)){
            $this->cashNotes = $cashNotes;
        }
    }

    /*
 * Deduct the cash notes
 *
 * $param array $noteCount -- including the number of $50 and $20 notes
 *
 */

    public function deductCash($noteCount = array()){

        $this->cashNotes['50'] -=  $noteCount['50'];
        $this->cashNotes['20'] -=  $noteCount['20'];
    }

    /*
     * Add Cash notes into ATM
     *
     * $param array $noteCount -- including the number of $50 and $20 notes
     */


    public function addCash($noteCount = array()){

        $this->cashNotes['50'] +=  $noteCount['50'];
        $this->cashNotes['20'] +=  $noteCount['20'];
    }



    /*
     * calculate the total amount of cash in ATM
     */

    public function calcTotalCash(){

        return $this->cashNotes['50']*50 + $this->cashNotes['20']*20;
    }

    public function getATMCashNotes(){
        return $this->cashNotes;
    }

}
?>