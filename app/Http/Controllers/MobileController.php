<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\HomeStay;
use App\Models\KomentarWisata;
use App\Models\News;
use App\Models\Sambutan;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\StrukturOrganisasi;
use App\Models\VisiMisi;
use App\Models\Wisata;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use Symfony\Component\HttpFoundation\Response;

class MobileController extends Controller
{
    public function index()
    {
        $setting = Setting::get();
        $response = [
            'message' => 'success',
            'data' => $setting,
        ];
        return response()->json($response, Response::HTTP_OK);
    }

    public function gallery()
    {
        $gallery = Gallery::get();
        $response = [
            'message' => 'success',
            'data' => $gallery,
        ];
        return response()->json($response, Response::HTTP_OK);
    }

    public function wisata()
    {
        $wisata = Wisata::get();
        $response = [
            'message' => 'success',
            'data' => $wisata,
        ];
        return response()->json($response, Response::HTTP_OK);
    }
    public function wisatapopular()
    {
        $wisata = Wisata::orderByDesc('views')->limit(5)->get();
        $response = [
            'message' => 'success',
            'data' => $wisata,
        ];
        return response()->json($response, Response::HTTP_OK);
    }

    public function slider()
    {
        $slider = Slider::orderByDesc("id")->get();
        $response = [
            'message' => 'success',
            'data' => $slider,
        ];
        return response()->json($response, Response::HTTP_OK);
    }

    public function agenda()
    {
        $agenda = Event::orderByDesc("id")->get();
        $response = [
            'message' => 'success',
            'data' => $agenda,
        ];
        return response()->json($response, Response::HTTP_OK);
    }
    public function news()
    {
        $news = News::orderByDesc("id")->get();
        $response = [
            'message' => 'success',
            'data' => $news,
        ];
        return response()->json($response, Response::HTTP_OK);
    }
    public function sambutan()
    {
        $sambutan = Sambutan::get();
        $response = [
            'message' => 'success',
            'data' => $sambutan,
        ];
        return response()->json($response, Response::HTTP_OK);
    }
    public function struktur()
    {
        $struktur = StrukturOrganisasi::get();
        $response = [
            'message' => 'success',
            'data' => $struktur,
        ];
        return response()->json($response, Response::HTTP_OK);
    }
    public function visimisi()
    {
        $visimisi = VisiMisi::get();
        $response = [
            'message' => 'success',
            'data' => $visimisi,
        ];
        return response()->json($response, Response::HTTP_OK);
    }

    public function updateNewsViews($id)
    {
        $news = News::findOrFail($id);
        $news->update([
            "views" => $news->views + 1,
        ]);
        $response = [
            'message' => 'success',
            "data" => $news,
        ];
        return response()->json($response, Response::HTTP_OK);
    }
    public function updateEventViews($id)
    {
        $event = Event::findOrFail($id);
        $event->update([
            "views" => $event->views + 1,
        ]);
        $response = [
            'message' => 'success',
            "data" => $event,
        ];
        return response()->json($response, Response::HTTP_OK);
    }

    public function updateWisataViews($id)
    {
        $wisata = Wisata::findOrFail($id);
        $wisata->update([
            "views" => $wisata->views + 1,
        ]);
        $response = [
            'message' => 'success',
            "data" => $wisata,
        ];
        return response()->json($response, Response::HTTP_OK);
    }
    public function postCommentWisata(Request $request)
    {
        $validator = $request->validate(
            [
                'wisata_id' => 'required',
                'name' => 'required',
                'email' => 'required',
                'comment' => 'required',
            ]
        );
        try {
            $trx = KomentarWisata::create($validator);
            $response = [
                'message' => 'success',
                'data' => $trx,
            ];
            return response()->json($response, Response::HTTP_CREATED);
        } catch (QueryException $e) {
            return response()->json([
                'message' => "$e",
            ]);
        }

    }

    public function komenwisata($id)
    {
        $komenwisata = KomentarWisata::where('wisata_id', $id)->get();
        $response = [
            'message' => 'success',
            'data' => $komenwisata,
        ];
        return response()->json($response, Response::HTTP_OK);
    }

    public function kirimpesan(Request $request)
    {
        $contact = Contact::create([
            "name" => $request->name,
            "email" => $request->email,
            "subject" => $request->subject,
            "message" => $request->message
        ]);
        if($contact){
            $response = [
                'message' => 'success',
                'value' => 1,
                'data' => $contact,
            ];
        }else{
            $response = [
                'value' => 0,
                'message' => 'failed',
            ];
        }
        header ('Content-Type: application / json; charset = utf-8');
        return $response;
    }

    public function getHomestay()
    {
        $data = HomeStay::get();
        $response = [
            'message' => 'success',
            'data' => $data,
        ];
        return response()->json($response, Response::HTTP_OK);
    }

}
