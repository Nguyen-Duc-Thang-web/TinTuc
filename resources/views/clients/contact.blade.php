@extends('clients.layouts.app')

@section('title')
    Liên hệ
@endsection

@section('content')
    <div class="contact-container">
        <div class="contact-info">
            <h3 style="font-family: none;">Liên hệ với chúng tôi</h3>
            <p>Vui lòng liên hệ theo bất kỳ phương thức nào sau đây:</p>
            <ul>
                <li>SĐT: 0983274823</li>
                <li>Email: newsimta@gmail.com</li>
                <li>Địa chỉ văn phòng: Cổng số 1, Tòa nhà FPT Polytechnic, 13 phố Trịnh Văn Bô, phường Phương Canh, quận Nam
                    Từ Liêm, TP Hà Nội</li>
            </ul>
        </div>
        <div class="contact-form">
            <h3 style="text-align: center; font-family: none;">Bạn cần hỗ trợ?</h3>
            <form action="{{ route('contact.store') }}" method="POST">
                @csrf

                <div class="input-container">
                    <label for="name">Họ tên:</label>
                    <input type="text" name="name" class="@error('name') is-invalid @enderror"
                        value="{{ old('name') }}">
                    @error('name')
                        <small style="color: red; font-style: italic;">* {{ $message }}</small>
                    @enderror
                </div>
                <div class="input-container">
                    <label for="email">Email:</label>
                    <input type="email" name="email" class="@error('email') is-invalid @enderror"
                        value="{{ old('email') }}">
                    @error('email')
                        <small style="color: red; font-style: italic;">* {{ $message }}</small>
                    @enderror
                </div>
                <div class="input-container">
                    <label for="message">Tiêu đề:</label>
                    <textarea id="message" name="title" class="@error('title') is-invalid @enderror" cols="30" rows="2">{{ old('title') }}</textarea>
                    @error('title')
                        <small style="color: red; font-style: italic;">* {{ $message }}</small>
                    @enderror
                </div>
                <div class="input-container">
                    <label for="message">Nội dung:</label>
                    <textarea id="message" name="content" class="@error('content') is-invalid @enderror" cols="30" rows="3">{{ old('content') }}</textarea>
                    @error('content')
                        <small style="color: red; font-style: italic;">* {{ $message }}</small>
                    @enderror
                </div>

                <button type="submit" class="btn-contact">Gửi</button>
            </form>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        body {
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .contact-container {
            margin: 20px auto;
            display: flex;
            justify-content: space-between;
            width: 80%;
            max-width: 1000px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .contact-info,
        .contact-form {
            flex: 1;
            padding: 20px;
        }

        .contact-info ul {
            list-style: none;
            padding: 0;
        }

        .contact-info li {
            margin-bottom: 10px;
        }

        .input-container {
            margin-bottom: 15px;
        }

        .input-container label {
            display: block;
            margin-bottom: 5px;
        }

        .input-container input,
        .input-container textarea {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 2px solid #ccc;
            border-radius: 4px;
            resize: none;
        }

        .btn-contact {
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            border: none;
            border-radius: 4px;
            font-weight: bold;
            color: white;
            cursor: pointer;
        }

        .btn-contact:hover {
            background-color: #0056b3;
        }
    </style>
@endsection
