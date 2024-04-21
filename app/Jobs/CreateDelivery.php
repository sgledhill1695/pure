<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Subscription;
use App\Models\Delivery;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;


class CreateDelivery implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try{
            
            $subscriptions = Subscription::all();

            if ($subscriptions->count() > 0) {

                foreach ($subscriptions as $subscription) {

                    if (count($subscription->delivery) < 1) {

                        for ($i = 0; $i < 3; $i++) {
                            $days = 0;
                            if ($i === 0) {
                                $days = 30;
                            } elseif ($i === 1) {
                                $days = 60;
                            } elseif ($i === 2) {
                                $days = 90;
                            }

                            $delivery = new Delivery();
                            $delivery->subscription_id = $subscription->id;
                            $delivery->dog_id = $subscription->dog_id;
                            $delivery->recipe_id = $subscription->recipe_id;
                            $delivery->delivery_date = Carbon::parse($subscription->created_at)->addDays($days);
                            $delivery->save();
                            Log::info("Delivery for subscription ID {$subscription->id} has been completed.");
                        }
                    }
                }
            }

        } catch(\Exception $e){
            error_log("Error saving delivery: " . $e->getMessage());
        }
    }
}
