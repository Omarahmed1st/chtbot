<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدخال بيانات</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Add a fade-in animation for the form container */
        .form-container {
            animation: fadeIn 1.5s ease-in-out;
            background-color: #f8f9fa;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        /* Keyframes for fade-in animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Add hover effects for buttons */
        .btn-success {
            transition: background-color 0.3s, transform 0.3s;
        }

        .btn-success:hover {
            background-color: #28a745cc;
            transform: scale(1.05);
        }

        .btn-primary {
            transition: background-color 0.3s, transform 0.3s;
        }

        .btn-primary:hover {
            background-color: #007bffcc;
            transform: scale(1.05);
        }

        /* Styling for labels */
        label {
            font-weight: bold;
            color: #343a40;
        }

        /* Add focus animation for input fields */
        .form-control:focus {
            border-color: #28a745;
            box-shadow: 0 0 5px rgba(40, 167, 69, 0.7);
            transition: box-shadow 0.2s ease-in-out;
        }

        /* Header animation */
        .title {
            animation: slideIn 1s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-100px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center title">إدخال بيانات</h1>

        <div class="form-container mt-4">
            <form action="{{ route('faq.save') }}" method="POST">
                @csrf

                <!-- Predefined Questions -->
                <div class="form-group">
                    <label for="year">سنتك الدراسية الحالية:</label>
                    <select name="year" id="year" class="form-control" required>
                        <option value="اولي">أولي</option>
                        <option value="ثانية">ثانية</option>
                        <option value="ثالثة">ثالثة</option>
                        <option value="رابعة">رابعة</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="challenge">من وجهة نظرك ما هو أكبر تحدي في القسم؟</label>
                    <textarea name="challenge" id="challenge" class="form-control" rows="3" required></textarea>
                </div>

                <div class="form-group">
                    <label for="mistakes_in_study">أخطاء قمت بها في مذاكرة مواد فصلك الدراسي وطريقة تصحيحها:</label>
                    <textarea name="mistakes_in_study" id="mistakes_in_study" class="form-control" rows="3" required></textarea>
                </div>

                <div class="form-group">
                    <label for="difficult_subject">أصعب مادة في سنتك الدراسية وأفضل طريقة لمذاكرتها:</label>
                    <textarea name="difficult_subject" id="difficult_subject" class="form-control" rows="3" required></textarea>
                </div>

                <div class="form-group">
                    <label for="life_mistakes">أخطاء ارتكبتها في حياتك بشكل عام أثرت على دراستك:</label>
                    <textarea name="life_mistakes" id="life_mistakes" class="form-control" rows="3" required></textarea>
                </div>

                <div class="form-group">
                    <label for="balance">هل استطعت الموازنة بين الدراسة وحياتك الاجتماعية؟ وكيف؟</label>
                    <textarea name="balance" id="balance" class="form-control" rows="3" required></textarea>
                </div>

                <div class="form-group">
                    <label for="big_lesson">ما هو أكبر درس تعلمته من أخطاءك الدراسية والحياتية؟</label>
                    <textarea name="big_lesson" id="big_lesson" class="form-control" rows="3" required></textarea>
                </div>

                <div class="form-group">
                    <label for="skills">مهارات بجانب الدراسة تقترحها مثل كورسات وتدريبات:</label>
                    <textarea name="skills" id="skills" class="form-control" rows="3" required></textarea>
                </div>

                <div class="form-group">
                    <label for="custom_question">أدخل سؤالًا جديدًا:</label>
                    <input type="text" name="custom_question" id="custom_question" class="form-control" placeholder="اكتب السؤال هنا">
                </div>

                <!-- Custom Answer -->
                <div class="form-group">
                    <label for="custom_answer">إجابة السؤال الجديد:</label>
                    <textarea name="custom_answer" id="custom_answer" class="form-control" rows="3" placeholder="اكتب الإجابة هنا"></textarea>
                </div>
                <button type="submit" class="btn btn-success btn-block">حفظ البيانات</button>
            </form>

            <br>

            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif

            <a class="btn btn-primary btn-block" href="/">الرجوع إلى الصفحة الرئيسية</a>
        </div>
    </div>
</body>
</html>
