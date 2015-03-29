<?php


/*
 * Atm Class
 *
 */
require_once 'classes/Model.php';
require_once 'classes/View.php';

class Atm{

    function __construct () {

        $this->Model = new Model;
        $this->View = new View;

    }

    /**
     * Withdraw cash
     *
     * @param RequestInterface $amount -- cash amount
     *
     * @return array Returns format as below:
     *
     *      status => {'success' : 'fail'}
     *      message => {'error message'}
     *      notes => {'note50' => <number>,
     *                'note20' => <number>
     *               }
     *
     */

	public function withdrawCash($amount = 0){

        if($amount == 0){

            $message =  'Could not support for withdrawing $'.$amount ;
            $this->View->displayError($message);
        }

        if($amount <= $this->Model->calcTotalCash()){

            $options = array();

            $ATMCashNotes = $this->Model->getATMCashNotes();
            
            for($i=1; $i <= $ATMCashNotes['50']; $i++){

                $y = $amount - $i * 50;

                if($y >= 0 && ($y % 20 === 0)) {
                    $j = (int) ($y / 20) ;
                    if($j <= $ATMCashNotes['20']){
                        $noteCombine['50'] = $i;
                        $noteCombine['20'] = $j;
                        $options[] = $noteCombine;
                    }
                }
            }

            if(((int)($amount % 20) == 0) && ((int)($amount / 20) <= $ATMCashNotes['20'])){
                $noteCombine['50'] = 0;
                $noteCombine['20'] = (int)($amount / 20);
                $options[] = $noteCombine;
            }

            $optResult = $this->selectResult($options);

            if(!empty($optResult)) {

                $this->Model->deductCash($optResult);

                echo "Dispensing Cash Notes: ";
                $this->View->displayNotes($optResult);

            }else{
                $message =  'Could not support for withdrawing $'.$amount ;
                $this->View->displayError($message);
            }


        }else{
            $message =  'Could not support for withdrawing $'.$amount ;
            $this->View->displayError($message);
        }
    }

    public function init($numOf50Notes = 0, $numOf20Notes = 0){

        $cashNotes = array();
        $cashNotes['50'] = $numOf50Notes;
        $cashNotes['20'] = $numOf20Notes;

        $this->Model->setCash($cashNotes);

        $this->status();

    }

    public function status(){

        $ATMCashNotes = $this->Model->getATMCashNotes();
        echo "ATM Cash Status: ";
        $this->View->displayNotes($ATMCashNotes);

    }


    public function addNotes50($numOfNotes = 0){

        $cashNotes = array('50'=>$numOfNotes,'20'=>0);

        $this->Model->addCash($cashNotes);

        $this->status();
    }

    public function addNotes20($numOfNotes = 0){

        $cashNotes = array('50'=>$numOfNotes,'20'=>0);

        $this->Model->addCash($cashNotes);

        $this->status();
    }


    /*
     * Select a cash notes combination based on different strategies.
     *
     * @param $option array -- 2 dimensions array, list of possible options, each item includes number of $50 and $20 notes.
     *
     * @return array  -- an array including the number of $50 and $20 notes
     */
	private function selectResult($options=array()){

        /*
         * optimise the possible result, try to make dispensing similar numbers of 20 and 50 notes for the withdraw.
         */

        $diff = 9999999;
        $optResult=array();
        foreach ($options as $option){
            if(abs($option['50'] - $option['20']) < $diff){
                $optResult = $option;
                $diff = abs($option['50'] - $option['20']);
            }
        }
        return $optResult;
    }


}
?>