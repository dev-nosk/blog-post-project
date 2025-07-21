// $(document).on('click', '.view-parts', function () {
//     let branch = $(this).data('branch');
//     let month = $('#select-month').val();
//     // materialTable.column(1).search(branch).draw();
//     console.log(month);
//     if(month == null){
//         errorAlert('Please select month')
//         return false;
//     }

//     getListPartsByBranch(branch,month);

    
//     $('#mainTabs .nav-link[data-tab="materials"]').trigger('click');
// });

$(document).on('click','#view-parts',function(){
    let branch = $('#branch-select').val();
    let month = $('#select-branch-month').val();
    console.log(month)
      if(month == null){
        errorAlert('Please select month')
        return false;
    }

    if(branch == null){
      $('#branch-select').select2('open');
        errorAlert('Please select branch')
        return false;
    }

    getListPartsByBranch(branch,month);

})