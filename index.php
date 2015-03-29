<?php
require_once 'classes/Atm.php';

if (isset($argv) && isset($argv[0])) {
    echo "ATM Cash Withdrawal Emulator \n";
    echo "Please choose following commands: \n\n";
    echo "withdraw <amount> \n";
    echo "status \n";
    echo "init <num of $50> <num of $20>\n";
    echo "add_50 <number of notes>\n";
    echo "add_20 <number of notes>\n";
    echo "exit \n";
    echo "\n";

    $atm = new Atm ;

    while (true) {

        $line = readline("> ");

        readline_add_history($line);

        if ($line == 'exit'){
            echo "\n";
            break;
        }else{
            $input = preg_split("/[\s,]+/", $line);
            switch ($input[0]) {

                case 'withdraw':
                    $atm->withdrawCash($input[1]);
                    break;

                case 'status':
                    $atm->status();
                    break;

                case 'init':
                    $atm->init($input[1], $input[2]);
                    break;

                case 'add_50':
                    $atm->addNotes50($input[1]);
                    break;

                case 'add_20':
                    $atm->addNotes20($input[1]);
                    break;

                default:
                    echo "Wrong command \n";
            }
        }
    }
}


?>