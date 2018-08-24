<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GetData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:data {deviceSN}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Request data from main serve';

    /**
     * The Device to be used in the command 
     *
     *
     * @var string
    */
    protected $device;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $retry = 0;
        $interval = 0;
        $is_connected = false;
        do{
            sleep($interval);
            // Check of Interent Here
            $is_connected = $this->checkInternet();
            $retry++;
            if($retry >= 2){
                $interval += 10;
                $retry = 0;
            }
            if($interval >= 30 ){
                // Here Delay time is 1 min now hung up no internet is available
                break;
            }
        } while(!$is_connected);
        if(!$is_connected){
            echo "Device Does not has any internet connection\n";
            echo "System stops By Here\n";
            echo "Adding Some Other Data for handle like offline Attendance\n On data we had before";
            #return;
        }
        //$device = $this->secret('Enter Device:');

        $deviceSN =$this->argument('deviceSN');
        //echo "Requesting Device is this:".$deviceSN;

         /**
          * Here Create the possible information to download the current student in the device 
          *
          * The Applciation is located in the Device
          */
        $remoteServe = curl_init();
        curl_setopt($remoteServe, CURLOPT_URL, "http://127.0.0.1:8081/activeStudentList/".$deviceSN);
        curl_setopt($remoteServe, CURLOPT_RETURNTRANSFER, 1);
        $res = curl_exec($remoteServe);
        curl_close($remoteServe);
        print($res);
    }

    /**
     * Function to Test if the device has Internet Access
     *
     * @return boolean
     */
    private function checkInternet(){
        echo "Sending request to www.google.com:80";
        $connected = @fsockopen("www.google.com", 80); 
                                        //website, port  (try 80 or 443)
        echo "\nResult is out: ".$connected."\nThanks\n";
        $is_conn = false;
        if ($connected){
            $is_conn = true; //action when connected
            fclose($connected);
        }else{
            $is_conn = false; //action in connection failure
        }
        return $is_conn;
    }
}
