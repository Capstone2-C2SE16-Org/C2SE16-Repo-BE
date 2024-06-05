@extends('students.layout')
  
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Thông tin học sinh mới</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('students.index') }}"> Trở về</a>
        </div>
    </div>
</div>


@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Rất tiếc!</strong> Có một số vấn đề với dữ liệu bạn nhập.<br><br>
        <ul>

            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
   
<form action="{{ route('students.store') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tên học sinh:</strong>
                <input type="string" name="name" class="form-control" placeholder="Tên học sinh">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Ngày sinh:</strong>
                <input type="date" name="date_of_birth" class="form-control" placeholder="Ngày sinh">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Giới tính:</strong>
                {{-- <input type="text" name="gender" class="form-control" placeholder="Giới tính"> --}}
                <select name="gender">
                    <option value="1">Nam</option>
                    <option value="0">Nữ</option>
                </select>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Địa chỉ:</strong>
                <input type="text" name="address" class="form-control" placeholder="Địa chỉ">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tên phụ huynh:</strong>
                <input type="text" name="name_parent" class="form-control" placeholder="Tên phụ huynh">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Ngày sinh phụ huynh:</strong>
                <input type="date" name="date_of_birth_parent" class="form-control" placeholder="Ngày sinh phụ huynh">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Giới tính phụ huynh:</strong>
                {{-- <input type="text" name="gender_parent" class="form-control" placeholder="Giới tính phụ huynh"> --}}
                <select name="gender_parent">
                    <option value="1">Nam</option>
                    <option value="0">Nữ</option>
                </select>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Số điện thoại liên lạc:</strong>
                <input type="text" name="phone_number" class="form-control" placeholder="Số điện thoại liên lạc">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email:</strong>
                <input type="email" name="email" class="form-control" placeholder="Email">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tên đăng nhập:</strong>
                <input type="text" name="username" class="form-control" placeholder="Tên đăng nhập">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Mật khẩu</strong>
                <input type="password" name="password" class="form-control" placeholder="Mật khẩu">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Lớp học</strong>
                {{-- <input type="text" name="classroom_id" class="form-control" placeholder="Lớp học"> --}}
                <select name="classroom_id">
                    <option value="1">Lớp bé 1</option>
                    <option value="2">Lớp bé 2</option>
                </select>
            </div>
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Tạo</button>
        </div>

    </div>
   
</form>
@endsection