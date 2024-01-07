<?php

namespace App\Http\Controllers\Shopper;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Shopper\ShopperService;
use App\Services\Store\Location\LocationService;
use App\Models\Store\Location\Location;
use App\Models\Shopper\Shopper;

class ShopperQueueController extends Controller
{
    /**
     * @var LocationService
     */
    protected $location;

    /**
     * @var ShopperService
     */
    protected $shopper;

    public function __construct(ShopperService $shopper, LocationService $location)
    {
        $this->location = $location;
        $this->shopper = $shopper;
    }

    public function updateQueue()
    {
        $locations = $this->location->all(null, null, null, ['Shoppers', 'Shoppers.Status']);

        foreach ($locations as $location) {
            $shoppers = null;

            if( isset($location['shoppers']) && count($location['shoppers']) >= 1 ){
                $shoppers = $this->location->getShoppers($location['shoppers']);
            }
            foreach($shoppers['active'] as $shopper) {
                // $date = date('Y-m-d H:i:s');
                // $this->shopper->update($shopper['id'], [
                //     'check_out' => $date,
                // ]);
            }
        }
        return $shoppers['active'];
    }
}
