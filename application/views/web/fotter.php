   <!-- FOTTER -->
   <!-- DATATABLES -->

   <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
   <!-- END OF FOTTER -->
   <script>
       $(function() {
           $(document).ready(function() {
               $("#table_id").DataTable({
                   responsive: true,
               });
           });
       })

       var render = createwidgetlokasi("provinsi", "kabupaten", "kecamatan", "kelurahan");
   </script>
   </body>

   </html>