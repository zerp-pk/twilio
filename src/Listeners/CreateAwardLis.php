<?php

namespace Zerp\Twilio\Listeners;

use App\Models\User;
use Zerp\Twilio\Services\SendMsg;
use Zerp\Hrm\Events\CreateAward;

class CreateAwardLis
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
    public function handle(CreateAward $event)
    {
        //twilio
        if (company_setting('Twilio New Award') == 'on') {

            $request = $event->request;
            $award   = $event->award;

            $emp = User::find($request->employee_id);

            if (!empty($emp->mobile_no)) {
                $uArr = [
                    'award_name' => $award->awardType->name,
                    'user_name'  => $emp->name,
                    'date'       => $request->award_date
                ];

                SendMsg::SendMsgs($emp->mobile_no, $uArr, 'New Award');
            }
        }
    }
}
