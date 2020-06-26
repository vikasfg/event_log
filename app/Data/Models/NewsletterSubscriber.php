<?php

namespace App\Data\Models;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\Log;

class NewsletterSubscriber extends Eloquent
{
    protected $collection = "newsletter_subscriber";

    	public $timestamps = false;

	/**
	 * Get all the orders group by status
	 *
	 */

	static function getSubscribers($date) {
		$orders = NewsletterSubscriber::whereRaw("date(created_at) between '".$date['startDate']."' AND '".$date['endDate']."'")
			->selectRaw("count(subscriber_id) AS Subscribers, date(created_at) AS DateCreated")
			->groupBy("dateCreated")
			->orderBy("dateCreated", "desc")
			->get();
		$data             = array();
		$totalSubscribers = 0;

		if (!empty($orders)) {
			foreach ($orders as $value) {
				$data[$value['DateCreated']] = $value['Subscribers'];
				$totalSubscribers += $value['Subscribers'];
			}
			$data['totalSubscribers'] = $totalSubscribers;
		}

		return $data;
	}

	static function getNewsletterSubscribers() {
		$customers = NewsletterSubscriber::selectRaw("customer_id AS customerId, subscriber_email AS email, subscriber_name AS name, mobile")
			->groupBy("email")
			->orderBy("subscriber_id", "desc")
			->get();

		$data = array();

		if (!empty($customers)) {
			foreach ($customers as $customer) {
				$data[] = $customer->toArray();
			}
		}
		return $data;
	}

	static function getTotalSubscribers() {
		return $customers = NewsletterSubscriber::distinct()->count('subscriber_email');
	}

	static function getTotalSubscribersMobile() {
		return $customers = NewsletterSubscriber::distinct()->count('mobile');
	}

	static function getMobileUnsubscribers() {

		$unsubs = NewsletterSubscriber::where('mobile_sub_status','=', '2')->select('mobile')->get();
		$data   = array();
		if (!empty($unsubs)) {
			foreach ($unsubs as $unsub) {
				$data[] = $unsub['mobile'];
			}
		}
		return json_decode(json_encode($data));
	}

	static function getEmailUnsubscribers() {

		$unsubs = NewsletterSubscriber::where('subscriber_status', '3')
			->select('subscriber_email')	->get();
		$data = array();
		if (!empty($unsubs)) {
			foreach ($unsubs as $unsub) {
				$data[] = $unsub['subscriber_email'];
			}
		}

		return $data;
	}

	static function getNewsletterCitySubscribers($cityid) {

		// $customers = NewsletterSubscriber::whereRaw("FIND_IN_SET(subscriber_cities, '".$cityid."')")
		// 	->whereRaw("mobile RLIKE '[0-9]{10}'")
		// 	->select("subscriber_email AS email", "subscriber_name AS name", "mobile")
		// 	->groupBy("mobile")
		// 	->get();
		$customers = NewsletterSubscriber::whereRaw("FIND_IN_SET(subscriber_cities, '".$cityid."')")
			->select("subscriber_email AS email", "subscriber_name AS name", "mobile")
			->get();

		$data = array();
		if (!empty($customers)) {
			foreach ($customers as $customer) {
				$data[] = $customer;
			}
		}

		return $data;
	}

	static function getAllEmails() {

		$customers = NewsletterSubscriber::whereRaw("subscriber_email != '' OR subscriber_email IS NOT NULL")->select("subscriber_email")->get();

		$data = array();
		if (!empty($customers)) {
			foreach ($customers as $customer) {
				$data[] = $customer['subscriber_email'];
			}
		}

		return $data;
	}

	static function getAllMobiles() {

		$customers = NewsletterSubscriber::whereRaw("mobile != '' OR mobile IS NOT NULL")->select("mobile")->get();

		$data = array();
		if (!empty($customers)) {
			foreach ($customers as $customer) {
				$data[] = $customer['mobile'];
			}
		}

		return $data;
	}

    static function updateNSBuyers($nsData){

        $i=$u=0;
        Log::info('NS Update Insert Cron Started');
        foreach ($nsData as $value) {
           $customerArray = array_filter((array)$value);
           if(NewsletterSubscriber::where('subscriber_id','=',$customerArray['subscriber_id'])->count() > 0)
            {
                NewsletterSubscriber::where('subscriber_id','=',$customerArray['subscriber_id'])->update($customerArray);
                $u++;
            }
            else
            {
                NewsletterSubscriber::insert($customerArray);
                $i++;
            }           
        }
        echo "NS Update Insert Cron End insert $i update $u";
        Log::info("NS Update Insert Cron End insert $i update $u");
    }
}
