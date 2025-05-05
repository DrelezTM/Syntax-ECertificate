<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class AssetController extends Controller
{
    public function getFiles(Request $request) {
        $allFiles = File::allFiles(public_path('storage/certificates'));
        
        $fileData = collect($allFiles)->map(function ($file) {
            return (object)[
                'filename' => basename($file),
                'url' => Storage::url(path: $file),
                'extension' => pathinfo($file, PATHINFO_EXTENSION),
            ];
        });

        if ($search = $request->input('search')) {
            $fileData = $fileData->filter(function ($file) use ($search) {
                return stripos($file->filename, $search) !== false;
            });
        }

        $perPage = $request->input('perPage', 10);
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $fileData->slice(($currentPage - 1) * $perPage, $perPage)->values();
        $paginatedFiles = new LengthAwarePaginator(
            $currentItems,
            $fileData->count(),
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('admin.assets', [ 'files' => $paginatedFiles ]);
    }

    public function getAddFiles(Request $request) {
        return view('admin.add-assets');
    }

    public function postAddFiles(Request $request) {
        $validator = Validator::make($request->all(), [ 
            'files' => 'required|array',
            'files.*' => 'required|file|mimes:pdf,png,jpg,jpeg,webp' 
        ]);

        if ($validator->fails()) return back()->withErrors($validator->errors())->withInput();

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $originalName = $file->getClientOriginalName();
                $path = $file->storeAs('certificates', $originalName, 'public');
            }

            return redirect()->route('assets')->with('success', 'File berhasil ditambahkan!');
        } else {
            return redirect()->route('assets')->with('error', 'File tidak terupload!');
        }
    }

    public function getEditFile(Request $request) {
        $filename = $request->query('filename');
        return view('admin.edit-assets', [ 'file' => [ 'filename' => $filename ] ]);
    }

    public function postEditFile(Request $request) {
        $filename = $request->query('filename');
        $validator = Validator::make($request->all(), [ 'new_filename' => 'required|string' ]);

        if ($validator->fails()) return back()->withErrors($validator->errors())->withInput();
        $validate = $validator->validate();

        $path = 'certificates/' . $filename;
        if (Storage::disk('public')->exists($path)) {
            rename(storage_path('app/public/certificates/'.$filename), storage_path('app/public/certificates/'.$validate['new_filename']));
            return redirect()->route('assets')->with('success', 'File Assets berhasil di edit!');
        } else {
            return redirect()->route('assets')->with('success', 'File Assets not found!');
        }
    }

    public function deleteFile(Request $request) {
        $validator = Validator::make($request->all(), [ 'filename' => 'required|string' ]);
        if ($validator->fails()) return back()->withErrors($validator->errors())->withInput();
        $validate = $validator->validate();

        $path = 'certificates/' . $validate['filename'];
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
            return redirect()->route('assets')->with('success', 'File Assets deleted successfully.');
        } else {
            return redirect()->route('assets')->with('success', 'File Assets not found!');
        }
    }
}
