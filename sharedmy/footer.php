</div>

<footer>
    <div class="container-fluid">
        <div class="card mt-5">
            <div class="card-body bg-dark text-light py-5">
                <div class="row">
                    <p class="col text-center">&copy; 2021 | Dota2 | BY: EC</p>
                </div>
            </div>
        </div>
    </div>
</footer>
<script src="js/sorttable.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
</script>
<script>
    window.addEventListener('DOMContentLoaded', () =>
    {
       
        var toastElList = [].slice.call(document.querySelectorAll('.toast'))
        var toastList = toastElList.map(function(toastEl) {
            return new bootstrap.Toast(toastEl)
        });
        toastList.forEach(toast => toast.show())
        
    });
    </script>
</body>

</html>

<?php
//disconect from database
db_disconnect($conn);
?>