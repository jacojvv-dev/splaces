<?php
/**
 * Created by PhpStorm.
 * User: jaco
 * Date: 2018/04/07
 * Time: 9:16 PM
 */

namespace App\DAL;


use App\VenueView;

class VenueViewRepository
{
    /**
     * Saves a venue view
     * @param $id
     * @param $name
     * @return VenueView
     */
    public static function store($id, $name)
    {
        $view = new VenueView([
            'venue_id' => $id,
            'venue_name' => $name
        ]);
        $view->save();

        return $view;
    }

    /**
     * Retrieves the latest venue views
     * @return mixed
     */
    public static function latest()
    {
        // might not always return 25  because of the unique filter
        // on the collection, but it's easier than trying to to a groupby count while
        // ordering by date created
        $items = VenueView::orderBy('created_at', 'DESC')->skip(0)->take(25)->get();
        $unique = $items->unique('venue_id');
        return $unique->values()->all();
    }
}