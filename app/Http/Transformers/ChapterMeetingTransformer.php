<?php namespace APOSite\Http\Transformers;

use APOSite\Models\Contracts\Reports\Types\ChapterMeeting;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;

class ChapterMeetingTransformer extends TransformerAbstract
{

    protected $manager;

    function __construct(Manager $manager)
    {
        $this->manager = $manager;
    }


    public function transform(ChapterMeeting $report)
    {
        $coreEventData = $this->manager->createData(new Item($report->core,
            new ReportTransformer()))->toArray()['data'];
        $brothers = $report->core->linkedUsers;
        $brothers->transform(function ($item, $key) {
            $val = $item->pivot;
            unset($val->report_id);
            return $val;
        });
        $otherData = [
            'minutes' => $report->minutes,
            'brothers' => $brothers
        ];
        return array_merge($coreEventData, $otherData);
    }

}