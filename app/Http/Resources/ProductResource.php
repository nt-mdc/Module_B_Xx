<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "name" => $this->translations->mapWithKeys(function ($tr) {
                return [$tr->language => $tr->name];
            }),
            "description" => $this->translations->mapWithKeys(function ($tr) {
                return [$tr->language => $tr->description];
            }),
            "gtin" => $this->gtin,
            "brand" => $this->detail->brand,
            "countryOfOrigin" => $this->detail->country,
            "weight" => [
                "gross" => $this->weight->gross,
                "net" => $this->weight->net,
                "unit" => $this->weight->unit
            ],
            "company" => [
                "companyName" => $this->company->company_name,
                "companyAddress" => $this->company->company_address,
                "companyTelephone" => $this->company->company_number,
                "companyEmail" => $this->company->company_email,
                "owner" => [
                    "name" => $this->company->owner->owner_name,
                    "mobileNumber" => $this->company->owner->owner_number,
                    "email" => $this->company->owner->owner_email,
                ],
                "contact" => [
                    "name" => $this->company->contact->contact_name,
                    "mobileNumber" => $this->company->contact->contact_number,
                    "email" => $this->company->contact->contact_email,
                ]
            ]
        ];
    }
}
