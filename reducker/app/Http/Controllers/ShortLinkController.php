<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShortLink;
use Illuminate\Support\Str;

class ShortLinkController
{
    public function generate (Request $request)
    {
        if (!$request->link){
            return '';
        }
        $link = $request->link;
        $checkLink = ShortLink::where('link', $link)->first();
        if ($checkLink) {
            return $checkLink->code;
        }
        do {
            $code = Str::random(6);
        }
        while (ShortLink::where('code', $code)->first());
        ShortLink::create([
            'link' => $link,
            'code' => $code
        ]);
        return $code;
    }

    public function linkRedirect ($code)
    {
        $link = ShortLink::where('code', $code)->first();
        if ($link) {
            return redirect($link->link);
        } else {
            return redirect('/');
        }
    }
}
