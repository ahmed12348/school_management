<?php

namespace App\Http\Controllers;

use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Models\Student;
use App\Models\School;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\Notifications\SendEmailNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;
use App\Models\User;
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schools = School::select("name","id")->get()->pluck("name","id");
        $students = Student::limit(100)->orderBy("school_id")->orderBy("order")->paginate(200);

        return view('students.index',compact('students','schools'))
        ->with('i', (request()->input('page', 1) - 1) * 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $prefix = "#";
        //  $id = IdGenerator::generate(['table' => 'students', 'length' => 2, 'prefix' =>$prefix]);
        $school_id = School::orderBy('name', 'ASC')->pluck('name', 'id');
        return view('students.create',compact('school_id'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      ;
        $students = request()->validate([
            'name' => 'required',
            'school_id' => 'required',

        ]);
        $school_id= $request->school_id;
       $lastStudent =DB::table('students')
       ->where('students.school_id','=',$school_id)
       ->max('students.order');
       $new_orders=$lastStudent +1;//2109 + 1 = 2110

        // $school_id= $request->school_id;
        // $studentsCount= Student::where('students.school_id', '=' , $school_id)->count();
        // //$count = $studentsCount + 1;//1 2 3 =>2 =>count = 2 => 1 3 3
        // $new_orders=$studentsCount +1;

        $students = new Student();
        $students->name  = $request->name;
        $students->school_id= $request->school_id;
        $students->order=$new_orders;


        $students->save();

        return redirect()->route('students.index')->with('success','Student created successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        return view('products.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        return view('products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        request()->validate([
            'title' => 'required',
            'price' => 'required',
            'stock' => 'required',

        ]);

        $product->update($request->all());
        if(isset($request->active)){
            $product->active = $request->active;
          }


       $product->save();
        return redirect()->route('products.index')
                        ->with('success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::find($id);
        $school_id = $student->school_id;
        $student->delete();
        //after deleting student
        //you should reorder other students in school by student.id
        //and regenerate order for each student

        // $studentsIds = DB::table("students")->select("id")->where("school_id","=",$school_id)->get()->toArray();
        // //dd($studentsIds);
        // $i=1;
        // foreach ($studentsIds as  $ids) {
        //     //dd($ids->id);
        //     $student2 = Student::find($ids->id);
        //     $student2->order = $i++;
        //     $student2->save();
        // }
        // return $this->sendNotification();
    Session::flash('message', 'student deleted successfully');
    return redirect()->route('students.index');

    }
    public function sendNotification()
    {
        $user = User::first();

        $details = [
            'greeting' => 'Hi Admin',
            'body' => 'the order of student table is reorder successfully ',
            // 'thanks' => 'Thank you for using tuto!',
            'actiontext' => 'View My Site',
            'actionurl' => url('/'),
            'lastline' => 'this last line',
            // 'order_id' => 101
        ];

        Notification::send($user, new SendEmailNotification($details));
        return redirect()->route('students.index');

    }
}
