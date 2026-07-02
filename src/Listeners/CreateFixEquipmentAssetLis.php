<?php

namespace Zerp\Twilio\Listeners;

use App\Models\User;
use Zerp\FixEquipment\Events\CreateFixEquipmentAsset;
use Zerp\FixEquipment\Models\FixEquipmentLocation;
use Zerp\Twilio\Services\SendMsg;

class CreateFixEquipmentAssetLis
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
    public function handle(CreateFixEquipmentAsset $event)
    {
        if (company_setting('Twilio New Asset') == 'on') {

            $asset = $event->fixEquipmentAsset;

            $supplier = User::find($asset->supplier_id);
            $location = FixEquipmentLocation::find($asset->location_id);

            if (!empty($supplier->mobile_no) && !empty($location->name)) {
                $uArr = [
                    'name'          => $asset->asset_name,
                    'supplier_name' => $supplier->name,
                    'location'      => $location->name
                ];

                SendMsg::SendMsgs($supplier->mobile_no, $uArr, 'New Asset');
            }
        }
    }
}
