@extends('students.layout')
  
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Chi tiết thông tin học sinh</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('students.index') }}"> Trở về </a >
                <br></br>
            </div>
        </div>
    </div>
   
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tên:</strong>
                {{ $student->name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Ngày sinh:</strong>
                {{ $student->date_of_birth }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Giới tính:</strong>
                {{ $student->gender }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Địa chỉ:</strong>
                {{ $student->address }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tên phụ huynh:</strong>
                {{ $student->parents->name }}
                {{-- {{ $parent->name_parent }} --}}
                {{-- {{ $student ->name_parent }} --}}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Ngày sinh phụ huynh:</strong>
                {{ $student->parents->date_of_birth }}
                {{-- {{ $student->date_of_birth_parent }} --}}
                {{-- {{ $parent->date_of_birth_parent }} --}}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Giới tính phụ huynh:</strong>
                {{ $student->parents->gender }}
                {{-- {{ $parent->gender_parent }} --}}
                {{-- {{ $student ->gender_parent }} --}}
                
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Số điện thoại liên lạc:</strong>
                {{ $student->phone_number }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email:</strong>
                {{ $student->email }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tên đăng nhập:</strong>
                {{ $student->username }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Mật khẩu:</strong>
                {{ $student->password }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Lớp học:</strong>
                {{ $student->classroom_id }}
            </div>
        </div>
    </div>
@endsection