<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Event;
use App\Models\Gallery;
use App\Models\News;
use App\Models\Sambutan;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\Wisata;
use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        $data = [
            "setting"   => Setting::get(),
            "berita" => News::get(),
            "wisata" => Wisata::get(),
            "agenda" => Event::get(),
            "sambutan"  => Sambutan::get(),
            "slider"    => Slider::orderBy('id','desc')->limit(3)->get(),
            "datagallery"   => Gallery::orderBy('id','desc')->limit(3)->get(),
            "datawisata"   => Wisata::orderBy('id','desc')->limit(3)->get(),
            "databerita"   => News::orderBy('id','desc')->limit(3)->get()
        ];

        return view('livewire.frontend.home',$data)->extends('layouts.front', $data)->section('front');
    }
}
