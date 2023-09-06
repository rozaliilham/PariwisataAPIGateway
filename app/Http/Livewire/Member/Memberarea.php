<?php

namespace App\Http\Livewire\Member;

use App\Models\Gallery;
use App\Models\HomeStay;
use App\Models\Setting;
use Livewire\Component;

class Memberarea extends Component
{
    public function render()
    {
        $data = [
            "setting"   => Setting::get(),
            "datagallery"   => Gallery::orderBy('id','desc')->limit(3)->get(),
            "homestayslider"   => HomeStay::orderBy('id','desc')->limit(3)->get(),
            "homestay"   => HomeStay::orderBy('id','desc')->where("status","=","Tidak Dibooking")->limit(3)->get(),
        ];

        return view('livewire.member.memberarea',$data)->extends('layouts.member', $data)->section('member');
    }
}
