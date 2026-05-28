var Cloudflare = {
  imageup: function (id) {
    this.$target = $('#' + id + ' textarea');
    this.$file.trigger('click');
  }
};

void function () {
  // Create hidden file input
  var $file = $('<input type="file" multiple accept="image/*">');
  Cloudflare.$file = $file; // Link it to our object

  $file.on('change', function(evt) {
    $.each(this.files, function(i, file) {
      upload(file, Cloudflare.$target);
    });
    this.value = '';
  });

  function getSign() {
    return $.getJSON('/cloudflare/signature');
  }

  function upload(file, $target) {
    var placeholder = 'Uploading...' + file.name;
    var pos = $target.getSelection();
    
    // Insert placeholder text
    ETConversation.wrapText($target, placeholder, '', '', '');

    getSign().then(function (sign) {
      var data = new FormData();
      data.append('key', sign.key);
      data.append('AWSAccessKeyId', sign.accessKey);
      data.append('policy', sign.policy);
      data.append('signature', sign.signature);
      data.append('file', file);

      return $.ajax(sign.url, {
        data: data,
        type: 'POST',
        processData: false,
        contentType: false
      })
      .then(function() {
        var publicUrl = sign.url + '/' + sign.key;
        var result = '[cloud]' + publicUrl + '[/cloud]';
        
        // Replace placeholder with the real tag
        $target.val($target.val().replace(placeholder, result));
        
        // Restore caret
        var cpos = $target.getSelection();
        var x = cpos.end;
        if (cpos.end >= (pos.end + placeholder.length)) {
          x = cpos.end + result.length - placeholder.length;
        }
        $target.selectRange(x, x);
      })
     .fail(function (xhr, status, error) {
    // 1. Get the actual error from the server
    var errorMessage = 'Upload failed.';
    
    // 2. Check the HTTP status code
    if (xhr.status === 403) {
        errorMessage = 'Upload failed: Access Denied (Check your Bucket/Secret Keys in Admin).';
    } else if (xhr.status === 404) {
        errorMessage = 'Upload failed: Bucket not found.';
    } else if (status === 'timeout') {
        errorMessage = 'Upload failed: Connection timed out.';
    } else if (xhr.responseText) {
        // If the server sent a specific error message, use it
        errorMessage = 'Upload failed: ' + xhr.responseText;
    }

    // 3. Show the specific error
    ETMessages.showMessage(errorMessage, 'warning');
    
    // 4. Remove the "Uploading..." placeholder
    $target.val($target.val().replace(placeholder, ''));
});
    });
  }
}();