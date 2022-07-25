<?php

namespace App\Http\Resources\Event;

use Illuminate\Http\Resources\Json\JsonResource;


class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $currentUrl = $request->url();
        $requestMethod = $request->getMethod();
        $detailUrl = route('api.event.retrieve', $this->id);
        $listUrl = route('api.event.list');

        $isRetrieve = $detailUrl === $currentUrl && $requestMethod === 'GET';
        $isUpdate = $detailUrl === $currentUrl && $requestMethod === 'PUT';
        $isCreate = $listUrl === $currentUrl && $requestMethod === 'POST';

        return [
            'pk' => $this->id,
            'date' => $this->date,
            'name' => $this->name,
            'description' => $this->when($isRetrieve || $isCreate || $isUpdate, $this->description),
            'image' => $this->when($isRetrieve || $isCreate || $isUpdate, $this->image),
            'createdBy' => $this->when($isRetrieve || $isCreate || $isUpdate, $this->user),
        ];
    }
}
