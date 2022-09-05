<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Voter;

class VoteController extends Controller
{

    /**
     * Show the lastest vote question.
     *
     * @param  null
     */
    public function voteresult()
    {
        $data['nav'] = "vote-result";
        $last_question = Question::orderBy('id', 'desc')->first();
        $data['lastest_question'] = $last_question;

        $total_result = Voter::where('question_id', $last_question->id)->get();
        $data['total_count'] = $total_result->count();

        $vote_result = Voter::where('question_id', $last_question->id)->where('vote_status', 1)->get();
        $data['vote_count'] = $vote_result->count();

        $novote_result = Voter::where('question_id', $last_question->id)->where('vote_status', 0)->get();
        $data['novote_count'] = $novote_result->count();

        return view('vote_result', compact('data'));
    }

    /**
     * Show the lastest vote question.
     *
     * @param  null
     */
    public function lastestvote()
    {
        $data['nav'] = "vote-question";
        $data['lastest_question'] = Question::orderBy('id', 'desc')->first();

        return view('vote_question', compact('data'));
    }

    /**
     * Create vote when do new voting.
     *
     * @param  $request data from form submit
     */
    public function dovote(Request $request){
        $data = $request->post();
        $ip = $_SERVER['REMOTE_ADDR'];
        $question_id = $data['question_id'];

        //check already vote
        $check_already_vote = Voter::where('ip',$ip)->where('question_id',$question_id)->get()->toArray();

        if($check_already_vote){
            //redirect with error message
            return redirect('vote-question')->with(['error' => 'You already vote this question!']);
        }

        //add vote data
        $voted = Voter::create([
            'question_id'   => $question_id,
            'ip'            => $ip,
            'vote_status'   => $data['vote_status']
        ]);

        if($voted){
            //redirect with success message
            return redirect('vote-question')->with(['success' => 'Successfully vote!']);
        }else{
            //redirect with error message
            return redirect('vote-question')->with(['error' => 'Failed to vote!']);
        }
    }

    /**
     * Show the question view.
     *
     * @param  null
     */
    public function question()
    {
        $data['nav'] = "question";
        $data['created_by'] = array(1 => "Mg Kyaw", 2 => "John");

        return view('vote_create', compact('data'));
    }

    /**
     * Create question for voting purpose.
     *
     * @param  $request data from form submit
     */
    public function createquestion(Request $request){

        $this->validate($request, [
            'name' => 'required|min:5|max:255'
        ],
        [
            'name.required' => 'Question field is required!'
        ]);

        Question::create($request->all());
        return back()->with('success', 'Successfully created!');
    }


    /**
     * get the lastest vote count via ajax.
     *
     * @param  null
     */
    public function getvotecount($question_id)
    {

        $total_result = Voter::where('question_id', $question_id)->get();
        $data['total_count'] = $total_result->count();

        $vote_result = Voter::where('question_id', $question_id)->where('vote_status', 1)->get();
        $data['vote_count'] = $vote_result->count();

        $novote_result = Voter::where('question_id', $question_id)->where('vote_status', 0)->get();
        $data['novote_count'] = $novote_result->count();

        echo json_encode($data);
    }
}
