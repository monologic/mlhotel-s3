<?php
return array(
    // set your paypal credential
    'client_id' => 'AcToEEzy0IbkhTYSAKJOvybQJtgY-8xpfSo2y43_BHnDf9lE6Kcd52mtdyd3nI2LJYQDjxqVWSbAKSUx',
    'secret' => 'EAJmrb2fg0k2p9x9Eeusm7Iwe62W_Q0YiDWjo0KxKHQP69fLZe5zW7oyOcjH2vjIHAvi_HwXvrTTQUzZ',

    /**
     * SDK configuration 
     */
    'settings' => array(
        /**
         * Available option 'sandbox' or 'live'
         */
        'mode' => 'sandbox',

        /**
         * Specify the max request time in seconds
         */
        'http.ConnectionTimeOut' => 30,

        /**
         * Whether want to log to a file
         */
        'log.LogEnabled' => true,

        /**
         * Specify the file that want to write on
         */
        'log.FileName' => storage_path() . '/logs/paypal.log',

        /**
         * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
         *
         * Logging is most verbose in the 'FINE' level and decreases as you
         * proceed towards ERROR
         */
        'log.LogLevel' => 'FINE'
    ),
);