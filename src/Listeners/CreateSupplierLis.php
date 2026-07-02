<?php

namespace Zerp\Twilio\Listeners;

use Zerp\CMMS\Events\CreateSupplier;
use Zerp\Twilio\Services\SendMsg;

class CreateSupplierLis
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
    public function handle(CreateSupplier $event)
    {
        if (company_setting('Twilio New Supplier') == 'on') {

            $request = $event->request;
            $user    = $request->name;
            $to      = \Auth::user()->mobile_no;

            if (!empty($user) && !empty($to)) {
                $uArr = [
                    'user_name' => $user,
                ];

                SendMsg::SendMsgs($to, $uArr, 'New Supplier');
            }
        }
    }
}
