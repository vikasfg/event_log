<?php

namespace App\Data\Models;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class NotificationSend extends Eloquent
{
    protected $collection = "notification_send";
    //protected $connection = 'mongodb';


    static function getCustomersToSendSms($start = 0, $limit = 10, $smsPurpose) {
		
		 	$users = NotificationSend::where('mobilestatus', '1')
			->where('mobile', '!=', '')
			->where("purpose like '%".$smsPurpose."%'")
			->orderBy('id', 'ASC')
			->select("mobile", "mobilestatus", "firstname", "customer_id", "city", "purpose")
			->skip($start)	->take($limit)
			->get();

       //$users = NotificationSend::where('subscriber_email', '=', 'TKpWQsY6uT@gmail.com')->get();

		$data = array();
		if (!empty($users)) {
			foreach ($users as $user) {
				$data[] = $user;
			}
		}
         //dd(json_decode(json_encode($data)));
         return json_decode(json_encode($data));
		//return $data;
	}
  
	public $timestamps = false;

	/**
	 * Get all the orders group by status
	 *
	 */

	static function getCustomers($start = 0, $limit = 10, $mailPurpose) {
		$users = NotificationSend::where('emailstatus', '0')
			->where('subscriber_email', '!=', '')
			->where('purpose', 'like', '%'.$mailPurpose.'%')
			->orderBy('id', 'asc')
			->skip($start)	->take($limit)
			->get();

		$data = array();

		if (!empty($users)) {

			foreach ($users as $user) {

				$d['email']       = $user['subscriber_email'];
				$d['emailStatus'] = $user['emailstatus'];
				$d['firstname']   = $user['firstname'];
				$d['customer_id'] = $user['customer_id'];
				$d['purpose'] = $user['purpose'];
				$d['city'] = $user['city'];
				$data[]           = $d;

			}
		}

		return $data;
	}

	static function updateStatus($data) {
		$update = NotificationSend::where('subscriber_email', $data['email'])
			->update(['emailstatus' => $data['status'], 'send_time' => date('Y-m-d H:i:s')]);
		return $update;
	}

	static function updateMobileStatus($data) {
		$update = NotificationSend::where('mobile', $data['mobile'])
			->update(['mobilestatus' => $data['status'], 'send_time' => date('Y-m-d H:i:s')]);
		return $update;
	}

	static function getCustomersToSendSmsCount() {
		$users = NotificationSend::where('mobilestatus', '0')
			->where('mobile', '!=', '')
			->count();
		return $users;
	}
	/**
	 * argument todays Date
	 */
	static function getAllNotificationSmsSent() {
		$smses = NotificationSend::where('mobile', '!=', '')
			->orderBy('id', 'ASC')
			->selectRaw("count(mobile) As totalUser, sum(if(mobilestatus = 1, 1, 0)) AS totalSmsSent, purpose")
			->groupBy("purpose")
			->get();

		$data = array();

		if (!empty($smses)) {
			foreach ($smses as $sms) {
				$data[$sms['purpose']]['totalSms']     = $sms['totalUser'];
				$data[$sms['purpose']]['totalSmsSent'] = $sms['totalSmsSent'];
			}
		}

		return $data;
	}

	static function getAllNotificationMailsSent() {
		$smses = NotificationSend::where('subscriber_email', '!=', '')
			->orderBy('id', 'ASC')
			->selectRaw("count(subscriber_email) As totalUser, sum(if(emailstatus = 1, 1, 0)) AS totalMailsSent, purpose")
			->groupBy("purpose")
			->get();

		$data = array();

		if (!empty($smses)) {
			foreach ($smses as $sms) {
				$data[$sms['purpose']]['totalEmails']    = $sms['totalUser'];
				$data[$sms['purpose']]['totalMailsSent'] = $sms['totalMailsSent'];
			}
		}

		return $data;
	}

	static function getAllBuyersMobileByDate($date){
	$buyersData = NotificationSend::whereIn('mobile', function($query ) use ($date){	
		     				$query->select('telephone')
				   			->from('sales_flat_order_address')
				    		->whereRaw("created_at >= '".$date."' ");
				    	})
	                    ->where('mobilestatus','=',0)
	                    ->update(['mobilestatus' => -1]);
	 return $buyersData;             
 	}  

 	static function getAllBuyersEmailByDate($date){
    	$buyersEmailData = NotificationSend::whereIn('subscriber_email', function($query ) use ($date){	
		     				$query->select('email')
				   			->from('sales_flat_order_address')
				    		->whereRaw("created_at >= '".$date."' ");
				    	})
	                    ->where('emailstatus','=',0)
	                    ->update(['emailstatus' => -1]);
	    return $buyersEmailData;
 	}
}
