<?php

namespace Zerp\Twilio\Listeners;

use App\Models\User;
use Zerp\FixEquipment\Events\CreateFixEquipmentLicense;
use Zerp\FixEquipment\Models\FixEquipmentAsset;
use Zerp\Twilio\Services\SendMsg;

class CreateFixEquipmentLicenseLis
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
    public function handle(CreateFixEquipmentLicense $event)
    {
        if (company_setting('Twilio New Licence') == 'on') {

            $license = $event->fixEquipmentLicense;

            $asset = FixEquipmentAsset::find($license->asset_id);
            $user  = User::find($license->created_by);

            if (!empty($user->mobile_no)) {
                $uArr = [
                    'name'   => $license->title,
                    'assets' => $asset->asset_name
                ];

                SendMsg::SendMsgs($user->mobile_no, $uArr, 'New Licence');
            }
        }
    }
}
