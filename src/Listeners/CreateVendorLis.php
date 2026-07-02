<?php

namespace Zerp\Twilio\Listeners;

use App\Models\User;
use Zerp\Account\Events\CreateVendor;
use Zerp\Twilio\Services\SendMsg;

class CreateVendorLis
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(CreateVendor $event)
    {
        if (company_setting('Twilio New Vendor') == 'on') {

            $user = User::find($event->vendor->user_id);

            if (!empty($user->mobile_no)) {
                $uArr = [];

                SendMsg::SendMsgs($user->mobile_no, $uArr, 'New Vendor');
            }
        }
    }
}
