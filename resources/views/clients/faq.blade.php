@extends('clients.layouts.app')

@section('title')
    Câu hỏi thường gặp
@endsection

@section('content')
    <div class="faq-container">
        <h2 style="font-style: italic; font-family: none;">Câu Hỏi Thường Gặp</h2>
        @foreach ($faqs as $faq)
            <div class="faq-item">
                <button class="faq-question">{{ $faq->question }}</button>
                <div class="faq-answer">
                    <p>
                        {{ $faq->answer }}
                    </p>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('styles')
    <style>
        body {
            line-height: 1.6;
            background: #f4f4f4;
            color: #333;
        }

        .faq-container {
            max-width: 1000px;
            margin: 20px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .faq-question {
            width: 100%;
            padding: 10px;
            font-size: 18px;
            text-align: left;
            border: none;
            background: #007BFF;
            color: white;
            cursor: pointer;
            margin: 5px 0;
            border-radius: 5px;
            transition: background 0.3s ease;
        }

        .faq-question:hover {
            background: #0056b3;
        }

        .faq-answer {
            overflow: hidden;
            max-height: 0;
            transition: max-height 0.3s ease-out;
            background: #f9f9f9;
            padding: 0 10px;
        }

        .faq-answer p {
            padding: 10px 0;
        }
    </style>
@endsection

@section('scripts')
    <script>
        document.querySelectorAll('.faq-question').forEach(item => {
            item.addEventListener('click', () => {
                const answer = item.nextElementSibling;
                answer.style.maxHeight = answer.style.maxHeight ? null : answer.scrollHeight + 'px';
                item.classList.toggle('active');
            });
        });
    </script>
@endsection
