<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    public function fetchData()
    {
        // URL untuk WFS (Web Feature Service)
        $wfsUrl = "http://localhost:8080/geoserver/pgwl/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=pgwl%3Aidw&maxFeatures=50&outputFormat=application%2Fjson";

        try {
            // Mengirim permintaan HTTP GET ke URL WFS
            $response = Http::withoutVerifying()->get($wfsUrl);

            // Memeriksa apakah permintaan berhasil
            if ($response->successful()) {
                // Mengembalikan data JSON yang diterima dari WFS
                return response()->json($response->json());
            } else {
                // Mengembalikan pesan kesalahan jika permintaan gagal
                return response()->json(['error' => 'Failed to fetch data from WFS'], $response->status());
            }
        } catch (\Exception $e) {
            // Menangani pengecualian dan mengembalikan pesan kesalahan
            return response()->json(['error' => 'Exception occurred: ' . $e->getMessage()], 500);
        }
    }
    public function fetchSPI()
    {
        // URL untuk WFS (Web Feature Service)
        $wfsUrl = "http://localhost:8080/geoserver/pgwl/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=pgwl%3ASPI&outputFormat=application%2Fjson";

        try {
            // Mengirim permintaan HTTP GET ke URL WFS
            $response = Http::withoutVerifying()->get($wfsUrl);

            // Memeriksa apakah permintaan berhasil
            if ($response->successful()) {
                // Mengembalikan data JSON yang diterima dari WFS
                return response()->json($response->json());
            } else {
                // Mengembalikan pesan kesalahan jika permintaan gagal
                return response()->json(['error' => 'Failed to fetch data from WFS'], $response->status());
            }
        } catch (\Exception $e) {
            // Menangani pengecualian dan mengembalikan pesan kesalahan
            return response()->json(['error' => 'Exception occurred: ' . $e->getMessage()], 500);
        }
    }


    public function fetchSPIS()
{
    // URL untuk WFS (Web Feature Service)
    $wfsUrl = "http://localhost:8080/geoserver/pgwl/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=pgwl%3ASPI&outputFormat=application%2Fjson";

    try {
        // Mengirim permintaan HTTP GET ke URL WFS
        $response = Http::withoutVerifying()->get($wfsUrl);

        // Memeriksa apakah permintaan berhasil
        if ($response->successful()) {
            // Mengembalikan data JSON yang diterima dari WFS
            return response()->json($response->json());
        } else {
            // Mengembalikan pesan kesalahan jika permintaan gagal
            return response()->json(['error' => 'Failed to fetch data from WFS'], $response->status());
        }
    } catch (\Exception $e) {
        // Menangani pengecualian dan mengembalikan pesan kesalahan
        return response()->json(['error' => 'Exception occurred: ' . $e->getMessage()], 500);
    }
}


    public function fetchStasiun()
    {
        // URL untuk WFS (Web Feature Service)
        $wfsUrl = "http://localhost:8080/geoserver/pgwl/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=pgwl%3ADAS_Oyo&outputFormat=application%2Fjson";

        try {
            // Mengirim permintaan HTTP GET ke URL WFS
            $response = Http::withoutVerifying()->get($wfsUrl);

            // Memeriksa apakah permintaan berhasil
            if ($response->successful()) {
                // Mengembalikan data JSON yang diterima dari WFS
                return response()->json($response->json());
            } else {
                // Mengembalikan pesan kesalahan jika permintaan gagal
                return response()->json(['error' => 'Failed to fetch data from WFS'], $response->status());
            }
        } catch (\Exception $e) {
            // Menangani pengecualian dan mengembalikan pesan kesalahan
            return response()->json(['error' => 'Exception occurred: ' . $e->getMessage()], 500);
        }
    }
}
