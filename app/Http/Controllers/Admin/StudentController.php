<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function getStudents(Request $request) {
        $search = $request->input('search');
        $perPage = $request->input('perPage', 10); // default 10

        $getStudents = Student::when($search, function ($query, $search) {
                $query->where('nis', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%")
                    ->orWhere('major', 'like', "%{$search}%")
                    ->orWhere('gender', 'like', "%{$search}%")
                    ->orWhere('batch', 'like', "%{$search}%")
                    ->orWhere('academic_year', 'like', "%{$search}%");
            })
            ->orderBy('batch')
            ->paginate($perPage)
            ->withQueryString();

        return view('admin.students', [
            'students' => $getStudents,
            'search' => $search,
            'perPage' => $perPage,
        ]);
    }

    public function getAddStudent(Request $request) {
        return view('admin.add-students');
    }

    public function postAddStudent(Request $request) {
        $validator = Validator::make($request->all(), [
            'nis' => 'required|string|min:4|max:9',
            'name' => 'required|string',
            'major' => 'required|string',
            'gender' => 'required|in:LAKI-LAKI,PEREMPUAN',
            'batch' => 'required|integer'
        ]);

        if ($validator->fails()) return back()->withErrors($validator->errors())->withInput();
        $validate = $validator->validate();

        $getStudent = Student::where('nis', $validate['nis'])->get()->first();
        if ($getStudent) return redirect()->route('students')->with('error', 'Student sudah tersedia di Database!');

        $angkatan = substr($validate['nis'], 2, 2);
        $lulus = (int)$angkatan + 2;
        $academic_year = "20$angkatan-20$lulus";

        Student::create([
            'nis' => $validate['nis'],
            'name' => strtoupper($validate['name']),
            'major' => strtoupper($validate['major']),
            'gender' => $validate['gender'],
            'batch' => $validate['batch'],
            'academic_year' => $academic_year
        ]);

        return redirect()->route('students')->with('success', 'Student berhasil ditambahkan!');
    }

    public function postAddStudents(Request $request) {
        $validator = Validator::make($request->all(), [ 'files.*' => 'required|file|mimes:csv' ]);

        if ($validator->fails()) return back()->withErrors($validator->errors())->withInput();

        $data = $request->file('data');
        $path = $data->getRealPath();

        $rows = array_map('str_getcsv', file($path));

        $rawHeader = $rows[0];
        $header = array_map(function ($h) {
            return strtolower(trim(preg_replace('/\x{FEFF}/u', '', $h)));
        }, $rawHeader);
        unset($rows[0]);

        foreach ($rows as $row) {
            $data = array_combine($header, $row);

            $angkatan = substr($data['nis'], 2, 2);
            $lulus = (int)$angkatan + 2;
            $academic_year = "20$angkatan-20$lulus";
    
            Student::create([
                'nis' => $data['nis'],
                'name' => $data['name'],
                'major' => $data['major'],
                'gender' => $data['gender'],
                'batch' => $data['batch'],
                'academic_year' => $academic_year
            ]);
        }

        return redirect()->route('students')->with('success', 'Students berhasil ditambahkan!');
    }

    public function getEditStudent(Request $request) {
        $id = $request->query('id');

        $getStudent = Student::where('id', $id)->get()->first();
        if (!$id || !$getStudent) return redirect()->route('students')->with('error', 'Student ID tidak ada dalam database');

        return view('admin.edit-student', [ 'student' => $getStudent ]);
    }

    public function postEditStudent(Request $request) {
        $id = $request->query('id');
        $validator = Validator::make($request->all(), [
            'nis' => 'required|string|min:4|max:9',
            'name' => 'required|string',
            'major' => 'required|string',
            'gender' => 'required|in:LAKI-LAKI,PEREMPUAN',
            'batch' => 'required|integer'
        ]);

        if ($validator->fails()) return back()->withErrors($validator->errors())->withInput();
        $validate = $validator->validate();

        $getStudent = Student::where('id', $id)->get()->first();
        if (!$id || !$getStudent) return redirect()->route('students')->with('error', 'Student ID tidak ada dalam database!');

        $angkatan = substr($validate['nis'], 1, 2);
        $lulus = (int)$angkatan + 2;
        $academic_year = "20$angkatan-20$lulus";

        $updateData = [
            'nis' => $validate['nis'],
            'name' => $validate['name'],
            'major' => $validate['major'],
            'gender' => $validate['gender'],
            'batch' => $validate['batch'],
            'academic_year' => $academic_year,
        ];

        $getStudent->update($updateData);
        return redirect()->route('students')->with('success', 'Student berhasil di edit!');
    }

    public function deleteStudent(Request $request) {
        $validator = Validator::make($request->all(), [ 'id' => 'required|integer' ]);
        if ($validator->fails()) return back()->withErrors($validator->errors())->withInput();
        $validate = $validator->validate();

        $student = Student::findOrFail($validate['id']);
        $student->delete();

        return redirect()->route('students')->with('success', 'Student deleted successfully.');
    }
}
