  $(function() {
            $('#manualTabPills .nav-link').on('click', function(e) {
                e.preventDefault();
                $('#manualTabPills .nav-link').removeClass('active');
                $(this).addClass('active');
                let tab = $(this).data('manualtab');
                $('.manual-tab-content').addClass('d-none');
                $('#manual-' + tab + '-content').removeClass('d-none');
            });
        });