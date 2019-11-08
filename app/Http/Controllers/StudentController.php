<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $direction = 'asc';

        if (isset($_GET['direction']) && $_GET['direction'] == 'desc') {
            $direction = 'desc';
        }

        if (isset($_GET['search']) ) {

            if (isset($_GET['orderBy'])) {
                $students = Student::where('first_name', 'like', '%' . $_GET['search'] . '%')
                    ->orWhere('last_name', 'like', '%' . $_GET['search'] . '%')
                    ->orderBy($_GET['orderBy'], $direction)
                    ->paginate(15);
            } else {
                $students = Student::where('first_name', 'like', '%' . $_GET['search'] . '%')
                    ->orWhere('last_name', 'like', '%' . $_GET['search'] . '%')
                    ->paginate(15);
            }

        } else {
            if (isset($_GET['orderBy'])) {
                $students = Student::orderBy($_GET['orderBy'], $direction)
                    ->paginate(15);
            } else {
                $students = DB::table('students')
                    ->paginate(16);
            }

        }

        return view('index', ['students' => $students]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'group_number' => 'required|max:10',
            'marks' => 'required|numeric|min:0|max:300',
        ]);
        $student = Student::create($validatedData);

        return back()->with('success', 'Student is successfully saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::findOrFail($id);

        return view('edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'group_number' => 'required|max:10',
            'marks' => 'required|numeric|min:0|max:300',
        ]);
        Student::whereId($id)->update($validatedData);

        return back()->with('success', 'Student is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return back()->with('success', 'Student is successfully deleted');
    }
}
