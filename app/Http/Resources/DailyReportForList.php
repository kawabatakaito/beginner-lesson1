<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DailyReportForList extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'line_name' => $this->line_name,
            'worked_on' => $this->worked_on,
            // リレーション
            'daily_details' => $this->daily_details,
        ];
    }
}
