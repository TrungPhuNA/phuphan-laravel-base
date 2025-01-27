@extends("admin.layouts.admin_master")
@section("title_page","Thêm mới")
@section("content")
    <main class="content">
        <div class="container-fluid p-0">
            @include("admin.ecommerce.category.form")
        </div>
    </main>
@stop
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
    });
</script>