<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function getIndex(Request $request) {
        return view('index');
    }

    public function getCheckId(Request $request) {
        return view('cekid');
    }

    public function getScan(Request $request) {
        return view('scan');
    }

    public function getResult(Request $request) {
        $certificate_id = $request->route('certificate_id');

        $certificate = Certificate::with('student')->where('certificate_id', $certificate_id)->first();
        if (!$certificate) {
            return redirect()->route('index')->with('error', 'Sertifikat tidak ditemukan.');
        }
    
        return view('result', [ 'certificate' => $certificate ]);
    }
}
