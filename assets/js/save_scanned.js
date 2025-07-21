$(document).on('click', '#save-btn', function () {
    let parts_scanned = JSON.parse(localStorage.getItem('scannedParts'));
    if (parts_scanned.length === 0) {
        Swal.fire({
            icon: 'warning',
            title: 'No scanned parts',
            text: 'Please scan at least one barcode before saving.',
        });
        return;
    }
    // // Get branches from localStorage and parse as array
    // var branches = JSON.parse(localStorage.getItem('branch') || '[]');

    // // Convert to object: { BranchCode: BranchName, ... }
    // var branchOptions = {};
    // branches.forEach(function (branch) {
    //     branchOptions[branch.BranchCode] = '(' + branch.BranchCode + ')-' + branch.BranchName;
    // });
    async function showBranchSelector() {
        // const { value: branchCode } = await Swal.fire({
        //     title: "Select Branch",
        //     input: "select",
        //     inputOptions: branchOptions,
        //     inputPlaceholder: "Select a branch",
        //     showCancelButton: true,
        //     inputValidator: (value) => {
        //         return value ? undefined : "You need to select a branch!";
        //     }
        // });
        // if (branchCode) {
        //     // Show confirmation dialog before saving
           
        // }
        let branch_selected = localStorage.getItem('branch_selected');
         const confirmResult = await Swal.fire({
                title: 'Confirm Save',
                text: `Save ${parts_scanned.length} scanned parts to branch: ${branch_selected}?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, Save',
                cancelButtonText: 'Cancel'
            });

            if (confirmResult.isConfirmed) {
                // Show loading
                Swal.fire({
                    title: 'Saving...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                // Example AJAX call (adjust URL and data as needed)
                $.ajax({
                    url: 'save-scanned',
                    method: 'POST',
                    data: {
                        branch: branch_selected,
                        parts: parts_scanned
                    },
                    dataType :'json',
                    success: function (response) {
                        if (response.insert === true) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Saved!',
                                text: response.mssg
                            });
                            // Optionally clear scannedParts and update UI
                            scannedParts = [];
                            localStorage.setItem('scannedParts', '[]');
                            // $('#scannedList').empty();
                            updateDisplay();
                            updateTableScanned()
                            updateScannedData()
                            getMyList(2);
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.mssg
                            });
                        }
                    },
                    error: function (xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to save scanned parts. Please try again.'
                        });
                    }
                });
            }
    }
    showBranchSelector();

})
