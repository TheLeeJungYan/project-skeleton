<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkerEmploymentHistoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'companyName'=>$this->companyName,
            'jobTitle'=>$this->jobTitle,
            'startDate'=>$this->startDate,
            'endDate'=>$this->endDate
        ];
    }
}
