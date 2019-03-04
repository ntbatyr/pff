<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;

class FlickrController extends Controller
{
    private $format = 'json';               // To receive json-string always
    private $lang = 'en-us';                // Language we need
    private $tagmode = 'all';               // Necessarily fetch items by preferred tag
    private $tags = 'colors,water,light';   // Tags by default (to get rid of unwanted photos)

    public function index(){
        $endpiont = env('FLICKR_ENDPOINT'); // Flickr's endpiont url

        // Setting params to send
        $params = [
            'tags' => $this->tags,
            'tagmode' => $this->tagmode,
            'format' => $this->format,
            'lang' => $this->lang
        ];


        $client = new Client(['verify' => false]);
        $response = $client->request('POST', $endpiont, ['query' => $params]);

        $resp = $response->getBody()->getContents();        // Get response json string

        $json = $this->StringToJson($resp);                 // Fix response string

        $object = json_decode($json);                       //JSON to object
        $items = $object->items;                            //Getting response items

        return view('flickr.index', compact('items'));
    }

    public function photosByTag($tags){
        $endpiont = env('FLICKR_ENDPOINT');     // Flickr's endpiont url

        // Setting params to send
        $params = [
            'tags' => $tags,
            'tagmode' => $this->tagmode,
            'format' => $this->format,
            'lang' => $this->lang
        ];

        $client = new Client(['verify' => false]);
        $response = $client->request('POST', $endpiont, ['query' => $params]);

        $resp = $response->getBody()->getContents();        // Get response json string

        $json = $this->StringToJson($resp);                 // Fix response string

        $object = json_decode($json);                       //JSON to object
        $items = $object->items;                            //Getting response items

        return view('flickr.by-tag-photos', compact('items'));
    }

    private function StringToJson($string){

        $string = str_replace('jsonFlickrFeed(', '', $string);  // Fixing json string
        $string = str_replace(')', '', $string);                // Fixing json string

        return $string;
    }
}
