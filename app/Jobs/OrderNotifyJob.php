<?php

namespace App\Jobs;

use App\Common\Log;
use App\Common\Util;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;


class OrderNotifyJob extends Job
{
    protected $order;
    protected $api_token;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($order,$api_token)
    {
        $this->order = $order;
        $this->api_token = $api_token;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $retryTimes = $this->attempts();
        if($retryTimes > 3){
            $this->fail();
        }
        if($retryTimes > 1 && $retryTimes <= 3){
            Log::info("job_process__retry__:order_id:" .$this->order->order_id." retry_times:".$retryTimes);
            $this->delay(Carbon::now()->addSecond(Config::get('global.job_delay_time')[$retryTimes]));
        }else{
            $data = Util::notify($this->order,$this->api_token);
            if($data){
                Log::info("job_process__done__:" . json_encode($data));
                $this->delete();
            }else{
                $this->delay(Carbon::now()->addSecond(Config::get('global.job_delay_time')[$retryTimes+1]));
            }
        }
    }

}
