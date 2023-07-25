<?php

namespace App\Observers;

use App\Models\PatentDetail;
use Illuminate\Support\Facades\Storage;

class AjuanObserver
{
    /**
     * Handle the PatentDetail "created" event.
     */
    public function created(PatentDetail $patentDetail): void
    {
        //
    }

    /**
     * Handle the PatentDetail "updated" event.
     */
    public function updated(PatentDetail $patentDetail): void
    {
        //
    }

    /**
     * Handle the PatentDetail "deleted" event.
     */
    public function deleted(PatentDetail $patentDetail): void
    {
        if (Storage::exists('attachment_patent_'.$patentDetail->id)) {
            Storage::deleteDirectory('attachment_patent_'.$patentDetail->id);
        }
    }

    /**
     * Handle the PatentDetail "restored" event.
     */
    public function restored(PatentDetail $patentDetail): void
    {
        //
    }

    /**
     * Handle the PatentDetail "force deleted" event.
     */
    public function forceDeleted(PatentDetail $patentDetail): void
    {
        //
    }
}
