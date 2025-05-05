<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class CertificateController extends Controller
{
    public function getCertificates(Request $request) {
        $search = $request->input('search');
        $perPage = $request->input('perPage', 10);

        $getCertificates = Certificate::with('student')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('certificate_id', 'like', "%{$search}%")
                    ->orWhere('student_nis', 'like', "%{$search}%")
                    ->orWhere('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('organizer', 'like', "%{$search}%")
                    ->orWhere('filename', 'like', "%{$search}%")
                    ->orWhere('date', 'like', "%{$search}%")
                    ->orWhereHas('student', function ($studentQuery) use ($search) {
                        $studentQuery->where('name', 'like', "%{$search}%");
                    });
                });
            })
            ->orderBy('date', 'desc')
            ->paginate($perPage)
            ->withQueryString();

        return view('admin.certificates', [
            'certificates' => $getCertificates,
            'search' => $search,
            'perPage' => $perPage,
        ]);
    }

    public function getAddCertificate(Request $request) {
        return view('admin.add-certificates');
    }

    public function postAddCertificate(Request $request) {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'organizer' => 'required|string',
            'description' => 'string',
            'file' => 'required|file|mimes:pdf,png,jpg,jpeg',
            'certificate_id' => 'required|string',
            'student_nis' => 'required|string',
        ]);

        if ($validator->fails()) return back()->withErrors($validator->errors())->withInput();
        $validate = $validator->validate();

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $originalName = $file->getClientOriginalName();
            $path = $file->storeAs('certificates', $originalName, 'public');

            Certificate::create([
                'certificate_id' => $validate['certificate_id'],
                'student_nis' => $validate['student_nis'],
                'title' => $validate['title'],
                'description' => $validate['description'],
                'organizer' => $validate['organizer'],
                'filename' => $originalName,
                'date' => now()
            ]);

            return redirect()->route('certificates')->with('success', 'Certificate berhasil ditambahkan!');
        } else {
            return redirect()->route('certificates')->with('error', 'File Certificate tidak terupload!');
        }
    }

    public function postAddCertificates(Request $request) {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'organizer' => 'required|string',
            'description' => 'string',
            'files' => 'required|array',
            'files.*' => 'file|mimes:pdf,png,jpg,jpeg',
            'data' => 'required|file|mimes:csv',
        ]);

        if ($validator->fails()) return back()->withErrors($validator->errors())->withInput();
        $validate = $validator->validate();

        $data = $request->file('data');
        $path = $data->getRealPath();

        $rows = array_map('str_getcsv', file($path));

        $rawHeader = $rows[0];
        $header = array_map(function ($h) {
            return strtolower(trim(preg_replace('/\x{FEFF}/u', '', $h)));
        }, $rawHeader);
        unset($rows[0]);

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $originalName = $file->getClientOriginalName();
                $path = $file->storeAs('certificates', $originalName, 'public');
            }
        }

        foreach ($rows as $row) {
            $data = array_combine($header, $row);
    
            Certificate::create([
                'certificate_id' => $data['certificate_id'],
                'student_nis' => $data['student_nis'],
                'title' => $validate['title'],
                'description' => $validate['description'],
                'organizer' => $validate['organizer'],
                'filename' => $data['filename'],
                'date' => now()
            ]);
        }

        return redirect()->route('certificates')->with('success', 'Certificates berhasil ditambahkan!');
    }

    public function getEditCertificate(Request $request) {
        $id = $request->query('id');

        $getCertificate = Certificate::where('id', $id)->get()->first();
        if (!$id || !$getCertificate) return redirect()->route('certificates')->with('error', 'Certificate ID tidak ada dalam database');

        return view('admin.edit-certificate', [ 'certificate' => $getCertificate ]);
    }

    public function postEditCertificate(Request $request) {
        $id = $request->query('id');
        $validator = Validator::make($request->all(), [
            'certificate_id' => 'required|string',
            'student_nis' => 'required|string',
            'title' => 'required|string',
            'organizer' => 'required|string',
            'description' => 'string',
            'file' => 'nullable|file|mimes:pdf,png,jpg,jpeg',
            'date' => 'required|date'
        ]);

        if ($validator->fails()) return back()->withErrors($validator->errors())->withInput();
        $validate = $validator->validate();

        $getCertificate = Certificate::where('id', $id)->get()->first();
        if (!$id || !$getCertificate) return redirect()->route('certificates')->with('error', 'Certificate ID tidak ada dalam database');

        $updateData = [
            'certificate_id' => $validate['certificate_id'],
            'student_nis' => $validate['student_nis'],
            'title' => $validate['title'],
            'description' => $validate['description'],
            'organizer' => $validate['organizer'],
            'date' => $validate['date'],
        ];

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
            $file->storeAs('public/certificates', $filename);

            $updateData['filename'] = $filename;
        }

        $getCertificate->update($updateData);
        return redirect()->route('certificates')->with('success', 'Certificates berhasil di edit!');
    }

    public function deleteCertificate(Request $request) {
        $validator = Validator::make($request->all(), [ 'id' => 'required|integer' ]);
        if ($validator->fails()) return back()->withErrors($validator->errors())->withInput();
        $validate = $validator->validate();

        $certificate = Certificate::findOrFail($validate['id']);
        $certificate->delete();

        return redirect()->route('certificates')->with('success', 'Item deleted successfully.');
    }
}
