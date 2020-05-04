<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function show() {
        return view("home.welcome");
    }

    public function pokedex() {
        return view("home.pokedex");
    }

    public function quiz() {
        $pokeId =  random_int(1,151);
        $content = file_get_contents("https://pokeapi.co/api/v2/pokemon/{$pokeId}");
        $result  = json_decode($content);
        session(['quizAnswer' => $result->name]);

        $pokeImg = "https://pokeres.bastionbot.org/images/pokemon/{$pokeId}.png";
        session(['quizAnswerImg' => $pokeImg]);

        return view("home.quiz", ["pokeImg" => $pokeImg]);
    }

    public function quizGuess(Request $request) {

        if ($request->has('refresh'))
            return redirect()->route('home.quiz');

        $quizAnswer = $request->session()->pull('quizAnswer');
        
        
        if ( $quizAnswer == $request->input("quizGuess"))
            return redirect()->route('home.quiz')->with('success', ['Correct answer!', session()->pull('quizAnswerImg')]);
    
        else
            return redirect()->route('home.quiz')->with('wrong', 'Wrong answer! Try again');
        
    }

}
