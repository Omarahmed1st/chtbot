<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    // Show the FAQ form
    public function showForm()
    {
        return view('faq_form');
    }

    // Retrieve all FAQs as JSON
    public function getAllFaqs()
    {
        $faqs = Faq::all(); // Retrieve all FAQs from the database
        return response()->json($faqs);
    }

    // Save FAQ answers to the database
    public function saveFaq(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'year' => 'required|string',
            'challenge' => 'required|string',
            'mistakes_in_study' => 'required|string',
            'difficult_subject' => 'required|string',
            'life_mistakes' => 'required|string',
            'balance' => 'required|string',
            'big_lesson' => 'required|string',
            'skills' => 'required|string',
            'custom_question' => 'nullable|string', // Custom question is optional
            'custom_answer' => 'nullable|string',   // Custom answer is optional
        ]);

        // Store predefined answers in the database
        Faq::create([
            'question' => 'سنتك الدراسية الحالية',
            'answer' => $request->year,
        ]);
        Faq::create([
            'question' => 'من وجهة نظرك ما هو أكبر تحدي في القسم؟',
            'answer' => $request->challenge,
        ]);
        Faq::create([
            'question' => 'أخطاء قمت بها في مذاكرة مواد فصلك الدراسي وطريقة تصحيحها:',
            'answer' => $request->mistakes_in_study,
        ]);
        Faq::create([
            'question' => 'أصعب مادة في سنتك الدراسية وأفضل طريقة لمذاكرتها:',
            'answer' => $request->difficult_subject,
        ]);
        Faq::create([
            'question' => 'أخطاء ارتكبتها في حياتك بشكل عام أثرت على دراستك:',
            'answer' => $request->life_mistakes,
        ]);
        Faq::create([
            'question' => 'هل استطعت الموازنة بين الدراسة وحياتك الاجتماعية؟ وكيف؟',
            'answer' => $request->balance,
        ]);
        Faq::create([
            'question' => 'ما هو أكبر درس تعلمته من أخطاءك الدراسية والحياتية؟',
            'answer' => $request->big_lesson,
        ]);
        Faq::create([
            'question' => 'مهارات بجانب الدراسة تقترحها مثل كورسات وتدريبات:',
            'answer' => $request->skills,
        ]);

        // Store custom question and answer, if provided
        if (!empty($request->custom_question) && !empty($request->custom_answer)) {
            Faq::create([
                'question' => $request->custom_question,
                'answer' => $request->custom_answer,
            ]);
        }

        // Return to the form with success message
        return redirect()->route('faq.form')->with('message', 'تم حفظ البيانات بنجاح');
    }
}
