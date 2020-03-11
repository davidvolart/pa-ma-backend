<?php

namespace App\Observers;

use App\Child;
use App\Family;

class FamilyObserver
{
    public function saving(Family $family)
    {
        $child = new Child();
        $child->save();
        $family->child_id = $child->id;
    }


    /**
     * Handle the family "created" event.
     *
     * @param  \App\Family  $family
     * @return void
     */
    public function created(Family $family)
    {
        //
    }

    /**
     * Handle the family "updated" event.
     *
     * @param  \App\Family  $family
     * @return void
     */
    public function updated(Family $family)
    {
        //
    }

    /**
     * Handle the family "deleted" event.
     *
     * @param  \App\Family  $family
     * @return void
     */
    public function deleted(Family $family)
    {
        //
    }

    /**
     * Handle the family "restored" event.
     *
     * @param  \App\Family  $family
     * @return void
     */
    public function restored(Family $family)
    {
        //
    }

    /**
     * Handle the family "force deleted" event.
     *
     * @param  \App\Family  $family
     * @return void
     */
    public function forceDeleted(Family $family)
    {
        //
    }
}
