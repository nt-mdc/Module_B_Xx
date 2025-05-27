<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */

    // TODO: Criar a resource
    public function toArray(Request $request): array
    {
        return $this->collection->map(function ($prod) {
           return new ProductResource($prod) ;
        })->toArray();
    }

    //ex resource
    /*return [
        'event' => [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'categories' => explode(';', $this->category),
            'local' => $this->city . " - " . $this->state,
            'address' => $this->address,
            'start' => Carbon::parse($this->start)->format('d/m/Y'),
            'end' => Carbon::parse($this->end)->format('d/m/Y'),
            'channels' => $this->channels->map(function ($channel) {
                return [
                    'id' => $channel->id,
                    'name' => $channel->name,
                    'rooms' => $channel->rooms->map(function ($room) {
                        return [
                            'id' => $room->id,
                            'name' => $room->name,
                            'conferences' => $room->conferences->map(function ($conference) {
                                return [
                                    'id' => $conference->id,
                                    'title' => $conference->title,
                                    'description' => $conference->description,
                                    'speaker' => $conference->speaker,
                                    'date' => Carbon::parse($conference->date)->format('d/m/Y'),
                                    'start' => Carbon::createFromTimeString($conference->start)->format('H:i'),
                                    'end' => Carbon::createFromTimeString($conference->end)->format('H:i'),
                                    'type' => $conference->type,
                                ];
                            }),
                        ];
                    }),
                ];
            }),
            'tickets' => $this->tickets->map(function ($ticket) {
                return [
                    'id' => $ticket->id,
                    'name' => $ticket->name,
                    'special_validity' => $ticket->special_validity,
                ];
            })
        ]
    ];*/
}
