@extends('layouts.main-admin')

@section('title', 'Admin Create Product')

@section('links')
<link href="{{ asset('css/jquery-editable-select.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
<!-- Page Heading -->
<h1>Create Product Here (On Progress)</h1>

<form enctype="multipart/form-data" action="{{ route('admin.products.store') }}" method="post">
  {{ csrf_field() }}

  <div class="container">
    {{-- Categories Input --}}
    <div class="form-group">
      <label for="inputCategory">Categories</label>
      <select id="inputCategory" class="form-control" name="category" required>
        @foreach ($categories as $category)
        <option @if ($loop->first) selected @endif>{{ $category['category'] }}</option>
        @endforeach
      </select>
    </div>

    {{-- Product Name --}}
    <div class="form-group">
      <label for="inputProductName">Name</label>
      <input type="text" class="form-control" id="inputProductName" name="name" placeholder="Mylo Crop Sleeve Denim"
        required>
    </div>

    {{-- Product Description --}}
    <div class="form-group">
      <label for="inputProductDescription">Description</label>
      <textarea class="form-control" id="inputProductDescription" name="description"
        placeholder="Required product description" required></textarea>
    </div>

    {{-- Product Price --}}
    <div class="form-group">
      <label for="inputProductPrice">Price (IDR)</label>
      <input type="number" class="form-control" id="inputProductPrice" name="price" placeholder="449000" required>
    </div>

    {{-- Materials Input --}}
    <div class="form-group mb-0">
      <label for="inputMaterialRow">Materials</label>
      <div class="row" id="inputMaterialRow">
        <div class="col-4 mb-4">
          <select id="inputMaterial" class="form-control" name="materials[]" required>
            @foreach ($materials as $material)
            <option @if ($loop->first) selected @endif>{{ $material['material'] }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-4 mb-4" id="addMaterialButtonCol">
          <div class="row justify-content-center">
            <a role="button" class="btn btn-success text-white col-5 mx-2" id="addMaterialButton"
              onclick="addMaterial()">Add Material</a>
            <a role="button" class="btn btn-danger text-white col-5 mx-2" id="deleteMaterialButton"
              onclick="deleteMaterial()">Remove Material</a>
          </div>
        </div>
      </div>
    </div>

    {{-- Colours Input --}}
    <div class="form-group mb-0">
      <label for="inputColourRow">Colours</label>
      <div class="row" id="inputColourRow">
        <div class="col-4 mb-4">
          <select id="inputColour" class="form-control" name="colours[]" required>
            @foreach ($colours as $colour)
            <option @if ($loop->first) selected @endif>{{ $colour['colour'] }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-4 mb-4" id="addColourButtonCol">
          <div class="row justify-content-center">
            <a role="button" class="btn btn-success text-white col-5 mx-2" id="addColourButton"
              onclick="addColour()">Add Colour</a>
            <a role="button" class="btn btn-danger text-white col-5 mx-2" id="deleteColourButton"
              onclick="deleteColour()">Remove Colour</a>
          </div>
        </div>
      </div>
    </div>

    {{-- Size Input --}}
    <div class="form-group mb-0">
      <label for="inputSizeRow">Sizes</label>
      <div class="row" id="inputSizeRow">
        <div class="col-4 mb-4">
          <select id="inputSize" class="form-control" name="sizes[]" required>
            @foreach ($sizes as $size)
            <option @if ($loop->first) selected @endif>{{ $size['size'] }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-4 mb-4" id="addSizeButtonCol">
          <div class="row justify-content-center">
            <a role="button" class="btn btn-success text-white col-5 mx-2" id="addSizeButton" onclick="addSize()">Add
              Size</a>
            <a role="button" class="btn btn-danger text-white col-5 mx-2" id="deleteSizeButton"
              onclick="deleteSize()">Remove Size</a>
          </div>
        </div>
      </div>
    </div>

    {{-- Images Input --}}
    <div class="form-group">
      <input type="file" class="form-control-file" id="inpFile" name="images[]" accept="image/*" multiple
        onchange="imagePreview()">
    </div>
  </div>

  {{-- Image Previews --}}
  <div class="row justify-content-center" id="previewImageParent">
    <div class="card col-3 mb-4 mx-3">
      <div class="image-preview mx-auto" id="previewContainer0">
        <img src="..." alt="Image Preview" id="previewImage0">
        <span id="previewImageText0">Image Preview</span>
      </div>
      <div class="card-body">
        <p class="card-text" id="previewFileName0">filename.jpg</p>
      </div>
    </div>
  </div>

  {{-- Submit & Cancel Button --}}
  <div class="container">
    <div class="form-group">
      <div class="row justify-content-center">
        <button type="submit" class="btn btn-md btn-primary col-3 mx-2">Submit</button>
        <button type="reset" class="btn btn-md btn-danger col-3 mx-2">Cancel</button>
      </div>
    </div>
  </div>
</form>
@endsection

@section('scripts')
{{-- Script for editable select input --}}
<script src="{{ asset('js/jquery-editable-select.js') }}"></script>
<script>
  $('#inputCategory').editableSelect({ filter: false });
  $('#inputMaterial').editableSelect({ filter: false });
  $('#inputColour').editableSelect({ filter: false });
  $('#inputSize').editableSelect({ filter: false });
</script>

{{-- Script for Materials Input --}}
<script>
  function addMaterial(){
    var childcount = document.getElementById("inputMaterialRow").childElementCount;
    var button = document.getElementById("addMaterialButtonCol");

    var newinput = '<div class="col-4 mb-4">\n' +
    '<select id="inputMaterial' + childcount + '" class="form-control" name="materials[]" required>\n' +
    '@foreach ($materials as $material)\n' +
    "<option @if ($loop->first) selected @endif>{{ $material['material'] }}</option>\n" +
    '@endforeach\n' +
    '</select>\n' + '</div>';

    button.insertAdjacentHTML('beforebegin', newinput);

    $('#inputMaterial' + childcount).editableSelect({ filter: false });
  }

  function deleteMaterial(){
    var parent = document.getElementById("inputMaterialRow");

    if (parent.childElementCount > 2){
      parent.removeChild(parent.lastElementChild.previousSibling);
    }
  }
</script>

{{-- Script for Colours Input --}}
<script>
  function addColour(){
    var childcount = document.getElementById("inputColourRow").childElementCount;
    var button = document.getElementById("addColourButtonCol");

    var newinput = '<div class="col-4 mb-4">\n' +
    '<select id="inputColour' + childcount + '" class="form-control" name="colours[]" required>\n' +
    '@foreach ($colours as $colour)\n' +
    "<option @if ($loop->first) selected @endif>{{ $colour['colour'] }}</option>\n" +
    '@endforeach\n' +
    '</select>\n' + '</div>';

    button.insertAdjacentHTML('beforebegin', newinput);

    $('#inputColour' + childcount).editableSelect({ filter: false });
  }

  function deleteColour(){
    var parent = document.getElementById("inputColourRow");

    if (parent.childElementCount > 2){
      parent.removeChild(parent.lastElementChild.previousSibling);
    }
  }
</script>

{{-- Script for Colours Input --}}
<script>
  function addSize(){
    var childcount = document.getElementById("inputSizeRow").childElementCount;
    var button = document.getElementById("addSizeButtonCol");

    var newinput = '<div class="col-4 mb-4">\n' +
    '<select id="inputSize' + childcount + '" class="form-control" name="sizes[]" required>\n' +
    '@foreach ($sizes as $size)\n' +
    "<option @if ($loop->first) selected @endif>{{ $size['size'] }}</option>\n" +
    '@endforeach\n' +
    '</select>\n' + '</div>';

    button.insertAdjacentHTML('beforebegin', newinput);

    $('#inputSize' + childcount).editableSelect({ filter: false });
  }

  function deleteSize(){
    var parent = document.getElementById("inputSizeRow");

    if (parent.childElementCount > 2){
      parent.removeChild(parent.lastElementChild.previousSibling);
    }
  }
</script>

{{-- Script for Image Preview --}}
<script>
  const inpFile = document.getElementById("inpFile");

  function imagePreview(){
    const files = inpFile.files;

    if (files.length != 0)
    {
      addImagePreview(files.length)

      for (var i = 0; i < files.length; i++)
      {
        const file = files[i];

        const previewImage = document.getElementById("previewImage" + i);
        const previewImageText = document.getElementById("previewImageText" + i);
        const previewFileName = document.getElementById("previewFileName" + i);

        const reader = new FileReader();

        previewImageText.style.display = "none";
        previewImage.style.display = "block";
        previewFileName.innerText = file.name;

        reader.addEventListener("load", function() {
          previewImage.setAttribute("src", this.result);
        });

        reader.readAsDataURL(file);
      }
    } else
    {
      addImagePreview(1);
    }
  };

  function addImagePreview(amount){
    var parent = document.getElementById('previewImageParent');
    parent.innerHTML = "";
    
    for (var i = 0; i < amount; i++)
    {
      const newcard = '<div class="card col-3 mb-4 mx-3" ' + 'id="previewCard' + i + '">\n' +
        '<div class="image-preview mx-auto" ' + 'id="previewContainer' + i + '">\n' +
        '<img src="..." alt="Image Preview" ' + 'id="previewImage' + i + '">\n' +
        '<span ' + 'id="previewImageText' + i + '">Image Preview</span>\n' +
        '</div>\n' +
        '<div class="card-body">\n' +
        '<p class="card-text" id="previewFileName' + i + '">filename.jpg</p>\n' +
        '</div>\n' +
        '</div>\n';
      parent.insertAdjacentHTML('beforeend', newcard);
    }
  }
</script>
@endsection