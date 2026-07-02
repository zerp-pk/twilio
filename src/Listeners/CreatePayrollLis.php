<?php

namespace Zerp\Twilio\Listeners;

use Zerp\Hrm\Events\CreatePayroll;
use Zerp\Twilio\Services\SendMsg;

class CreatePayrollLis
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
    public function handle(CreatePayroll $event)
    {
        if (company_setting('Twilio New Monthly Payslip') == 'on') {

            $payslipEmployee = $event->payroll;
            $month           = date('M Y', strtotime($payslipEmployee->salary_month . ' ' . $payslipEmployee->time));

            $to = \Auth::user()->mobile_no;

            if (!empty($to)) {
                $uArr = [
                    'month' => $month
                ];

                SendMsg::SendMsgs($to, $uArr, 'New Monthly Payslip');
            }
        }
    }
}
