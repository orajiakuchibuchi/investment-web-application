<?php
namespace App\Services;

use App\Http\Controllers\mail\MailController;
class MailerService {
    public $request;
    public $list;
    protected $mailController;

    public function __construct(MailController $mailController){
        $this->mailController = $mailController;
    }
    public function dispatchTest(){
        // dd($this->request->all());
        dd("ho");
        try {
            $this->mailController->testMailer( $request->test_email,
                                                $request->name,
                                                $request->subject,
                                                $request->from,
                                                $request->body);
            return 'Success';
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function getActiveExamsBySchoolId(){
        return Exam::where('school_id', auth()->user()->school_id)
                    ->where('active',1)
                    ->get();
    }

    public function getCoursesByExamIds(){
        return Course::with('class','teacher')
                    ->whereIn('exam_id', $this->examIds)
                    ->orderBy('class_id')
                    ->get();
    }

    public function getClassesBySchoolId(){
        return Myclass::where('school_id',auth()->user()->school->id)->with('sections')->get();
    }

    public function getAlreadyAssignedClasses(){
        $classes = $this->getClassesBySchoolId()
                        ->pluck('id')
                        ->toArray();
        return ExamForClass::with('exam')
                            ->where('active', 1)
                            ->whereIn('class_id', $classes)
                            ->get();
    }

    public function createExam(){
        $exam = new Exam;
        $exam->exam_name = $this->request->exam_name;
        $exam->active = 0;
        $exam->date = $this->request->date;
        $exam->duration = $this->request->duration;
        $exam->term = $this->request->term;
        // $exam->start_date = $this->request->start_date;
        $exam->end_time = $this->request->end_time;
        $exam->notice_published = 0;
        $exam->result_published = 0;
        $exam->school_id = auth()->user()->school_id;
        $exam->user_id = auth()->user()->id;
        $exam->save();
        return $exam;
    }

    public function updateCoursesWithExamId(){
        Course::where('class_id', $this->request->class)->update([
            'exam_id' => $this->exam->id
        ]);
    }

    public function assignClassesToExam(){
        // dd($this->request->class);
        // return;
        $tc = $this->request->class;
        $i = 0;
        while($i < $tc){
            $examForClass = new ExamForClass;
            $examForClass->exam_id = $this->exam->id;
            $examForClass->class_id = $this->request->class;
            $efc[] = $examForClass->attributesToArray();
            ++$i;
        }
        return $efc;
    }

    public function storeExam(){
        \DB::transaction(function () {
            $this->exam = $this->createExam();

            // Assign Exam ID to Classes in Course Table
            $this->updateCoursesWithExamId();

            $efc = $this->assignClassesToExam();

            if(count($efc) > 0)
                ExamForClass::insert($efc);
        }, 5);
    }

    public function updateExamFields(){
        $tb = Exam::find($this->request->exam_id);
        $tb->notice_published = isset($this->request->notice_published)?1:0;
        $tb->result_published = isset($this->request->result_published)?1:0;
        $tb->active = (isset($this->request->active))?1:0;
        $tb->save();
    }

    public function updateExamForClass(){
        if(!isset($this->request->active)){
            ExamForClass::where('exam_id', $this->request->exam_id)->update(['active'=>0]);
        }else{
            ExamForClass::where('exam_id', $this->request->exam_id)->update(['active'=>1]);
        }
    }

    public function updateExam(){
        \DB::transaction(function () {
            $this->updateExamFields();
            $this->updateExamForClass();
        });
    }
}
