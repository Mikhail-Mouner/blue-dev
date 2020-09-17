<option selected disabled>Select New Course</option>
@forelse ($courses as $course)
    <option value="{{$course->id}}">{{$course->name}}</option>
@empty
    <option>Empty</option>
@endforelse