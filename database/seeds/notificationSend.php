<?php

use Illuminate\Database\Seeder;

class notificationSend extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	for($i =1; $i<20 ; $i++) {
	        DB::table('notification_send')->insert([
	        	'id'            => $i,
	            'name'          => Str::random(10),
	            'email'         => Str::random(10).'@gmail.com',
	            "notificationid"=> "0",
	            "customer_id"   =>  Str::random(4),
	            "city"          => "",
	            "subscriber_email"=> Str::random(10).'@gmail.com',
	            "firstname"     => Str::random(10),
	            "emailstatus"   =>"0" ,
	            "mobile"        =>"",
	            "mobilestatus"  =>"0",
	            "send_time"     =>null,
	            "purpose"       =>"email_7jan_1t"
	        ]);
    	}
    }
}