<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://unpkg.com/trix@1.3.1/dist/trix.js"></script>
        @if ($errors->any())
            
            <script>
                const errors = @json($errors->all());
                if (errors.length > 0) {
                    let errorList = `<ul style="text-align:left; margin:0; padding:0; list-style:none;">`;
                    errors.forEach(e => errorList += `<li>⚠️ ${e}</li>`);
                    errorList += `</ul>`;

                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'error',
                        title: 'Validation Errors',
                        html: errorList,
                        showConfirmButton: false,
                        timer: 6000,
                        timerProgressBar: true,
                    });
                }
            </script>
        @endif
        @if (session('module_error'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: @json(session('module_error')),
                });
            </script>
        @endif
        @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: @json(session('success')),
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: false,
                    position: 'top-end',
                    toast: true
                });
            </script>
        @endif