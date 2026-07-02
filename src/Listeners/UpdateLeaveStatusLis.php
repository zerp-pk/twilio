<?php

namespace Zerp\Twilio\Listeners;

use App\Models\User;
use Zerp\Hrm\Events\UpdateLeaveStatus;
use Zerp\Twilio\Services\SendMsg;


class UpdateLeaveStatusLis
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
    public function handle(UpdateLeaveStatus $event)
    {
        if (company_setting('Leave Approve/Reject') == 'on') {

            $leave    = $event->leave;
            $employee = User::where('id', '=', $leave->employee_id)->first();

            if (!empty($employee->phone)) {

                $uArr = [
                    'status' => $leave->status
                ];

                SendMsg::SendMsgs($employee->phone, $uArr, 'Leave Approve/Reject');
            }
        }
    }
}
