@extends('admin.mater')
@section('main-admin')
<div class="content-body">
    <!-- row -->
    <div class="container">
        <h1>ADD NEW ROOM TYPE</h1>
        <div class="row">
          <form role="form" method="POST" action="{{route('rooms.update',$room)}}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="box-body">
              <input type="hidden" name="id" value="{{$room->id}}">
              <div class="form-group ">
                <label for="disabledTextInput" class="fs-4 text-uppercase">Name</label>
                <input type="text" class="form-control" id="productName" name="name" value="{{old('name') ? old('name') : $room->name}}">
                @error('name')
                    <span class="help-block">{{$message}}</span>
                @enderror
              </div>
              <div class="form-group ">
                <label for="disabledTextInput" class="fs-4 text-uppercase">Price</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="price" value="{{old('price') ? old('price') : $room->price}}">
                @error('price')
                    <span class="help-block">{{$message}}</span>
                @enderror
              </div>
              <div class="form-group ">
                <label for="disabledTextInput" class="fs-4 text-uppercase">Avatar</label>
                <input type="file" class="form-control" id="file-input" name="photo" value="{{$room->image}}">
                <img src="{{asset('storage/images/'.$room->image)}}" id="img-preview" alt="">
              </div>
              @error('photo')
                    <span class="help-block">{{$message}}</span>
                @enderror
              <div class="form-group ">
                <label for="disabledTextInput" class="fs-4 text-uppercase">Image_Room</label>
                <input type="file" class="form-control" id="file-inputs" name="photos[]" onchange="preview(this)" multiple>
                <div class="row mt-3" id="sub-image-preview">
                @foreach ($listimages as $item)
                
                <div class="col-lg-3">
                    <div class="card text-left bg-white border-danger">
                      <a href="#" >

                        <img class="card-img-bottom "
                            src="{{ asset('storage/images') . '/' . $item->image }}"
                            alt="" >
                      </a>
                    </div>
                </div>
            
                @endforeach
                {{-- @error('name')
                    <span class="help-block">{{$message}}</span>
                @enderror --}}
              </div>
              <div class="form-group">
                <label for="disabledTextInput" class="fs-4 text-uppercase">Rooms Type</label>
                <select class="form-control" name="type_id" id="">
                  <option value="">Chọn id Cha</option>
                  @foreach ($type_rooms as $item)
                    <option value="{{$item->id}}" {{($room->type_id === $item->id)?'selected':''}}>{{$item->room_type}}</option>
                  @endforeach
                </select>
              </div>
              <div class="mb-3">
                <label for="disabledTextInput" class="fs-4 text-uppercase">IsBooked</label>
                <div class="d-flex">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="isBooked" id="" value="1" {{($room->isBooked == 1)?'checked':''}}>
                      On
                    </label>
                  </div>
                  <div class="form-check ms-2">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="isBooked" id="" value="0" {{($room->isBooked == 0)?'checked':''}}>
                      Off
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <label for="">People</label>
                  <select class="form-control" name="people" id="">
                    <option value="2" >2</option>
                    <option value="4" >4</option>
                    <option value="6" >6</option>
                    
                  </select>
                </div>
                {{-- @error('name')
                    <span class="help-block">{{$message}}</span>
                @enderror --}}
              </div>
              <div class="form-group">
                <label for="disabledTextInput" class="fs-4 text-uppercase">Descripton</label>
                <textarea name="descripton" id="editor1" rows="10" cols="80">
                  This is my textarea to be replaced with CKEditor 4.
                </textarea>
              </div>
            <div class="box-footer mt-2">
              <button type="submit" class="btn btn-primary">Thêm mới</button>
            </div>
          </form>
        </div>
    </div>
</div>
@endsection
@section('custom-js')
      <script src="{{asset('assets\ckeditor\ckeditor.js')}}"></script>
      <script>
         CKEDITOR.replace('editor1');
      </script>
      <script language="javascript">
        function ChangeToSlug()
        {
            var productName, slug;

            //Lấy text từ thẻ input title 
            productName = document.getElementById("productName").value;

            //Đổi chữ hoa thành chữ thường
            slug = productName.toLowerCase();

            //Đổi ký tự có dấu thành không dấu
            slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
            slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
            slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
            slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
            slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
            slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
            slug = slug.replace(/đ/gi, 'd');
            //Xóa các ký tự đặt biệt
            slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
            //Đổi khoảng trắng thành ký tự gạch ngang
            slug = slug.replace(/ /gi, "-");
            //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
            //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
            slug = slug.replace(/\-\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-/gi, '-');
            slug = slug.replace(/\-\-/gi, '-');
            //Xóa các ký tự gạch ngang ở đầu và cuối
            slug = '@' + slug + '@';
            slug = slug.replace(/\@\-|\-\@|\@/gi, '');
            //In slug ra textbox có id “slug”
            document.getElementById('slug').value = slug;
        }
    </script>
    <script>
  //     function selectFile($event){
  //     $file = $event.target.files[0];
  //     $reader = new FileReader();
  //     $reader.readAsDataURL($file);
  //     $reader.onload = fun(e)=>{
  //       this.preview = e.target.result
  //   }
  // }
  const input = document.getElementById('file-input');
  const image = document.getElementById('img-preview');

  input.addEventListener('change', (e) => {
    if (e.target.files.length) {
        const src = URL.createObjectURL(e.target.files[0]);
        image.src = src;
    }
  });

  function preview(elem, output = '') {
        Array.from(elem.files).map((file) => {
            const blobUrl = window.URL.createObjectURL(file)
            output +=
                `<div class="col-lg-3 js-add-image"  id="img-add">
                    <div class="card text-left bg-dark border-danger">
                        <img class="card-img-bottom" src=${blobUrl} alt="">
                    </div>
                </div>`
            })
            document.getElementById('sub-image-preview').innerHTML = output
        }
    </script>
  @endsection