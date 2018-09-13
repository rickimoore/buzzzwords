<?php
/**
 * Created by PhpStorm.
 * User: rickimoore
 * Date: 9/2/18
 * Time: 2:24 PM
 */

namespace App;


class CollectLink
{

    public function processLink($request, $data)
    {
        $offer = JobOffer::saveLink($request['link'], $data);

        if($offer) {
            $this->notifyAdmin();
        }
        return $offer;
    }

    public function notifyAdmin()
    {
        return $this;
    }

}