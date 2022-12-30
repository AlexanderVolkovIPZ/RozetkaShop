<form action="" method="post" enctype="multipart/form-data" class="container">
    <h2>Додавання слайдеру</h2>
    <div class="mb-3">
        <label for="formFile" class="form-label">Файли з фотографією для слайдеру</label>
        <input class="form-control filesSelectedForSlider" type="file" name="file[]" multiple id="formFile" accept="image/jpeg; image/png">
    </div>
    <div class="divSelectedFilesForSlider">

    </div>
    <button class="btn btn-primary click" type="submit">Додати</button>
</form>
