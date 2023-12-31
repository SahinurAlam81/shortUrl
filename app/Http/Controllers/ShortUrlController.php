<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShortUrl;
use App\Http\Requests\ShortRequest;

class ShortUrlController extends Controller
{
    public function short(ShortRequest $req){
        // dd($req);
        if($req->original_url){

            if(auth()->user()){
                $new_url= auth()->user()->links()->create([
                    'original_url' => $req->original_url
                ]);
            } else{
                $new_url = ShortUrl::create([
                'original_url' => $req->original_url
            ]);
           
            }

             $new_url->save();
            // print("ok");


            if($new_url){
                $short_url = base_convert($new_url->id,10,36);
                $new_url->update([
                    'short_url' => $short_url
                ]);
                return redirect()->back()->with('success_message', url($short_url));
            } 
        }
        return back();
    }

    public function show($code){
        $row = ShortUrl::where("short_url", $code)->first();

        if($row){
            return redirect()->to(url($row->original_url));
        }
        return redirect()->to(url('/'));
    }
}
