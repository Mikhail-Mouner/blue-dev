@extends('layouts.app')

@section('content')
<div class="modal fade" id="addCourseModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addCourseLabel">Add Course</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('admin.course.store')}}" method="POST">
          @csrf
          <div class="modal-body">
              <div class="form-group">
                  <label for="course">New Course</label>
                  <input class="form-control" type="text" id="course" name="name" required>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">+ Add</button>
          </div>
        </form>
      </div>
    </div>
</div>
<div class="modal fade" id="editCourseModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editCourseLabel">Edit Course</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('admin.course.update')}}" method="POST">
          <input class="form-control" type="hidden" id="course-id" name="id" required>
          @csrf
          <div class="modal-body">
              <div class="form-group">
                  <label for="course">Course Name</label>
                  <input class="form-control" type="text" id="course-name" name="name" required>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Save</button>
          </div>
        </form>
      </div>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-secondary">
                <div class="card-header text-white h3 clearfix">
                    Course
                    <button class="btn btn-primary float-right" data-toggle="modal" data-target="#addCourseModal">+ Add</button>
                </div>

                <div class="card-body bg-white">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-warning" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">name</th>
                            <th scope="col">Control</th>
                          </tr>
                        </thead>
                        <tbody>
                          
                          @foreach ($courses as $index=>$course)
                            <tr id="course{{$index+1}}">
                              <th scope="row">{{$index+1}}</th>
                              <td>{{$course->name}}</td>
                              <td>
                                <button class="btn btn-success" onclick="update('{{$course->name}}','{{$course->id}}')" data-toggle="modal" data-target="#editCourseModal"> Edit</button>
                                <button class="btn btn-danger" onclick="destroy('{{ route( 'admin.course.destroy' , $course->id ) }}','course{{$index+1}}')" >x Delete</button>
                              </td>
                            </tr>
                            @endforeach
                        </tbody>
                      </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    function update(title,id) {
      document.getElementById('course-name').value=title 
      document.getElementById('course-id').value=id 
    }
    
    //delete
    function destroy(link,element) {
      $.ajax({
          type: "POST",
          dataType: 'json',
          data: '_method=DELETE&_token={{ csrf_token() }}',
          async: true,
          url: link,
          success: function (data) { 
            if (data.error == false){
              document.getElementById(element).innerHTML='<td colspan="3" class="text-center text-danger">Deleted</td>' 
            }else{
              document.getElementById(element).innerHTML='<td colspan="3" class="text-center text-warning">Error</td>' 
            }
          }
      });
    }

</script>
@endsection
