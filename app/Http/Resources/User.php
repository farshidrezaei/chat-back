<?php

namespace App\Http\Resources;

use Auth;
use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray( $request )
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            $this->mergeWhen( Auth::guard( 'api' )->check(), [
                'first-secret' => 'value',
                'second-secret' => 'value',
            ] ),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
