var branches = JSON.parse(post_js.branches);
var branchOptions = {};
branches.forEach(function (branch) {
    branchOptions[branch.BranchCode] = '(' + branch.BranchCode + ')-' + branch.BranchName;
});

async function showBranchSelector() {
    let scannedParts = JSON.parse(localStorage.getItem('scannedParts')) || [];
    console.log(scannedParts.length);

    if (scannedParts.length > 0) {
        if (!confirm('You have existing scanned data. This will be removed upon changing the branch.')) {
            return false;
        }
    }

    // Create dropdown HTML
    let branchOptionsHtml = '<option value="">Select a branch</option>';
    for (const key in branchOptions) {
        branchOptionsHtml += `<option value="${key}">${branchOptions[key]}</option>`;
    }

    const months = [
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];
    let monthOptionsHtml = '<option value="">Select a month</option>';
    months.forEach((month, index) => {
        monthOptionsHtml += `<option value="${index + 1}">${month}</option>`;
    });

    const { value: formValues } = await Swal.fire({
        title: "Select Branch and Month",
        html:

            `<label>Branch:</label><select id="branch-select-set" class="form-select">${branchOptionsHtml}</select>` +
            `<label>Month:</label><select id="month-select-set" class="form-select">${monthOptionsHtml}</select>`,
        focusConfirm: false,
        showCancelButton: true,
        preConfirm: () => {
            const selectedMonth = document.getElementById('month-select-set').value;
            const selectedBranch = document.getElementById('branch-select-set').value;
            if (!selectedBranch || !selectedMonth) {
                Swal.showValidationMessage('You must select both a month and a branch');
                return false;
            }
            return { branchCode: selectedBranch, month: selectedMonth };
        }
    });

    if (formValues) {
        const { branchCode, month } = formValues;

        // Confirm save
        const confirmResult = await Swal.fire({
            title: 'Confirm Save',
            text: `Selected Branch: ${branchOptions[branchCode]}, Month: ${months[month - 1]}`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, Save',
            cancelButtonText: 'Cancel'
        });

        if (confirmResult.isConfirmed) {
            Swal.fire({
                title: 'Creating session, please wait...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            $.ajax({
                url: 'selected-branch',
                method: 'POST',
                data: {
                    branch: branchCode,
                    month: month
                },
                dataType: 'json',
                success: function (response) {
                    if (response.res === true) {

                        $('#set-branch').html(
                            `<span><h5>Branch set: ${response.branch_display}</h5> <h5>Month : ${getMonth(response.month)} </h5></span><br>` +
                            `<span><button class="btn btn-primary" id="select-branch-load">Change</button></span>`
                        );
                                                localStorage.setItem('branch_selected', branchCode);
                        localStorage.setItem('selected_month', month);
                        localStorage.setItem('scannedParts', JSON.stringify([]));
                        localStorage.setItem('partList', JSON.stringify(response.partlist));
                        updateDisplay();
                        updateTableScanned();
                        updateScannedData();
                        Swal.fire({
                            icon: 'success',
                            title: 'Branch is set',
                            text: response.branch_display
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Failed to set',
                            text: response.branch_display
                        });
                    }
                },
                error: function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to save scanned parts. Please try again.'
                    });
                }
            });
        }
    }
}
function getMonth(code) {
    console.log(code)
    switch (code) {
        case  1:
            return "January";
            break;
        case 2:
            return "February";
            break;
        case 3:
            return "March";
            break;
        case  4:
            return "April";
            break;
        case  5:
            return "May";
            break;
        case 6:
            return "June";
            break;
        case  7:
            return "July";
            break;
        case  8:
            return "August";
            break;
        case  9:
            return "September";
            break;
        case 10:
            return "October";
            break;
        case 11:
            return "November";
            break;
        case 12:
            return "December";
            break;
        default:
            return "-";
            break;
        
    }
}
$(document).on('click', '#select-branch-load', function () {
    showBranchSelector();
})

if (branch_selected_load == 0) {
    console.log(branch_selected_load, 'load', branch_selected_load == 0)
    localStorage.removeItem('branch_selected');
    showBranchSelector();
} else {
    localStorage.setItem('branch_selected', branch_selected_load)
    var  month = post_js.month;
        console.log(month)
    $('#set-branch').html('<span> <h5>Branch set : ' + branch_display_load + '<h5><h5>Month : '+ getMonth(month) +'</h5><span><span><button class="btn btn-primary" id="select-branch-load">change</button></span>')
}
