<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class JobOffer extends Model
{
    protected $fillable = ['link', 'keywords', 'title', 'description', 'company', 'site', 'location', 'views'];

    public static function checkUnique ($link)
    {
        return JobOffer::where('link', $link)->count();
    }
    public static function saveLink($link, $data)
    {
        if(JobOffer::checkUnique($link) === 0) {
            $offer = JobOffer::create([
                'link' => $link,
                'keywords' => json_encode($data)
            ]);

            return $offer->save();
        }
    }
    public static function fetchAll()
    {
        return JobOffer::orderBy('created_at', 'asc')->get();
    }
    public static function updateOffer ($data, $id) {
        $offer = JobOffer::findOrFail($id);

        $offer->update($data);
        $offer->completion = 'yes';
        $offer->save();

        return $offer;
    }
    public static function deleteOffer ($id) {
        $offer = JobOffer::findOrFail($id);
        $offer->delete();

        return $id;

    }
    public static function fetchValidOffers()
    {
        return JobOffer::where('completion', 'yes')->where('created_at', '>=', Carbon::now()->subDays(60))->orderBy('views','desc')->get();
    }
}
