$(document).ready(function () {
    $(document).on('click', '#update-list', function (e) {
        e.preventDefault();
        if (!confirm('This will take more time to update. Are you sure?')) {
            return;
        }
        var month = $('#select-branch-month').val();
      
       updateParts(month);
    });

})