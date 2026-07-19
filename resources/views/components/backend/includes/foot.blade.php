<script src="{{asset('assets/vendor/js/helpers.js')}}"></script>
<script src="{{asset('assets/vendor/js/template-customizer.js')}}"></script>
<script src="{{asset('assets/backend/js/config.js')}}"></script>
<script src="{{asset('assets/vendor/js/bootstrap.js')}}"></script>
<script src="{{asset('assets/vendor/js/menu.js')}}"></script>
<script src="{{asset('assets/backend/js/main.js')}}"></script>
<script src="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/boxicons/dist/boxicons.js')}}"></script>

<!-- Libraries for Reusable Forms -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<!-- Alpine.js is automatically bundled with Livewire 3, so we do NOT include it here to avoid multiple instances -->

<script>
    //This is for Opening and Closing modals ----------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------
    document.addEventListener('livewire:initialized', () => {
        //This is for Opening and Closing modals ----------------------------------------------------------------------
        //-------------------------------------------------------------------------------------------------------------
        window.addEventListener('action-selector', event => {
            var modal = new bootstrap.Modal(document.getElementById('actionModal'));
            Livewire.on('openModal', (event) => {
                modal.show();
            });

            Livewire.on('closeModal', (event) => {
                modal.hide();
            });

            var modalTwo = new bootstrap.Modal(document.getElementById('actionSectionModal'));
            Livewire.on('openSectionModal', (event) => {
                modalTwo.show();
            });

            Livewire.on('closeSectionModal', (event) => {
                modalTwo.hide();
            });
        });
        //This is for DATA Export --------- ----------------------------------------------------------------------------
        //--------------------------------------------------------------------------------------------------------------
        window.addEventListener('dataExportAction', event => {
            var modalTwo = new bootstrap.Modal(document.getElementById('actionSectionModal'));
            Livewire.on('openSectionModal', (event) => {
                modalTwo.show();
            });

            Livewire.on('closeSectionModal', (event) => {
                modalTwo.hide();
            });
        });

        //This is fof Delete Confirm Option ----------------------------------------------------------------------------
        //--------------------------------------------------------------------------------------------------------------

            const createDeleteSwal = (eventName, dispatchEvent, paramName = 'id', isDanger = true) => {
                Livewire.on(eventName, (event) => {
                    let data = event[0] || event;
                    const swalWithBootstrapButtons = Swal.mixin({
                        customClass: {
                            confirmButton: 'swal2-confirm btn ' + (isDanger ? 'btn-danger' : 'btn-primary') + ' me-3',
                            cancelButton: 'swal2-cancel btn btn-label-secondary'
                        },
                        buttonsStyling: true
                    });

                    swalWithBootstrapButtons.fire({
                        title: data['title'] || 'Confirm Delete',
                        text: data['text'] || 'Are you sure you want to delete this?',
                        icon: data['type'] || 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'No, cancel!',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            let dispatchData = {};
                            dispatchData[paramName] = data['id'] || data['ids'];
                            window.Livewire.dispatch(dispatchEvent, dispatchData);
                            swalWithBootstrapButtons.fire({
                                title: "Deleted!",
                                text: "The record(s) have been deleted.",
                                icon: "success"
                            });
                        } else if (result.dismiss === Swal.DismissReason.cancel) {
                            swalWithBootstrapButtons.fire(
                                'Cancelled',
                                'Your Data is safe :)',
                                'error'
                            );
                        }
                    });
                });
            };

            // Posts & Projects Single Delete
            createDeleteSwal('swalDeleteConfirm', 'deleteSelectedRows', 'id', false);
            
            // Standard Single Delete (Clients, Services, etc.)
            createDeleteSwal('confirmDelete', 'deleteHandler', 'id', true);
            
            // Standard Bulk Delete (BaseTable)
            createDeleteSwal('confirmBulkDelete', 'bulkDeleteHandler', 'ids', true);
            
            // Legacy Bulk Delete
            createDeleteSwal('swalBulkDeleteConfirm', 'deleteSelectedRows', 'id', true);
            
            // Generic Action Confirmation
            Livewire.on('swalActionConfirm', (event) => {
                let data = event[0] || event;
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'swal2-confirm btn ' + (data['isDanger'] ? 'btn-danger' : 'btn-primary') + ' me-3',
                        cancelButton: 'swal2-cancel btn btn-label-secondary'
                    },
                    buttonsStyling: true
                });

                swalWithBootstrapButtons.fire({
                    title: data['title'] || 'Confirm Action',
                    text: data['text'] || 'Are you sure you want to proceed?',
                    icon: data['type'] || 'warning',
                    showCancelButton: true,
                    confirmButtonText: data['confirmText'] || 'Yes, proceed!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.Livewire.dispatch(data['action'], data['params'] || {});
                    }
                });
            });

            // Theme Switcher Logic
            const themeDropdownItems = document.querySelectorAll('[data-bs-theme-value]');
            const htmlElement = document.documentElement;

            const setTheme = theme => {
                if (theme === 'auto' || theme === 'system') {
                    htmlElement.setAttribute('data-bs-theme', window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
                } else {
                    htmlElement.setAttribute('data-bs-theme', theme);
                }
            };

            const showActiveTheme = (theme) => {
                const activeThemeIcon = document.querySelector('.theme-icon-active');
                
                document.querySelectorAll('[data-bs-theme-value]').forEach(element => {
                    element.classList.remove('active');
                    element.setAttribute('aria-pressed', 'false');
                });

                const btnToActive = document.querySelector(`[data-bs-theme-value="${theme}"]`);
                if (btnToActive) {
                    btnToActive.classList.add('active');
                    btnToActive.setAttribute('aria-pressed', 'true');
                }
                
                if (activeThemeIcon) {
                    activeThemeIcon.classList.remove('bx-sun', 'bx-moon', 'bx-desktop');
                    if (theme === 'light') activeThemeIcon.classList.add('bx-sun');
                    else if (theme === 'dark') activeThemeIcon.classList.add('bx-moon');
                    else activeThemeIcon.classList.add('bx-desktop');
                }
            };

            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
                const storedTheme = localStorage.getItem('theme');
                if (storedTheme !== 'light' && storedTheme !== 'dark') {
                    setTheme('system');
                }
            });

            let currentTheme = localStorage.getItem('theme') || 'system';
            setTheme(currentTheme);
            showActiveTheme(currentTheme);

            themeDropdownItems.forEach(item => {
                item.addEventListener('click', () => {
                    const theme = item.getAttribute('data-bs-theme-value');
                    localStorage.setItem('theme', theme);
                    setTheme(theme);
                    showActiveTheme(theme);
                });
            });

        //This is Confirm two-fator authentication Option --------------------------------------------------------------
        //--------------------------------------------------------------------------------------------------------------
            Livewire.on('swalDisableTwoFactorAuthenticationConfirm', (event) => {
                let data = event[0] || event;
                //console.log(event['title']);
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'swal2-confirm btn btn-primary me-3',
                        cancelButton: 'swal2-cancel btn btn-label-secondary'
                    },
                    buttonsStyling: true
                });

                swalWithBootstrapButtons.fire({
                    title: data['title'],
                    text: data['text'],
                    icon: data['type'],
                    showCancelButton: true,
                    confirmButtonText: 'Yes, Disable 2FA!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true

                }).then((result) => {
                    if (result.isConfirmed) {
                        //alert(event['id']);
                        window.Livewire.dispatch('disableTwoFactorAuth')
                        swalWithBootstrapButtons.fire({
                            title: "Disabling 2FA!",
                            text: "2FA Has been Disabled for the current user.",
                            icon: "success"
                        });
                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons.fire(
                            'Cancelled',
                            'Your Data is safe :)',
                            'error'
                        );
                    }
                });
            });

        //This is Cancel Confirmation ----------------------------------------------------------------------------------
        //--------------------------------------------------------------------------------------------------------------
            Livewire.on('swalCancelConfirm', (event) => {
                let data = event[0] || event;
                //console.log(event['title']);
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'swal2-confirm btn btn-primary me-3',
                        cancelButton: 'swal2-cancel btn btn-label-secondary'
                    },
                    buttonsStyling: true
                });

                swalWithBootstrapButtons.fire({
                    title: data['title'],
                    text: data['text'],
                    icon: data['type'],
                    showCancelButton: true,
                    confirmButtonText: 'Yes, Proceed!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true

                }).then((result) => {
                    if (result.isConfirmed) {
                        //alert(event['id']);
                        window.Livewire.dispatch('makeCancel')
                        swalWithBootstrapButtons.fire({
                            title: "Approval Status Changed",
                            text: "The selected Row Changed Successfully",
                            icon: "success"
                        });
                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons.fire(
                            'Cancelled',
                            'Your Data is safe :)',
                            'error'
                        );
                    }
                });
            });
            Livewire.on('swalCloseWithoutSavingConfirm', (event) => {
                let data = event[0] || event;
                //console.log(event['title']);
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'swal2-confirm btn btn-primary me-3',
                        cancelButton: 'swal2-cancel btn btn-label-secondary'
                    },
                    buttonsStyling: true
                });

                swalWithBootstrapButtons.fire({
                    title: data['title'],
                    text: data['text'],
                    icon: data['type'],
                    showCancelButton: true,
                    confirmButtonText: 'Yes, Proceed!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true

                }).then((result) => {
                    if (result.isConfirmed) {
                        //alert(event['id']);
                        window.Livewire.dispatch('makeConfirmWithoutSaving')
                        swalWithBootstrapButtons.fire({
                            title: "Close",
                            text: "No changes were made",
                            icon: "success"
                        });
                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons.fire(
                            'Cancelled',
                            'Your Data is safe :)',
                            'error'
                        );
                    }
                });
            });

        //This is for Success ------------------------------------------------------------------------------------------
        //--------------------------------------------------------------------------------------------------------------
        window.addEventListener('swalSuccess', (event) => {
            let data = event.detail[0] || event.detail || event;
            Swal.fire({
                position: 'top-end',
                icon: data.type || 'success',
                title: data.title || 'Success',
                showConfirmButton: false,
                timer: 1500
            });
        });

        //This is for Toasts -------------------------------------------------------------------------------------------
        //--------------------------------------------------------------------------------------------------------------
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });

        Livewire.on('livewire-toast', (event) => {
            let data = event[0] || event;
            Toast.fire({
                icon: data.type || 'success',
                title: data.message || data.title,
                position: data.placement || 'top-end',
                timer: data.duration || 3000
            });
        });

        Livewire.on('toast', (event) => {
            let data = event[0] || event;
            let message = typeof data === 'string' ? data : (data.message || data.title);
            Toast.fire({
                icon: data.type || 'success',
                title: message
            });
        });

        //This is for Success ------------------------------------------------------------------------------------------
        //--------------------------------------------------------------------------------------------------------------
        //Error
        window.addEventListener('swalError', (event) => {
            Swal.fire({
                title: event.detail.title,
                text: event.detail.text,
                icon: 'error',
                showCancelButton: true,
                showConfirmButton: false,
                cancelButtonColor: '#d33',
            });
        });
    });

    // Theme Switcher Logic
    document.addEventListener('DOMContentLoaded', () => {
        const themeButtons = document.querySelectorAll('[data-bs-theme-value]');
        const htmlTag = document.documentElement;
        const themeIconActive = document.querySelector('.theme-icon-active');

        const getPreferredTheme = () => {
            const storedTheme = localStorage.getItem('theme');
            if (storedTheme) return storedTheme;
            return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
        };

        const setTheme = function (theme) {
            if (theme === 'system') {
                htmlTag.setAttribute('data-bs-theme', window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
            } else {
                htmlTag.setAttribute('data-bs-theme', theme);
            }
        };

        const updateActiveButton = (theme) => {
            themeButtons.forEach(btn => {
                btn.classList.remove('active');
                btn.setAttribute('aria-pressed', 'false');
                if (btn.getAttribute('data-bs-theme-value') === theme) {
                    btn.classList.add('active');
                    btn.setAttribute('aria-pressed', 'true');
                    if (themeIconActive) {
                        const iconClass = btn.querySelector('i').getAttribute('data-icon');
                        if (iconClass) {
                            themeIconActive.className = `bx bx-${iconClass} icon-md theme-icon-active`;
                        }
                    }
                }
            });
        };

        let currentTheme = getPreferredTheme();
        setTheme(currentTheme);
        updateActiveButton(currentTheme);

        themeButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                const theme = btn.getAttribute('data-bs-theme-value');
                localStorage.setItem('theme', theme);
                setTheme(theme);
                updateActiveButton(theme);
            });
        });

        // Global Broken Image Fallback
        document.addEventListener('error', function(event) {
            if (event.target.tagName.toLowerCase() === 'img') {
                event.target.onerror = null; // Prevent infinite loop
                event.target.src = '{{ asset('assets/frontend/images/placeholder-image.png') }}';
            }
        }, true);
    });

</script>

