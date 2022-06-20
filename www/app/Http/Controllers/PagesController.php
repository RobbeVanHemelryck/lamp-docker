<?php

namespace App\Http\Controllers;

class PagesController extends Controller {
	public function getTest(){
		return view('pages.test');
	}


	public function getHome(){
		return view('pages.home');
	}
	public function getMinidagboek(){
		return view('pages.minidagboek');
	}
	public function getMoodboek(){
		return view('pages.moodboek');
	}
	public function getDagboek(){
		return view('pages.dagboek');
	}
	public function getAndere(){
		return view('pages.andere');
	}
	
}