
ATM-Simulation
===================

A demo for ATM cash dispensing. The app has been implemented in PHP, and running on PHP command line. 

DESIGN
======

The application are design as a Model-View-Controller pattern. Even if it's a bit heavy for this simple app.

The application include 1 User command, and other 4 admin commands. For the testing convenient, all those commands have been including in one user interface. 


In the classes directory:

Atm.php  -- Controller, implements all the user requests, process the data returned from models and load views.
 
Model.php -- Model, services Data access, update. There is no DB included, the number of ATM Cash works as a public variable. 

View.php -- View, display the information for response.


Usage
=====
*the app will run from php-cli in a terminal of mac, windows, or linux.

$ php index.php

ATM Cash Withdrawal Emulator 
Please choose following commands: 

withdraw <amount>

status
 
init <num of $50> <num of $20>

add_50 <number of notes>

add_20 <number of notes>

exit 

>
