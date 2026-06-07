<?php
namespace App\Controllers\Api;

use App\Models\HeaderModel;

class HeaderController extends BaseApiController
{
    public function update()
    {
        $d = $this->getJson();

        (new HeaderModel())->updateHeader([
            'name'          => $d['name']          ?? '',
            'position'      => $d['position']      ?? '',
            'email'         => $d['email']         ?? '',
            'phone'         => $d['phone']         ?? '',
            'location'      => $d['location']      ?? '',
            'linkedin'      => $d['linkedin']      ?? '',
            'portfolio_url' => $d['portfolio_url'] ?? '',
            'show_photo'    => !empty($d['show_photo']) ? 1 : 0,
        ]);

        return $this->jsonSuccess([], 'Header updated.');
    }
}