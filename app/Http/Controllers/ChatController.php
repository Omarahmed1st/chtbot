<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    // Show the homepage with all FAQs
    public function index()
{
    // Retrieve all FAQs grouped by question
    $faqs = Faq::all()->groupBy('question');

    // Debug to verify $faqs
    if ($faqs->isEmpty()) {
        dd('No FAQs found in the database.');
    }

    // Pass the grouped FAQs to the view
    return view('welcome', compact('faqs'));
}


    public function getFaqs()
    {
        // Retrieve all questions from the database
        $allFaqs = Faq::all();

        // Shuffle the questions and ensure unique content
        $uniqueQuestions = $allFaqs->unique('question')->shuffle()->take(5);

        return response()->json($uniqueQuestions);
    }

    public function chatWithBot(Request $request)
{
    $userMessage = trim($request->input('message'));

    // Search for all matching answers in the database
    $faqs = Faq::where('question', 'LIKE', "%{$userMessage}%")->get();

    if ($faqs->isNotEmpty()) {
        // Select a random answer from the matching FAQs
        $botResponse = $faqs->random()->answer;
    } else {
        $botResponse = "عذرًا، لم أتمكن من العثور على إجابة لسؤالك.";
    }

    return response()->json(['response' => $botResponse]);
}
 
}
