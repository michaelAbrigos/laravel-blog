<?php

namespace App\Http\Controllers;
use Inani\Larapoll\Poll;
use Auth;
use Inani\Larapoll\Voter;
use Illuminate\Http\Request;
use Inani\Larapoll\Helpers\PollWriter;

class PollsController extends Controller
{

	//for admin managing the polls
    public function getIndex()
    { 	
    	$polls = Poll::all();
    	return view('poll.listPolls',compact('polls'));
    }

    public function store(Request $request)
    {
    	//dd($request);

    	$poll = new Poll([

    		'question' => $request->question

    	]);    	

    	$poll->addOptions($request->options)->generate();

    	return back()->with('success','You have successfully added a poll.');
    }

    public function vote(Request $request,$id)
    {
    	//dd($request);
    	$poll = Poll::find($id);

    	$voteFor = $request->options;
    	$voter = Auth::User();
    	//dd($voteFor);
    	$voter->poll($poll)->vote($voteFor);
    	return back();
    }

    public function getSpecificPoll($poll_id)
    {
    	
    	//dd(Auth::user());
		$helper = new PollWriter;
		return view('poll.pollDetails',compact('poll_id','helper'));

    	
    }

    public function lock($id)
    {
    	$poll = Poll::find($id);
    	$bool = $poll->lock();
    	return back()->with('status','You have successfully locked a poll.');
    }

    public function unlock($id)
    {
    	$poll = Poll::find($id);
    	$bool = $poll->unlock();
    	return back()->with('status','You have successfully unlocked a poll.');
    }

    public function delete($id)
    {
    	$poll = Poll::find($id);
    	$bool = $poll->remove();
    	return back()->with('status','You have successfully deleted a poll.');
    }

    public function create()
    {

    	return view('poll.create');
    }
}
