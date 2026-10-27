function products_photos_clicks() {
  $(".product-images img").on("click", function () {
    var huge = $(this).attr("data-huge");
    if (huge) {
      window.open(huge, "");
    }
  });

  $(".product-images img.remove").on("click", function () {
    var id = $(this).parent().data("id"),
      url = self.location.href.split("#");

    $.ajax({ url: url[0] + "?remove_photo=" + id });
    $(this).parent().remove();
  });
}

function products_photos_sortable() {
  $(".product-images").sortable({
    cursor: "move",
    update: function (e, ui) {
      $(this).sortable("refresh");
      sorted = "";
      $(".product-images div").each(function () {
        sorted += $(this).data("id") + ",";
      });

      $.ajax({
        type: "POST",
        data: "s=" + sorted,
      });
    },
  });
}

var file_too_big = "File is too big",
  bad_image_type = "Bad image type",
  bad_images = "Bad images";

function products_photos_drag_init() {
  var dropZone = $(".drag"),
    maxFileSize = 10240000;

  if (typeof window.FileReader == "undefined") dropZone.hide();

  dropZone[0].ondragover = function () {
    dropZone.addClass("hover");
    return false;
  };

  dropZone[0].ondragleave = function () {
    dropZone.removeClass("hover");
    return false;
  };

  dropZone[0].ondrop = function (event) {
    event.preventDefault();
    dropZone.removeClass("hover");
    dropZone.addClass("drop");

    var files = event.dataTransfer.files;
    var c = files.length;
    var done = 0;
    var form = new FormData();
    for (var i = 0; i < c; i++) {
      var file = files[i];
      if (
        file.size <= maxFileSize &&
        (file.type == "image/png" ||
          file.type == "image/jpg" ||
          file.type == "image/gif" ||
          file.type == "image/jpeg" ||
          file.type == "image/bmp")
      ) {
        form.append("file" + i, file);
        done++;
      }
    }

    if (done > 0) {
      var xhr = new XMLHttpRequest();
      xhr.upload.addEventListener("progress", uploadProgress, false);
      xhr.onreadystatechange = function (e) {
        if (e.target.readyState == 4)
          if (e.target.status == 200) {
            $(".product-images").append(e.currentTarget.responseText);
            clicks();
            sortable();
            $(".pbar").hide();
            $("form[name=upload]").show();
            return;
          }
      };

      var url = self.location.href.split("#");
      xhr.open("POST", url[0]);
      xhr.send(form);
    } else alert(bad_images);
  };

  function uploadProgress(e) {
    $("form[name=upload]").hide();
    $(".pbar").show();
    $(".pbar img").width(Math.floor((e.loaded / e.total) * 250));
  }

  $(":file").change(function () {
    var done = 0;
    var form = new FormData();
    for (var x in this.files) {
      var file = this.files[x];
      if (
        file.size <= maxFileSize &&
        (file.type == "image/png" ||
          file.type == "image/jpg" ||
          file.type == "image/gif" ||
          file.type == "image/jpeg" ||
          file.type == "image/bmp")
      ) {
        form.append("file" + x, file);
        done++;
      }
    }

    if (done > 0) {
      var xhr = new XMLHttpRequest();
      xhr.upload.addEventListener("progress", uploadProgress, false);
      xhr.onreadystatechange = function (e) {
        if (e.target.readyState == 4)
          if (e.target.status == 200) {
            $(".product-images").append(e.currentTarget.responseText);
            clicks();
            sortable();
            $(".pbar").hide();
            $("form[name=upload]").show();
            return;
          }
      };

      var url = self.location.href.split("#");
      xhr.open("POST", url[0]);
      xhr.send(form);
    } else alert(bad_images);

    return;
    for (var x in this.files) var file = this.files[x];
    name = file.name;
    size = file.size;
    type = file.type;
    if (file.name.length < 1) {
    } else if (
      file.type != "image/png" &&
      file.type != "image/jpg" &&
      file.type != "image/gif" &&
      file.type != "image/jpeg" &&
      file.type != "image/bmp"
    )
      alert(bad_image_type);
    else {
      var data = new FormData(document.upload),
        xhr = new XMLHttpRequest();
      var url = self.location.href.split("#");
      xhr.open("POST", url[0] + "?albumid=" + albumid);
      xhr.onload = function (e) {
        var s = e.currentTarget.responseText.replace('[""]', "").split("|");
        if (simple_ta) insertImage(s[0], s[1], 1);
        else
          $("body").append(
            '<img src="' +
              s[0] +
              '" onload="insertImage(\'' +
              s[0] +
              "', " +
              s[1] +
              ')" class="hidden">',
          );

        $(".popup").remove();
        unfade();
      };

      xhr.upload.onprogress = function (e) {
        $("form[name=upload]").hide();
        $(".pbar").show();
        $(".pbar img").width(Math.floor((e.loaded / e.total) * 250));
      };

      xhr.send(data);
      $(":file").val("");

      return false;
    }
  });
}