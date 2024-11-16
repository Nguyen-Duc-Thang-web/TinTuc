@extends('admin.layouts.app')

@section('title')
    Xem chi tiết liên hệ
@endsection

@section('content')
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4>Chi tiết liên hệ</h4>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-sm-3 fw-bold">ID:</div>
                <div class="col-sm-9">{{ $contact->id }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-3 fw-bold">Tên:</div>
                <div class="col-sm-9">{{ $contact->name }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-3 fw-bold">Email:</div>
                <div class="col-sm-9">{{ $contact->email }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-3 fw-bold">Tiêu đề:</div>
                <div class="col-sm-9">{{ $contact->title }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-3 fw-bold">Nội dung:</div>
                <div class="col-sm-9">{{ $contact->content }}</div>
            </div>
        </div>
        <div class="card-footer text-end">
            <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary">Quay lại</a>
        </div>
    </div>
@endsection
