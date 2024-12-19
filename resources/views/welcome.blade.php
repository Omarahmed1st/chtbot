<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مشروع الدردشة</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <style>
        /* General Page Styling */
        body {
            background-color: #f9fafb;
            font-family: 'Arial', sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
            animation: fadeInPage 1.5s ease-in-out;
        }

        h1 {
            font-weight: bold;
            text-align: center;
            margin-bottom: 30px;
            color: #444;
        }

        .container {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.1);
            animation: fadeInContainer 1.2s ease;
        }

        /* Buttons Styling */
        .btn-primary, .btn-secondary {
            border: none;
            font-weight: bold;
            transition: transform 0.3s, opacity 0.3s;
        }

        .btn-primary {
            background: linear-gradient(45deg, #007bff, #0056b3);
            color: #fff;
        }

        .btn-secondary {
            background: linear-gradient(45deg, #6c757d, #5a6268);
            color: #fff;
        }

        .btn-primary:hover, .btn-secondary:hover {
            transform: scale(1.05);
            opacity: 0.9;
        }

        /* Chat Box */
        .chat-box {
            border: 1px solid #ddd;
            height: 300px;
            padding: 15px;
            overflow-y: scroll;
            direction: rtl;
            text-align: right;
            border-radius: 10px;
            background-color: #fafafa;
        }

        .chat-message {
            margin-bottom: 10px;
            opacity: 0;
            animation: fadeInChat 0.5s ease forwards;
        }

        .chat-message.user {
            color: #007bff;
            font-weight: bold;
        }

        .chat-message.bot {
            color: #28a745;
            font-weight: bold;
        }

        /* FAQ Section */
        .faq-section {
            margin-top: 40px;
        }

        .faq-section h5 {
            font-weight: bold;
            color: #007bff;
            margin-bottom: 20px;
            text-align: center;
            animation: slideInTitle 1s ease;
        }

        .faq-section .question {
            font-weight: bold;
            background-color: #e9ecef;
            padding: 10px;
            border-radius: 5px;
            margin-top: 20px;
            animation: fadeInQuestion 0.8s ease-in-out;
        }

        .faq-section .answer {
            margin-top: 10px;
            padding: 8px 10px;
            background-color: #f8f9fa;
            border-left: 4px solid #007bff;
            border-radius: 4px;
            animation: fadeInAnswer 0.8s ease-in-out;
        }

        .suggested-questions {
            margin-bottom: 20px;
            padding: 15px;
            background-color: #e9ecef; /* Light background for suggested questions */
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.05);
            animation: fadeInSuggestions 1s ease;
            color: #555;
        }

        .suggested-questions h5 {
            font-weight: bold;
            margin-bottom: 10px;
        }

        .suggested-questions ul {
            list-style-type: none;
            padding: 0;
        }

        .suggested-question {
            cursor: pointer;
            color: #007bff; /* Blue color for suggested questions */
            padding: 8px 12px;
            margin-bottom: 10px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .suggested-question:hover {
            background-color: #d6e0e5;
            transform: scale(1.05);
        }
        /* Animations */
        @keyframes fadeInPage {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes fadeInContainer {
            from {
                opacity: 0;
                transform: scale(0.95);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes fadeInChat {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInQuestion {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeInAnswer {
            from {
                opacity: 0;
                transform: translateX(50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideInTitle {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>مرحبًا بك في المشروع </h1>

        <!-- Option Buttons -->
        <div class="mt-5 text-center">
            <button class="btn btn-primary" id="inputOption" onclick="window.location.href='/faq/form'">إدخال بيانات</button>
            <button class="btn btn-secondary" id="chatOption" onclick="showChatInterface()">التحدث مع الروبوت</button>
        </div>
        <div id="suggestedQuestions" class="suggested-questions" style="display:none;">
            <h5>أسئلة مقترحة:</h5>
            <ul></ul>
        </div>
        <!-- Chatbot Interface -->
        <div id="chatInterface" style="display:none; margin-top:20px;">
            <div id="chatBox" class="chat-box"></div>
            <input type="text" id="chatInput" class="form-control" placeholder="اسأل الروبوت..." onkeyup="handleKeyPress(event)">
            <button class="btn btn-success mt-2" onclick="sendMessage()">إرسال</button>
        </div>
         
        <!-- FAQ Section -->
        <div id="faqSection" class="faq-section">
            <h5>جميع الأسئلة والإجابات:</h5>
            <div id="faqs"></div>
        </div>

        <script>
            function showChatInterface() {
                document.getElementById("chatInterface").style.display = "block";
                document.getElementById("suggestedQuestions").style.display = "block";
                fetchSuggestedQuestions();  // Fetch questions when the chat is shown
            }
            function fetchSuggestedQuestions() {
                axios.get('/get-faqs')
                    .then(response => {
                        const questions = response.data;
                        const questionList = document.querySelector('#suggestedQuestions ul');
                        questionList.innerHTML = ''; // Clear existing questions

                        if (questions.length === 0) {
                            const noQuestions = document.createElement('li');
                            noQuestions.textContent = 'لا توجد أسئلة متوفرة حاليا.';
                            questionList.appendChild(noQuestions);
                        } else {
                            questions.forEach(faq => {
                                const listItem = document.createElement('li');
                                listItem.textContent = faq.question;
                                listItem.className = 'suggested-question';
                                listItem.onclick = () => sendQuestion(faq.question); // Send the question on click
                                questionList.appendChild(listItem);
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching questions:', error);
                    });
            }
            function fetchFaqs() {
                axios.get('/get-all-faqs')
                    .then(response => {
                        const faqs = response.data;
                        const faqSection = document.getElementById('faqs');
                        faqSection.innerHTML = ''; // Clear existing FAQs

                        const groupedFaqs = faqs.reduce((acc, faq) => {
                            acc[faq.question] = acc[faq.question] || [];
                            acc[faq.question].push(faq.answer);
                            return acc;
                        }, {});

                        for (const [question, answers] of Object.entries(groupedFaqs)) {
                            const questionDiv = document.createElement('div');
                            questionDiv.className = 'question';
                            questionDiv.textContent = question;

                            faqSection.appendChild(questionDiv);

                            answers.forEach(answer => {
                                const answerDiv = document.createElement('div');
                                answerDiv.className = 'answer';
                                answerDiv.textContent = `- ${answer}`;
                                faqSection.appendChild(answerDiv);
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching FAQs:', error);
                    });
            }

            function sendMessage() {
                const message = document.getElementById("chatInput").value;
                if (!message) return;

                const chatBox = document.getElementById("chatBox");
                chatBox.innerHTML += `<div class="chat-message user"><strong>أنت:</strong> ${message}</div>`;

                document.getElementById("chatInput").value = '';

                axios.post('/chat-with-bot', { message: message })
                    .then(response => {
                        chatBox.innerHTML += `<div class="chat-message bot"><strong>الروبوت:</strong> ${response.data.response}</div>`;
                        chatBox.scrollTop = chatBox.scrollHeight;
                    });
            }
            function sendQuestion(question) {
                const chatInput = document.getElementById("chatInput");
                chatInput.value = question; // Autofill the input box
                sendMessage(); // Send the question
            }

            function handleKeyPress(event) {
                if (event.key === 'Enter') {
                    sendMessage();
                }
            }
            document.addEventListener('DOMContentLoaded', fetchFaqs);
        </script>
    </div>
</body>
</html>
