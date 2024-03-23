<form method="post" action={{route("configurations.store")}}>
    @csrf
    <div class="form-group">
        <label for="">Subject Name</label>
        <input type="text" class="form-control" id="subjectName" name="subjectName" value="{{old('subjectName')}}" placeholder="Enter subject" required>
        <x-b-input-error :messages="$errors->get('subjectName')" class="mt-2" />
    </div>
    <div class="form-group">
        <label for="address">Subject Code</label>
        <input type="text" class="form-control" id="subjectCode" name="subjectCode" value="{{old('subjectCode')}}" placeholder="Enter subject code" required>
        <x-b-input-error :messages="$errors->get('subjectCode')" class="mt-2" />
    </div>
    <button type="submit" class="btn btn-primary pull-right">Submit</button>
</form>
