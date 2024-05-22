@extends('students.layout')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Danh sách học sinh Trường mầm non SmartCare</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('students.create') }}"> Thêm học sinh mới</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>STT</th>
            <th>Tên</th>
            <th>Ngày sinh</th>
            <th>Địa chỉ</th>
            <th width="280px">Phương thức</th>
        </tr>
        @foreach ($students as $student)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $student->name }}</td>
            <td>{{ $student->date_of_birth }}</td>
            <td>{{ $student->address }}</td>
            <td>
                <form action="{{ route('students.destroy',$student->id) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('students.show',$student->id) }}">Chi tiết</a>
    
                    <a class="btn btn-primary" href="{{ route('students.edit',$student->id) }}">Sửa</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa học sinh này không?')">Xóa</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $students->links() !!}
      
@endsection